@extends('layouts.app')

@section('content')
<h2 class="mb-4">Edit Area</h2>
<form action="{{ route('area.update', $area) }}" method="POST">
    @method('PUT')
    @include('area._form')
</form>
@endsection