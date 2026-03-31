<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Services\UploadService;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('order')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function edit(Section $section)
    {
        $section->load('features');
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
            'is_active'   => 'nullable',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            
            // Features validation
            'features'               => 'nullable|array',
            'features.*.id'          => 'nullable|exists:features,id',
            'features.*.icon'        => 'required|string',
            'features.*.title'       => 'required|string|max:255',
            'features.*.title_en'    => 'nullable|string|max:255',
            'features.*.description' => 'required|string',
            'features.*.description_en' => 'nullable|string',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = UploadService::upload($request->file('image'), 'sections');
        }

        $section->update($data);

        // Handle Features
        if ($section->section_name === 'about' && $request->has('features')) {
            $existingIds = collect($request->features)->pluck('id')->filter()->toArray();
            
            // Delete features not in the request
            $section->features()->whereNotIn('id', $existingIds)->delete();

            foreach ($request->features as $index => $featureData) {
                if (isset($featureData['id'])) {
                    $section->features()->find($featureData['id'])->update(array_merge($featureData, ['order' => $index]));
                } else {
                    $section->features()->create(array_merge($featureData, ['order' => $index]));
                }
            }
        }

        return redirect()->route('admin.sections.index')->with('success', 'Section ' . ($section->section_name === 'about' ? 'dan Keunggulan ' : '') . 'berhasil diperbarui!');
    }
}
