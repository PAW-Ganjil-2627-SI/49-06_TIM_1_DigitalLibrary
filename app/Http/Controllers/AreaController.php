<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::latest()->get();
        return view('area.index', compact('areas'));
    }

    public function create()
    {
        return view('area.create');
    }

    public function store(Request $request)
    {
        Area::create($this->validated($request));
        return redirect()->route('area.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $area->update($this->validated($request));
        return redirect()->route('area.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Data berhasil dihapus');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'kode_area'    => 'required|string|max:20',
            'jenis'        => 'required|in:Meja Baca,Bilik Baca',
            'nomor_lantai' => 'required|integer|min:1|max:20',
            'status'       => 'required|in:Tersedia,Terpakai',
        ]);

        $data['stopkontak'] = $request->boolean('stopkontak');
        $data['wifi'] = $request->boolean('wifi');

        return $data;
    }
}