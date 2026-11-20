@extends('layouts.app')

@section('title', 'Digital Library - Katalog & Buku')
@section('identitas')
    @include('buku._identitas')
@endsection

@section('content')
<h2 class="mb-4">Detail Katalog &amp; Buku</h2>
<a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">+ Tambah Buku Baru</a>
<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr>
            <th>No</th><th>Judul</th><th>ISBN</th><th>Pengarang</th><th>Tahun Terbit</th><th>Kategori</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($buku as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->judul }}</td>
            <td>{{ $row->isbn }}</td>
            <td>{{ $row->pengarang }}</td>
            <td>{{ $row->tahun_terbit }}</td>
            <td>{{ $row->kategori }}</td>
            <td>
                <a href="{{ route('buku.edit', $row) }}" class="btn btn-sm btn-warning">Edit</a>
                @if (auth()->user()?->role === 'admin')
                <form action="{{ route('buku.destroy', $row) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center">Belum ada data buku</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
