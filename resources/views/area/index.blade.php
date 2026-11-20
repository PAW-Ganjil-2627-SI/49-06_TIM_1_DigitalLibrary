@extends('layouts.app')

@section('title', 'Digital Library - Fasilitas & Area')
@section('identitas')
    @include('area._identitas')
@endsection

@section('content')
<h2 class="mb-4">Data Fasilitas &amp; Area</h2>
<a href="{{ route('area.create') }}" class="btn btn-primary mb-3">+ Tambah Area</a>
<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr>
            <th>No</th><th>Kode</th><th>Jenis</th><th>Lantai</th>
            <th>Stopkontak</th><th>WiFi</th><th>Status</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($areas as $area)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $area->kode_area }}</td>
            <td>{{ $area->jenis }}</td>
            <td>{{ $area->nomor_lantai }}</td>
            <td>{{ $area->stopkontak ? 'Ada' : 'Tidak' }}</td>
            <td>{{ $area->wifi ? 'Ada' : 'Tidak' }}</td>
            <td>
<span class="{{ $area->status === 'Tersedia' ? 'status-tersedia' : 'status-terisi' }}">
    {{ $area->status }}
</span>
            </td>
            <td>
                <a href="{{ route('area.edit', $area) }}" class="btn btn-sm btn-warning">Edit</a>
                @if (auth()->user()?->role === 'admin')
                <form action="{{ route('area.destroy', $area) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection