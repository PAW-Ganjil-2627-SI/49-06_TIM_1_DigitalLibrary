@extends('layouts.app')

@section('title', 'Digital Library - Anggota & Kartu')
@section('identitas')
    @include('members._identitas')
@endsection

@section('content')
<h2 class="mb-4">Data Anggota &amp; Kartu</h2>

<div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
    <a href="{{ route('members.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
    <form method="GET" action="{{ route('members.index') }}" class="d-flex gap-2">
        <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama / nomor anggota / kartu">
        <button class="btn btn-primary">Cari</button>
    </form>
</div>

<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr>
            <th>No</th><th>Nomor Anggota</th><th>Nama</th><th>Tipe</th><th>Status</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($members as $i => $member)
        <tr>
            <td>{{ $members->firstItem() + $i }}</td>
            <td>{{ $member->member_number }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->membership_type }}</td>
            <td>
                <span class="{{ $member->status === 'Aktif' ? 'status-tersedia' : 'status-terisi' }}">
                    {{ $member->status }}
                </span>
            </td>
            <td>
                <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-success">Lihat/Kartu</a>
                <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">Edit</a>
                @if (auth()->user()?->role === 'admin')
                <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin menghapus anggota ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data anggota</td></tr>
        @endforelse
    </tbody>
</table>

{{ $members->links() }}
@endsection
