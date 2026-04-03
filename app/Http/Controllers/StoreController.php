<?php

namespace App\Http\Controllers;

use App\Models\StoreLocation;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $provinces = StoreLocation::active()->distinct()->pluck('province')->filter()->sort();
        $cities = StoreLocation::active()
            ->when($request->province, function($query) use ($request) {
                return $query->where('province', $request->province);
            })
            ->distinct()
            ->pluck('city')
            ->filter()
            ->sort();

        $stores = StoreLocation::active()
            ->when($request->province, function($query) use ($request) {
                return $query->where('province', $request->province);
            })
            ->when($request->city, function($query) use ($request) {
                return $query->where('city', $request->city);
            })
            ->when($request->search, function($query) use ($request) {
                return $query->where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('address', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(12);

        return view('stores.index', compact('stores', 'provinces', 'cities'));
    }
}
