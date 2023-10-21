@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">View All</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="submitForm">
                @csrf
                <div class="row">
                    <!-- Post -->
                    <div class="col-md-8">
                        {{-- Post Data --}}
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Create Posts</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Title" value="{{ old('title') }}" maxlength="255" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ config('app.url') }}/</span>
                                                </div>
                                                <input type="text" name="slug" class="form-control" id="slug"
                                                    placeholder="slug" value="{{ old('slug') }}" maxlength="255"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <textarea id="description" class="form-control" name="description" style="height: 300px">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <textarea id="summary" name="summary" placeholder="Summary"
                                                class="form-control" maxlength="255"
                                                required>{{ old('summary') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- /.row --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        {{-- SEO Data --}}
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">SEO</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                placeholder="Meta Title" value="{{ old('meta_title') }}" maxlength="255"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea name="meta_description" class="form-control"
                                                id="meta_description" placeholder="Meta Description" maxlength="255" required>{{ old('meta_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords (Comma-Separated)</label>
                                            <input type="text" name="meta_keywords" class="form-control"
                                                id="meta_keywords" placeholder="Meta Keywords"
                                                value="{{ old('meta_keywords') }}" maxlength="255" />
                                            <small class="text-muted">Enter keywords separated by commas (e.g., keyword1,
                                                keyword2, keyword3)</small>
                                        </div>
                                    </div>
                                </div>
                                {{-- /.row --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    {{-- /.post --}}

                    {{-- Sidebar Starts --}}
                    <div class="col-md-4">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Sidebar</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="post_status_id">Select Status</label>
                                            <select name="post_status_id" id="post_status_id" class="form-control" required>
                                                @foreach ($postStatuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category_id">Select Category</label>
                                            <select name="category_id[]" id="category_id" multiple class="form-control" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tag_id">Select Tags</label>
                                            <select name="tag_id[]" id="tag_id" class="form-control" multiple>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tag_id">Featured Image</label>
                                            <input type="file" name="featured_image" id="featured_image"
                                                value="{{ old('featured_image') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="is_featured" id="is_featured"
                                                value="1" {{ old('is_featured') == 1 ? 'checked' : '' }}>
                                                <label for="is_featured">
                                                    Featured Post?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" checked name="is_comment" id="is_comment"
                                                value="1" {{ old('is_comment') == 1 ? 'checked' : '' }}>
                                                <label for="is_comment">
                                                    Enable Comments?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- /.row --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                    {{-- Sidebar End --}}
                </div>
                {{-- /.row --}}
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Initialize Select2 Elements
            
            $('#category_id').select2({
                theme: 'bootstrap4'
            });
            $('#tag_id').select2({
                theme: 'bootstrap4'
            });
            $('.select2b4').select2({
                theme: 'bootstrap4',
            })
            let summernoteOptions = {
                height: 300,
                callbacks: {
                    onChange: function(contents, $editable) {
                        // Get the content from Summernote
                        var descriptionValue = $editable.text();

                        // Update the summary input with the first 255 characters of the description
                        var truncatedValue = descriptionValue.substring(0, 255);
                        $("#summary").val(truncatedValue);

                        // Update the meta title with the title input
                        $("#meta_title").val($("#title").val());

                        // Update the meta description with the first 255 characters of the description
                        var truncatedDescription = descriptionValue.substring(0, 255);
                        $("#meta_description").val(truncatedDescription);
                    }
                }
            };
            $('#description').summernote(summernoteOptions);
        });

        $('#submitForm').validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        // Auto generate slug depanding on title
        const postTitle = document.getElementById('title');
        const postSlug = document.getElementById('slug');

        postTitle.addEventListener('input', function() {
            const postTitleValue = this.value.trim().toLowerCase();
            const postSlugValue = postTitleValue.replace(/[^a-z0-9]+/g, '-');
            postSlug.value = postSlugValue;
        });
    </script>
@endsection
