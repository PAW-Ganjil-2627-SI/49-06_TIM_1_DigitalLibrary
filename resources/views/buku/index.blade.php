@extends('layouts.app')

@section('content')
<a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">+ Tambah Buku</a>
<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr><th>No</th><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Stok</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @forelse ($bukus as $buku)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penulis }}</td>
            <td>{{ $buku->tahun_terbit }}</td>
            <td>{{ $buku->stok }}</td>
            <td>
                <a href="{{ route('buku.edit', $buku) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection