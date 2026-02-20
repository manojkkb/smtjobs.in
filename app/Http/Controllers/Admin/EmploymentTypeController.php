<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmploymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmploymentTypeController extends Controller
{
    private array $sortable = ['id', 'label', 'slug', 'sort_order', 'is_active', 'created_at'];

    public function index(Request $request)
    {
        $employmentTypes = $this->buildQuery($request)
            ->paginate(15)
            ->withQueryString();

        return view('admin.employment-types.index', compact('employmentTypes'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $path = $request->file('file')->getRealPath();
        $rows = array_filter(array_map('str_getcsv', file($path)));
        $headers = array_shift($rows);

        if (empty($headers) || empty($rows)) {
            return back()->with('status', 'No rows were found in the CSV.');
        }

        $headers = array_map(fn ($value) => Str::of($value)->trim()->lower()->toString(), $headers);
        $inserted = 0;

        foreach ($rows as $row) {
            if (count($row) < 1) {
                continue;
            }

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
                'slug' => $slug,
                'label' => $rowData['label'] ?? Str::of($slug)->replace('-', ' ')->title()->toString(),
                'sort_order' => $rowData['sort_order'] ?? 0,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            EmploymentType::updateOrCreate(['slug' => $slug], $payload);
            $inserted++;
        }

        return back()->with('status', "Imported {$inserted} employment types.");
    }

    public function export(Request $request)
    {
        $employmentTypes = $this->buildQuery($request)->get();
        $columns = ['slug', 'label', 'sort_order', 'is_active'];
        $filename = 'employment-types-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($employmentTypes, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($employmentTypes as $employmentType) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $employmentType->{$column};
                    if (is_bool($value)) {
                        $value = $value ? '1' : '0';
                    }
                    $row[] = $value;
                }
                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function sample(): StreamedResponse
    {
        $columns = ['slug', 'label', 'sort_order', 'is_active'];
        $filename = 'employment-types-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['full-time', 'Full Time', 10, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function create()
    {
        return view('admin.employment-types.create');
    }

    public function store(Request $request)
    {
        $this->ensureSlug($request);
        $data = $this->validateEmploymentType($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        EmploymentType::create($data);

        return redirect()
            ->route('admin.employment-types.index')
            ->with('status', 'Employment type created successfully.');
    }

    public function show(EmploymentType $employmentType)
    {
        return view('admin.employment-types.show', compact('employmentType'));
    }

    public function edit(EmploymentType $employmentType)
    {
        return view('admin.employment-types.edit', compact('employmentType'));
    }

    public function update(Request $request, EmploymentType $employmentType)
    {
        $this->ensureSlug($request);
        $data = $this->validateEmploymentType($request, $employmentType);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $employmentType->update($data);

        return redirect()
            ->route('admin.employment-types.index')
            ->with('status', 'Employment type updated successfully.');
    }

    public function destroy(EmploymentType $employmentType)
    {
        $employmentType->delete();

        return redirect()
            ->route('admin.employment-types.index')
            ->with('status', 'Employment type deleted.');
    }

    private function buildQuery(Request $request)
    {
        $query = EmploymentType::query();

        if ($search = $request->input('search')) {
            $query->where(fn ($builder) => $builder
                ->where('label', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")
            );
        }

        if ($status = $request->input('status')) {
            $query->where('is_active', $status === 'active');
        }

        $sort = in_array($request->input('sort'), $this->sortable, true) ? $request->input('sort') : 'sort_order';
        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';

        return $query->orderBy($sort, $direction);
    }

    private function validateEmploymentType(Request $request, EmploymentType $employmentType = null): array
    {
        $uniqueRule = Rule::unique('employment_types', 'slug');
        if ($employmentType) {
            $uniqueRule->ignore($employmentType);
        }

        return $request->validate([
            'slug' => ['required', 'alpha_dash', 'max:191', $uniqueRule],
            'label' => ['required', 'string', 'max:191'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function ensureSlug(Request $request): void
    {
        if (!$request->filled('slug') && $request->filled('label')) {
            $request->merge(['slug' => Str::slug($request->input('label'))]);
        }
    }
}
