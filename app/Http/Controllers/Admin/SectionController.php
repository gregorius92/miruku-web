<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('order')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'title_en'    => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'subtitle_en' => 'nullable|string|max:255',
            'content'     => 'nullable|string',
            'content_en'  => 'nullable|string',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sections', 'public');
        }

        $section->update($data);
        return redirect()->route('admin.sections.index')->with('success', 'Section berhasil diperbarui!');
    }
}
