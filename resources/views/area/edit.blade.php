@extends('layouts.app')

@section('title', 'Digital Library - Fasilitas & Area')
@section('identitas')
    @include('area._identitas')
@endsection

@section('content')
<h2 class="mb-4">Edit Area</h2>
<form action="{{ route('area.update', $area) }}" method="POST">
    @method('PUT')
    @include('area._form')
</form>
@endsection