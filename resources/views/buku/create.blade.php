@extends('layouts.app')

@section('content')
<form action="{{ route('buku.store') }}" method="POST">
    @include('buku._form')
</form>
@endsection