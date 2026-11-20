@extends('layouts.app')

@section('title', 'Digital Library - Edit Buku')
@section('identitas')
    @include('buku._identitas')
@endsection

@section('content')
<h2 class="mb-4">Edit Buku</h2>
<form action="{{ route('buku.update', $buku) }}" method="POST">
    @method('PUT')
    @include('buku._form')
</form>
@endsection
