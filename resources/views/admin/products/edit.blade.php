@extends('admin.layouts.app')
@section('title', 'Edit product')

@section('content')
    <h1 class="text-2xl font-bold">Edit product</h1>
    <div class="mt-6">
        @include('admin.products.form', ['product' => $product, 'categories' => $categories])
    </div>
@endsection
