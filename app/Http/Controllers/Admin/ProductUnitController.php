<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductUnitController extends Controller
{
    public function index()
    {
        $units = ProductUnit::orderBy('sort_order')->orderBy('id', 'desc')->get();
        return view('admin.product_units.index', compact('units'));
    }

    public function create()
    {
        return view('admin.product_units.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'name_en'    => 'nullable|string|max:255',
            'slug'       => 'required|string|max:255|unique:product_units,slug',
            'sort_order' => 'nullable|integer',
        ]);

        $data['is_active'] = $request->has('is_active');

        ProductUnit::create($data);

        return redirect()->route('admin.product_units.index')->with('success', 'Unit berhasil ditambahkan!');
    }

    public function edit(ProductUnit $productUnit)
    {
        return view('admin.product_units.edit', compact('productUnit'));
    }

    public function update(Request $request, ProductUnit $productUnit)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'name_en'    => 'nullable|string|max:255',
            'slug'       => 'required|string|max:255|unique:product_units,slug,' . $productUnit->id,
            'sort_order' => 'nullable|integer',
        ]);

        $data['is_active'] = $request->has('is_active');

        $productUnit->update($data);

        return redirect()->route('admin.product_units.index')->with('success', 'Unit berhasil diperbarui!');
    }

    public function destroy(ProductUnit $productUnit)
    {
        $productUnit->delete();
        return back()->with('success', 'Unit berhasil dihapus!');
    }
}
