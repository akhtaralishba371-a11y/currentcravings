@extends('admin.layouts.app')
@section('title', 'Edit blog post')

@section('content')
    <h1 class="text-2xl font-bold">Edit blog post</h1>
    <div class="mt-6">
        @include('admin.blog_posts.form', ['post' => $post])
    </div>
@endsection
