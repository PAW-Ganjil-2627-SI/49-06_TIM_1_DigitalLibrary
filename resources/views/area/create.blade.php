@extends('layouts.app')

@section('content')
<h2 class="mb-4">Tambah Area</h2>
<form action="{{ route('area.store') }}" method="POST">
    @include('area._form')
</form>
@endsection