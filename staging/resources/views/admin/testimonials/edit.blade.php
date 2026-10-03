@extends('admin.layouts.app')
@section('title', 'Edit testimonial')

@section('content')
    <h1 class="text-2xl font-bold">Edit testimonial</h1>
    <div class="mt-6">
        @include('admin.testimonials.form', ['testimonial' => $testimonial])
    </div>
@endsection
