@extends('layouts.app')

@section('title', 'Digital Library - Edit Supplier')
@section('identitas')
    @include('supplier._identitas')
@endsection

@section('content')
<h2 class="mb-4">Edit Supplier</h2>
<form action="{{ route('suppliers.update', $supplier) }}" method="POST">
    @method('PUT')
    @include('supplier._form')
</form>
@endsection
