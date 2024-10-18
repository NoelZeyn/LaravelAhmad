<?php

namespace App\Http\Controllers;

use App\Models\RecyclingCenter;
use Illuminate\Http\Request;

class RecyclingCenterController extends Controller
{
    // Read: Mengambil semua data bank sampah
    public function index()
    {
        $centers = RecyclingCenter::all();
        return response()->json($centers);
    }

    // Create: Membuat lokasi bank sampah baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $center = RecyclingCenter::create($request->all());
        return response()->json($center, 201); // 201 for Created
    }

    // Read: Mengambil satu data bank sampah berdasarkan ID
    public function show($id)
    {
        $center = RecyclingCenter::findOrFail($id);
        return response()->json($center);
    }

    // Update: Mengupdate data bank sampah
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
        ]);
        $center = RecyclingCenter::findOrFail($id);
        $center->update($request->all());
        return response()->json($center);
    }

    // Delete: Menghapus data bank sampah
    public function destroy($id)
    {
        $center = RecyclingCenter::findOrFail($id);
        $center->delete();
        return response()->json(null, 204); // 204 for No Content
    }
}
