@extends('layouts.app')

@section('title', 'Digital Library - Tambah Anggota')
@section('identitas')
    @include('members._identitas')
@endsection

@section('content')
<h2 class="mb-4">Tambah Anggota</h2>
<form action="{{ route('members.store') }}" method="POST">
    @include('members._form')
</form>
@endsection
