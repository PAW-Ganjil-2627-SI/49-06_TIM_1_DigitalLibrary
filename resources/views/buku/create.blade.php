@extends('layouts.app')

@section('title', 'Digital Library - Tambah Buku')
@section('identitas')
    @include('buku._identitas')
@endsection

@section('content')
<h2 class="mb-4">Tambah Buku Baru</h2>
<form action="{{ route('buku.store') }}" method="POST">
    @include('buku._form')
</form>
@endsection
