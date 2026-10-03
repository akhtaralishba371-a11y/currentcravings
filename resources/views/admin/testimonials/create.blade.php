@extends('admin.layouts.app')
@section('title', 'New testimonial')

@section('content')
    <h1 class="text-2xl font-bold">New testimonial</h1>
    <div class="mt-6">
        @include('admin.testimonials.form', ['testimonial' => $testimonial])
    </div>
@endsection
