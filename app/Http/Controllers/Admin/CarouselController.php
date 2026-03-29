<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('order')->get();
        return view('admin.carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousels.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string',
            'button_text'  => 'nullable|string|max:100',
            'button_link'  => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:100',
            'button2_link' => 'nullable|string|max:255',
            'text_color'   => 'nullable|string',
            'order'        => 'nullable|integer',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carousels', 'public');
        }

        Carousel::create($data);
        return redirect()->route('admin.carousels.index')->with('success', 'Carousel berhasil ditambahkan!');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string',
            'button_text'  => 'nullable|string|max:100',
            'button_link'  => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:100',
            'button2_link' => 'nullable|string|max:255',
            'text_color'   => 'nullable|string',
            'order'        => 'nullable|integer',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carousels', 'public');
        }

        $carousel->update($data);
        return redirect()->route('admin.carousels.index')->with('success', 'Carousel berhasil diperbarui!');
    }

    public function destroy(Carousel $carousel)
    {
        $carousel->delete();
        return back()->with('success', 'Carousel berhasil dihapus!');
    }
}
