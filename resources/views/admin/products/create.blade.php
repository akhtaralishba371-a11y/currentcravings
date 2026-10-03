@extends('admin.layouts.app')
@section('title', 'New product')

@section('content')
    <h1 class="text-2xl font-bold">New product</h1>
    <div class="mt-6">
        @include('admin.products.form', ['product' => $product, 'categories' => $categories])
    </div>
@endsection
