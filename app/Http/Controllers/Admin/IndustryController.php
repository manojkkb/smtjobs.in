<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndustryController extends Controller
{
    private array $sortable = ['id', 'label', 'slug', 'sort_order', 'is_active', 'created_at'];

    public function index(Request $request)
    {
        $industries = $this->buildQuery($request)
            ->paginate(12)
            ->withQueryString();


        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $this->ensureSlug($request);
        $data = $this->validateIndustry($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Industry::create($data);

        return redirect()
            ->route('admin.industries.index')
            ->with('status', 'Industry created successfully.');
    }

    public function show(Industry $industry)
    {
        return view('admin.industries.show', compact('industry'));
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $this->ensureSlug($request);
        $data = $this->validateIndustry($request, $industry);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $industry->update($data);

        return redirect()
            ->route('admin.industries.index')
            ->with('status', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();

        return redirect()
            ->route('admin.industries.index')
            ->with('status', 'Industry deleted.');
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
                'description' => $rowData['description'] ?? null,
                'sort_order' => $rowData['sort_order'] ?? 0,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            Industry::updateOrCreate(['slug' => $slug], $payload);
            $inserted++;
        }

        return back()->with('status', "Imported {$inserted} industries.");
    }

    public function export(Request $request)
    {
        $industries = $this->buildQuery($request)->get();
        $columns = ['slug', 'label', 'description', 'sort_order', 'is_active'];
        $filename = 'industries-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($industries, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($industries as $industry) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $industry->{$column};
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
        $columns = ['slug', 'label', 'description', 'sort_order', 'is_active'];
        $filename = 'industries-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['financial-services', 'Financial Services', 'Services for banks and insurers', 10, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    private function buildQuery(Request $request)
    {
        $query = Industry::query();

        if ($search = $request->input('search')) {
            $query->where(fn ($builder) => $builder
                ->where('label', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
            );
        }

        if ($status = $request->input('status')) {
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $sort = in_array($request->input('sort'), $this->sortable, true) ? $request->input('sort') : 'created_at';
        $direction = $request->input('direction') === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($sort, $direction);
    }

    private function validateIndustry(Request $request, Industry $industry = null): array
    {
        $uniqueRule = Rule::unique('industries', 'slug');
        if ($industry) {
            $uniqueRule->ignore($industry);
        }

        $validated = $request->validate([
            'slug' => ['required', 'alpha_dash', 'max:191', $uniqueRule],
            'label' => ['required', 'string', 'max:191'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        return $validated;
    }

    private function ensureSlug(Request $request): void
    {
        if (!$request->filled('slug') && $request->filled('label')) {
            $request->merge(['slug' => Str::slug($request->input('label'))]);
        }
    }
}
