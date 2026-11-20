<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('id')->get();

        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        Supplier::create($this->validated($request));

        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($this->validated($request));

        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_supplier' => 'required|string|max:100',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:200',
            'wilayah_asal' => 'required|string|max:100',
        ]);
    }
}
