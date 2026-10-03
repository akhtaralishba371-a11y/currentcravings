@extends('admin.layouts.app')
@section('title', 'Edit category')

@section('content')
    <h1 class="text-2xl font-bold">Edit category</h1>
    <div class="mt-6">
        @include('admin.categories.form', ['category' => $category])
    </div>
@endsection
