<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryRange;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SalaryRangeController extends Controller
{
    private array $sortable = ['id', 'label', 'slug', 'sort_order', 'is_active', 'created_at'];

    public function index(Request $request)
    {
        $salaryRanges = $this->buildQuery($request)
            ->paginate(15)
            ->withQueryString();

        return view('admin.salary-ranges.index', compact('salaryRanges'));
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

            SalaryRange::updateOrCreate(['slug' => $slug], $payload);
            $inserted++;
        }

        return back()->with('status', "Imported {$inserted} salary ranges.");
    }

    public function export(Request $request)
    {
        $salaryRanges = $this->buildQuery($request)->get();
        $columns = ['slug', 'label', 'sort_order', 'is_active'];
        $filename = 'salary-ranges-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($salaryRanges, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($salaryRanges as $salaryRange) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $salaryRange->{$column};
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
        $filename = 'salary-ranges-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['0-50000', '0 - 50,000', 10, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function create()
    {
        return view('admin.salary-ranges.create');
    }

    public function store(Request $request)
    {
        $this->ensureSlug($request);
        $data = $this->validateSalaryRange($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        SalaryRange::create($data);

        return redirect()
            ->route('admin.salary-ranges.index')
            ->with('status', 'Salary range created successfully.');
    }

    public function show(SalaryRange $salaryRange)
    {
        return view('admin.salary-ranges.show', compact('salaryRange'));
    }

    public function edit(SalaryRange $salaryRange)
    {
        return view('admin.salary-ranges.edit', compact('salaryRange'));
    }

    public function update(Request $request, SalaryRange $salaryRange)
    {
        $this->ensureSlug($request);
        $data = $this->validateSalaryRange($request, $salaryRange);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $salaryRange->update($data);

        return redirect()
            ->route('admin.salary-ranges.index')
            ->with('status', 'Salary range updated successfully.');
    }

    public function destroy(SalaryRange $salaryRange)
    {
        $salaryRange->delete();

        return redirect()
            ->route('admin.salary-ranges.index')
            ->with('status', 'Salary range deleted.');
    }

    private function buildQuery(Request $request)
    {
        $query = SalaryRange::query();

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

    private function validateSalaryRange(Request $request, SalaryRange $salaryRange = null): array
    {
        $uniqueRule = Rule::unique('salary_ranges', 'slug');
        if ($salaryRange) {
            $uniqueRule->ignore($salaryRange);
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
