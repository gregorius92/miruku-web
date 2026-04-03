<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreLocation;
use Illuminate\Http\Request;

class StoreLocationController extends Controller
{
    public function index()
    {
        $stores = StoreLocation::latest()->paginate(20);
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'name_en'    => 'nullable|string|max:255',
            'address'    => 'required|string',
            'address_en' => 'nullable|string',
            'city'       => 'required|string|max:100',
            'city_en'    => 'nullable|string|max:100',
            'province'   => 'nullable|string|max:100',
            'map_embed'  => 'nullable|string',
            'phone'      => 'nullable|string|max:30',
            'open_time'  => 'nullable',
            'close_time' => 'nullable',
            'is_active'  => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

        StoreLocation::create($data);
        return redirect()->route('admin.stores.index')->with('success', 'Lokasi toko berhasil ditambahkan!');
    }

    public function edit(StoreLocation $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, StoreLocation $store)
    {
        $data = $request->all();
        
        // Handle is_active checkbox manually
        $data['is_active'] = $request->has('is_active');
        
        $store->update($data);
        
        return redirect()->route('admin.stores.index')->with('success', 'Lokasi Toko berhasil diperbarui.');
    }

    public function destroy(StoreLocation $store)
    {
        $store->delete();
        return back()->with('success', 'Lokasi toko berhasil dihapus!');
    }
}
