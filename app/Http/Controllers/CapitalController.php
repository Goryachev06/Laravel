<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CapitalController extends Controller
{
    public function index()
    {
        $capitals = Capital::all();
        return view('capitals.index', compact('capitals'));
    }

    public function create()    
    {
        return view('capitals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=> 'required|string|max:255',
            'short_info'=> 'required|string|max:1000',
            'detailed_info'=> 'required|string',
            'photo'=> 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('/', $filename, 'public');

        Capital::create([
            'name'=> $validated['name'],
            'short_info'=> $validated['short_info'],
            'detailed_info'=> $validated['detailed_info'],
            'photo'=> $filename,
        ]);

        return redirect()->route('capitals.index')->with('success', 'Столица добавлена');
    }

    public function show(Capital $capital)
    {
        return view('capitals.show', compact('capital'));
    }

    public function edit(Capital $capital)
    {
        return view('capitals.edit', compact('capital'));
    }

    public function update(Request $request, Capital $capital)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'short_info'=> 'required|string|max:1000',
            'detailed_info' => 'required|string',
            'photo'=> 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            if ($capital->photo && Storage::disk('public')->exists($capital->photo)) {
                Storage::disk('public')->delete($capital->photo);
            }

            $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('/', $filename, 'public');
            $validated['photo'] = $filename;
        }

        $capital->update($validated);

        return redirect()->route('capitals.index')->with('success', 'Столица обновлена');
    }

    public function destroy(Capital $capital)
    {
        if ($capital->photo && Storage::disk('public')->exists($capital->photo)) {
            Storage::disk('public')->delete($capital->photo);
        }

        $capital->delete();

        return redirect()->route('capitals.index')->with('success', 'Столица удалена');
    }
}