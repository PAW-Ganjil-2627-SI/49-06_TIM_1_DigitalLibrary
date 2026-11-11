@extends('layouts.app')

@section('content')
<form action="{{ route('buku.update', $buku) }}" method="POST">
    @method('PUT')
    @include('buku._form')
</form>
@endsection