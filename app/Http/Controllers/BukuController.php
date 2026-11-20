<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    private array $kategoriList = ['Buku Fiksi', 'Sastra', 'Pelajaran', 'Sejarah'];

    private function rules(): array
    {
        return [
            'judul' => 'required',
            'isbn' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|integer|min:1000|max:2155',
            'kategori' => 'required|in:' . implode(',', $this->kategoriList),
        ];
    }

    public function index()
    {
        $buku = Buku::orderBy('id', 'desc')->get();

        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        $kategoriList = $this->kategoriList;

        return view('buku.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        Buku::create($request->validate($this->rules()));

        return redirect()->route('buku.index')->with('success', 'Buku berhasil disimpan ke database.');
    }

    public function edit(Buku $buku)
    {
        $kategoriList = $this->kategoriList;

        return view('buku.edit', compact('buku', 'kategoriList'));
    }

    public function update(Request $request, Buku $buku)
    {
        $buku->update($request->validate($this->rules()));

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        // Hak akses hapus (hanya admin) dijaga oleh middleware role:admin di routes/modules/buku.php
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus dari database.');
    }
}
