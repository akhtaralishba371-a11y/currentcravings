@extends('admin.layouts.app')
@section('title', 'New blog post')

@section('content')
    <h1 class="text-2xl font-bold">New blog post</h1>
    <div class="mt-6">
        @include('admin.blog_posts.form', ['post' => $post])
    </div>
@endsection
