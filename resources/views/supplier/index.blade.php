@extends('layouts.app')

@section('title', 'Digital Library - Penerbit & Supplier')
@section('identitas')
    @include('supplier._identitas')
@endsection

@section('content')
<h2 class="mb-4">Daftar Penerbit &amp; Supplier</h2>
<a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">+ Tambah Supplier</a>
<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr>
            <th>No</th><th>Nama Supplier</th><th>No. Telepon</th><th>Alamat</th><th>Wilayah Asal</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($suppliers as $supplier)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $supplier->nama_supplier }}</td>
            <td>{{ $supplier->no_telp }}</td>
            <td>{{ $supplier->alamat }}</td>
            <td>{{ $supplier->wilayah_asal }}</td>
            <td>
                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-warning">Edit</a>
                @if (auth()->user()?->role === 'admin')
                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
