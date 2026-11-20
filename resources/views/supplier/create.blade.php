@extends('layouts.app')

@section('title', 'Digital Library - Tambah Supplier')
@section('identitas')
    @include('supplier._identitas')
@endsection

@section('content')
<h2 class="mb-4">Tambah Supplier</h2>
<form action="{{ route('suppliers.store') }}" method="POST">
    @include('supplier._form')
</form>
@endsection
