<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::latest()->paginate(10);
        return view('admin.variants.index', compact('variants'));
    }

    public function create()
    {
        return view('admin.variants.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'name_en'     => 'nullable|string|max:255',
            'slug'        => 'required|string|max:255|unique:variants,slug',
            'icon'        => 'nullable|string|max:255',
            'color_class' => 'nullable|string|max:255',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        Variant::create($data);
        return redirect()->route('admin.variants.index')->with('success', 'Varian berhasil ditambahkan!');
    }

    public function edit(Variant $variant)
    {
        return view('admin.variants.edit', compact('variant'));
    }

    public function update(Request $request, Variant $variant)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'name_en'     => 'nullable|string|max:255',
            'slug'        => 'required|string|max:255|unique:variants,slug,' . $variant->id,
            'icon'        => 'nullable|string|max:255',
            'color_class' => 'nullable|string|max:255',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        $variant->update($data);
        return redirect()->route('admin.variants.index')->with('success', 'Varian berhasil diperbarui!');
    }

    public function destroy(Variant $variant)
    {
        $variant->delete();
        return redirect()->route('admin.variants.index')->with('success', 'Varian berhasil dihapus!');
    }
}
