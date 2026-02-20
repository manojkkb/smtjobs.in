<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExperienceRange;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExperienceRangeController extends Controller
{
    private array $sortable = ['id', 'label', 'slug', 'sort_order', 'is_active', 'created_at'];

    public function index(Request $request)
    {
        $experienceRanges = $this->buildQuery($request)
            ->paginate(15)
            ->withQueryString();

        return view('admin.experience-ranges.index', compact('experienceRanges'));
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

            ExperienceRange::updateOrCreate(['slug' => $slug], $payload);
            $inserted++;
        }

        return back()->with('status', "Imported {$inserted} experience ranges.");
    }

    public function export(Request $request)
    {
        $experienceRanges = $this->buildQuery($request)->get();
        $columns = ['slug', 'label', 'sort_order', 'is_active'];
        $filename = 'experience-ranges-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($experienceRanges, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($experienceRanges as $experienceRange) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $experienceRange->{$column};
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
        $filename = 'experience-ranges-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['entry-level', 'Entry Level', 10, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function create()
    {
        return view('admin.experience-ranges.create');
    }

    public function store(Request $request)
    {
        $this->ensureSlug($request);
        $data = $this->validateExperienceRange($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        ExperienceRange::create($data);

        return redirect()
            ->route('admin.experience-ranges.index')
            ->with('status', 'Experience range created successfully.');
    }

    public function show(ExperienceRange $experienceRange)
    {
        return view('admin.experience-ranges.show', compact('experienceRange'));
    }

    public function edit(ExperienceRange $experienceRange)
    {
        return view('admin.experience-ranges.edit', compact('experienceRange'));
    }

    public function update(Request $request, ExperienceRange $experienceRange)
    {
        $this->ensureSlug($request);
        $data = $this->validateExperienceRange($request, $experienceRange);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $experienceRange->update($data);

        return redirect()
            ->route('admin.experience-ranges.index')
            ->with('status', 'Experience range updated successfully.');
    }

    public function destroy(ExperienceRange $experienceRange)
    {
        $experienceRange->delete();

        return redirect()
            ->route('admin.experience-ranges.index')
            ->with('status', 'Experience range deleted.');
    }

    private function buildQuery(Request $request)
    {
        $query = ExperienceRange::query();

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

    private function validateExperienceRange(Request $request, ExperienceRange $experienceRange = null): array
    {
        $uniqueRule = Rule::unique('experience_ranges', 'slug');
        if ($experienceRange) {
            $uniqueRule->ignore($experienceRange);
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
