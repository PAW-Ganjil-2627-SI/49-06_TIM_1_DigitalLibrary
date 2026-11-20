@extends('layouts.app')

@section('title', 'Digital Library - Edit Anggota')
@section('identitas')
    @include('members._identitas')
@endsection

@section('content')
<h2 class="mb-4">Edit Anggota</h2>
<form action="{{ route('members.update', $member) }}" method="POST">
    @method('PUT')
    @include('members._form')
</form>
@endsection
