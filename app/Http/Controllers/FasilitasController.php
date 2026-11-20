<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index() {
        $fasilitas = Fasilitas::all();
        return view('fasilitas.index', compact('fasilitas'));
    }

    public function create() {
        return view('fasilitas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nomor_meja' => 'required',
            'lantai' => 'required',
            'fitur' => 'required',
            'status' => 'required',
        ]);
        Fasilitas::create($request->all());
        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas) {
        return view('fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas) {
        $request->validate([
            'nomor_meja' => 'required',
            'lantai' => 'required',
            'fitur' => 'required',
            'status' => 'required',
        ]);
        $fasilitas->update($request->all());
        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil diubah.');
    }

    public function destroy(Fasilitas $fasilitas) {
        $fasilitas->delete();
        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil dihapus.');
    }
}