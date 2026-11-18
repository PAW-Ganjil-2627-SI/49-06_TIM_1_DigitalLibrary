<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BukuController extends Controller
{
    private $kategoriList = ["Buku Fiksi", "Sastra", "Pelajaran", "Sejarah"];

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
        $data = $request->validate($this->rules());

        Buku::create($data);

        return redirect()->route('buku.index')->with('status', 'Buku berhasil disimpan ke database.');
    }

    public function edit(Buku $buku)
    {
        $kategoriList = $this->kategoriList;
        return view('buku.edit', compact('buku', 'kategoriList'));
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate($this->rules());

        $buku->update($data);

        return redirect()->route('buku.index')->with('status', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        // Authorization: hanya admin yang boleh menghapus
        Gate::authorize('delete-buku');

        $buku->delete();

        return redirect()->route('buku.index')->with('status', 'Buku berhasil dihapus dari database.');
    }
}