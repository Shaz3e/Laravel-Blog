@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View All Posts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <form action="{{ route('posts.index') }}" method="GET">
                            @csrf
                            <input type="text" name="search" class="form-control" placeholder="Search & Enter"
                                value="{{ request('search') }}" />
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if ($search)
                        <p>Search results for: <strong>{{ $search }}</strong></p>
                    @endif

                    @if ($posts->isEmpty())
                        <p>No results found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Post Title</th>
                                    <th>Categories</th>
                                    <th>Is Featured</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @foreach (explode(',', $post->category_id) as $category)
                                                <span
                                                    class="badge badge-primary">{{ getCategoryNameById($category) }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($post->is_featured == 1)
                                                <span class="badge badge-success">Featured</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($post->is_comment == 1)
                                                <span class="badge badge-success">Enabled</span>
                                            @else
                                                <span class="badge badge-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-flat btn-success" href="{{ route('posts.edit', $post->id) }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-flat btn-danger"
                                                    onclick="DeleteFormSubmit(this)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="dataTables_paginate">
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
@endsection
