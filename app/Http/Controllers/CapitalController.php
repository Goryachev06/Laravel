<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class CapitalController extends Controller
{
    public function index(): View
    {
        $capitals = Capital::latest()->get();

        return view('capitals.index', compact('capitals'));
    }

    public function create(): View
    {
        return view('capitals.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCapital($request);

        $validated['photo'] = $this->savePhoto($request);

        Capital::create($validated);

        return redirect()
            ->route('capitals.index')
            ->with('success', 'Столица добавлена');
    }

    public function show(Capital $capital): View
    {
        return view('capitals.show', compact('capital'));
    }

    public function edit(Capital $capital): View
    {
        return view('capitals.edit', compact('capital'));
    }

    public function update(Request $request, Capital $capital): RedirectResponse
    {
        $validated = $this->validateCapital($request, true);

        if ($request->hasFile('photo')) {
            $newPhoto = $this->savePhoto($request);

            if ($capital->photo && Storage::disk('public')->exists($capital->photo)) {
                Storage::disk('public')->delete($capital->photo);
            }

            $validated['photo'] = $newPhoto;
        } else {
            unset($validated['photo']);
        }

        $capital->update($validated);

        return redirect()
            ->route('capitals.index')
            ->with('success', 'Столица обновлена');
    }

    public function destroy(Capital $capital): RedirectResponse
    {
        if ($capital->photo && Storage::disk('public')->exists($capital->photo)) {
            Storage::disk('public')->delete($capital->photo);
        }

        $capital->delete();

        return redirect()
            ->route('capitals.index')
            ->with('success', 'Столица удалена');
    }

    private function validateCapital(Request $request, bool $updating = false): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_info' => ['required', 'string', 'max:1000'],
            'detailed_info' => ['required', 'string'],
            'photo' => $updating
                ? ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120']
                : ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);
    }

    private function savePhoto(Request $request): ?string
    {
        if (!$request->hasFile('photo')) {
            return null;
        }

        $file = $request->file('photo');

        Storage::disk('public')->makeDirectory('capitals');

        $filename = Str::uuid() . '.jpg';
        $relativePath = 'capitals/' . $filename;
        $absolutePath = storage_path('app/public/' . $relativePath);

        Image::decode($file)
            ->cover(600, 250)
            ->save($absolutePath, quality: 85);

        return $relativePath;
    }
}