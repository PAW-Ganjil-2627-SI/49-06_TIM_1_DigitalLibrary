@extends('layouts.app')

@section('title', 'Digital Library - Kartu Anggota')
@section('identitas')
    @include('members._identitas')
@endsection

@push('styles')
<style>
    @media print {
        body * { visibility: hidden; }
        #idcard, #idcard * { visibility: visible; }
        #idcard { position: absolute; left: 0; top: 0; width: 100%; margin: 0; }
    }
</style>
@endpush

@section('content')
<h2 class="mb-4">Detail Anggota</h2>

<div class="mb-3">
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
    <button type="button" class="btn btn-primary" onclick="window.print()">Cetak ID Card</button>
</div>

<div id="idcard" class="card p-4 mb-4 mx-auto" style="max-width: 650px; border: 2px solid #2c3e50;">
    <div class="text-center fw-bold text-white p-3 mb-3" style="background-color: #2c3e50; border-radius: 6px;">
        KARTU ANGGOTA PERPUSTAKAAN
    </div>
    <h4 class="text-center mb-3">{{ $member->name }}</h4>
    <table class="table table-borderless mb-2">
        <tr><th style="width: 40%;">Nomor Anggota</th><td>{{ $member->member_number }}</td></tr>
        <tr><th>Nomor Kartu</th><td>{{ $member->card_number }}</td></tr>
        <tr><th>Tipe</th><td>{{ $member->membership_type }}</td></tr>
        <tr><th>Berlaku Sampai</th><td>{{ $member->expires_at->format('d-m-Y') }}</td></tr>
        <tr><th>Status</th><td>{{ $member->status }}</td></tr>
    </table>
    <p class="text-center text-muted mb-0">Digital Library</p>
</div>

<div class="card p-4">
    <h5>Informasi Anggota</h5>
    <p class="mb-1">Email: {{ $member->email ?: '-' }}</p>
    <p class="mb-1">Telepon: {{ $member->phone ?: '-' }}</p>
    <p class="mb-1">Alamat: {{ $member->address ?: '-' }}</p>
    <p class="mb-0">Tanggal bergabung: {{ $member->joined_at->format('d-m-Y') }}</p>
</div>
@endsection
