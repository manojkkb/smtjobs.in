<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificateController extends MasterResourceController
{
    protected string $modelClass = Certificate::class;
    protected string $routeName = 'admin.certificates';
    protected string $resourceLabel = 'Certificate';
    protected string $resourcePlural = 'Certificates';
    protected string $indexSubtitle = 'Track the official certificates candidates can showcase.';
    protected string $formSubtitle = 'Assign slugs, icons, and issuing authorities before marking them active.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Label', 'field' => 'label', 'sortable' => true],
        ['label' => 'Issuing authority', 'field' => 'issuing_authority', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Icon', 'field' => 'icon'],
        ['label' => 'Sort order', 'field' => 'sort_order', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'label', 'label' => 'Label', 'type' => 'text', 'required' => true],
        ['name' => 'issuing_authority', 'label' => 'Issuing authority', 'type' => 'text'],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'icon', 'label' => 'Icon', 'type' => 'text', 'help' => 'Use a short CSS class or emoji to represent the certificate.'],
        ['name' => 'sort_order', 'label' => 'Sort order', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['label', 'slug', 'issuing_authority'];
    protected array $sortable = ['id', 'label', 'issuing_authority', 'slug', 'sort_order', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.certificates.sample',
            'description' => 'Use the sample to match the column order.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.certificates.export',
            'description' => 'Grab whatever the filters are showing.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.certificates.import',
            'description' => 'Upload new or updated certificates via CSV.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('certificates', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'label' => ['required', 'string', 'max:191'],
            'issuing_authority' => ['nullable', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'icon' => ['nullable', 'string', 'max:191'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $rows = array_filter(array_map('str_getcsv', file($request->file('file')->getRealPath())));
        $headers = array_shift($rows);
        if (empty($headers) || empty($rows)) {
            return back()->with('status', 'No rows were found in the CSV.');
        }

        $headers = array_map(fn ($value) => Str::of($value)->trim()->lower()->toString(), $headers);
        $imported = 0;

        foreach ($rows as $row) {
            $row = array_pad($row, count($headers), null);
            $rowData = array_combine($headers, $row);
            if (!$rowData) {
                continue;
            }

            $slug = Str::slug($rowData['slug'] ?? $rowData['label'] ?? '');
            if (!$slug) {
                continue;
            }

            $payload = [
                'label' => $rowData['label'] ?? Str::of($slug)->replace('-', ' ')->title()->toString(),
                'issuing_authority' => $rowData['issuing_authority'] ?? null,
                'slug' => $slug,
                'icon' => $rowData['icon'] ?? null,
                'sort_order' => $rowData['sort_order'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            Certificate::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} certificates.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'label', 'issuing_authority', 'icon', 'sort_order', 'is_active'];
        $filename = 'certificates-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($columns, $request) {
            $records = $this->buildQuery($request)->get();
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($records as $record) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $record->{$column};
                    if (is_bool($value)) {
                        $value = $value ? '1' : '0';
                    }
                    $row[] = $value;
                }
                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }

    public function sample(): StreamedResponse
    {
        $columns = ['slug', 'label', 'issuing_authority', 'icon', 'sort_order', 'is_active'];
        $filename = 'certificates-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['pmp', 'PMP', 'Project Management Institute', 'pmp-icon', 1, 1]);
            fputcsv($handle, ['ccna', 'CCNA', 'Cisco', 'network-icon', 2, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
