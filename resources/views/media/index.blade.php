@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Media <a href="{{ route('media.create') }}" class="btn btn-success">Add
                                Media</a></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">View All</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- Sidebar --}}
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>
                                <div class="card-tools">
                                    <a class="btn btn-default btn-sm btn-flat"
                                        href="{{ route('media-categories.create') }}">Create New Category</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="?" class="nav-link">
                                            <i class="fas fa-inbox"></i> View All
                                        </a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a href="?category={{ $category->id }}" class="nav-link">
                                                <i class="fas fa-inbox"></i> {{ $category->name }}
                                                <span
                                                    class="badge bg-primary float-right">{{ $countMediaByCategory[$category->id] ?? 0 }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- /.card-header --}}
                        </div>
                        {{-- /.card --}}
                    </div>
                    {{-- /.left-col --}}

                    {{-- Media gallery --}}
                    <div class="col-md-9">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($media as $item)
                                        <div class="col-md-3">
                                            {{-- <img class="img-fluid" src="{{ asset('images/' . $item->media) }}"> --}}
                                            <a href="{{ asset('images/' . $item->media) }}" data-toggle="lightbox">
                                                <img class="img-fluid" src="{{ asset('images/' . $item->media) }}"
                                                    class="w-auto rounded" loading="lazy" decoding="async" />
                                            </a>
                                            <form action="{{ route('media.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex align-items-center mt-2">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <span>Delete</span>
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- /.row --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    {{-- /.right-col --}}
                </div>
                {{-- /.row --}}
            </div>
            {{-- /.container-fluid --}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(function() {
            // lightbox
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        });
        $(document).ready(function() {
            // Delete record on click and submit form
            $(".deleteRecord").click(function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $('.deleteRecordForm-' + id).submit();
            });
        });
    </script>
@endsection
