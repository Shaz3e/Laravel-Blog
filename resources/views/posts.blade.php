@extends('layouts.main')

@section('title')
    <title>{{ config('app.name') }}</title>
@endsection

@section('content')
    @foreach ($posts as $post)
        <h2><a href="{{ $post->id . '-' . $post->slug }}">{{ $post->title }}</a></h2>
        @if ($post->featured_image != null)
            <a href="{{ $post->id . '-' . $post->slug }}">
                <img src="{{ asset('images/' . $post->featured_image) }}" alt="{{ $post->title }}">
            </a>
        @endif
        <ul>
            <li>{{ getCategoryNameById($post->category_id) }}</li>
            <li>{{ $post->created_at }}</li>
            <li>{{ getUserNameById($post->created_by) }}</li>
        </ul>
        {{ shortTextWithOutHtml($post->summary) }}
    @endforeach

    <div class="dataTables_paginate">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
@endsection
