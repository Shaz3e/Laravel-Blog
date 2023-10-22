@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                        <h1>Edit Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">View All</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <form action="{{ route('posts.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                id="submitForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Post -->
                    <div class="col-md-8">
                        {{-- Post Data --}}
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit Posts</h3>

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
                                                placeholder="Title" value="{{ old('title', $data->title) }}"
                                                maxlength="255" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ config('app.url') }}/</span>
                                                </div>
                                                <input type="text" name="slug" class="form-control" id="slug"
                                                    placeholder="slug" value="{{ old('slug', $data->slug) }}"
                                                    maxlength="255" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <textarea id="description" class="form-control" name="description" style="height: 300px">{{ old('description', $data->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <textarea id="summary" name="summary" placeholder="Summary"
                                                class="form-control"
                                                maxlength="255" required>{{ old('summary', $data->summary) }}</textarea>
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
                                                placeholder="Meta Title" value="{{ old('meta_title', $data->meta_title) }}"
                                                maxlength="255" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea name="meta_description" class="form-control"
                                                id="meta_description" placeholder="Meta Description"
                                                maxlength="255" required>{{ old('meta_description', $data->meta_description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords (Comma-Separated)</label>
                                            <input type="text" name="meta_keywords" class="form-control"
                                                id="meta_keywords" placeholder="Meta Keywords"
                                                value="{{ old('meta_keywords', $data->meta_keywords) }}"
                                                maxlength="255" />
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
                                            <select name="post_status_id" id="post_status_id" class="form-control"
                                                required>
                                                @foreach ($postStatuses as $status)
                                                    <option value="{{ $status->id }}"
                                                        {{ $status->id == old('post_status_id', $data->post_status_id) ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category_id">Select Category</label>
                                            <input type="text" name="inputCategory" class="form-control"
                                                id="inputCategory" placeholder="category,">
                                            <select name="category_id[]" id="category_id" multiple class="form-control"
                                                required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, explode(',', $data->category_id)) === true ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tag_id">Select Tags</label>
                                            <input type="text" name="inputTag" class="form-control" id="inputTag"
                                                placeholder="tag,">
                                            <select name="tag_id[]" id="tag_id" class="form-control" multiple>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ in_array($tag->id, explode(',', $data->tag_id)) === true ? 'selected' : '' }}>
                                                        {{ $tag->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tag_id">Featured Image</label>
                                            <a href="{{ asset('images/' . $data->featured_image) }}"
                                                data-toggle="lightbox">
                                                <img class="img-fluid"
                                                    src="{{ asset('images/' . $data->featured_image) }}"
                                                    class="w-auto rounded" loading="lazy" decoding="async"
                                                    style="height:25px;" />
                                            </a>
                                            <input type="file" name="featured_image" id="featured_image"
                                                value="{{ old('featured_image', $data->featured_image) }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="is_featured" id="is_featured"
                                                    value="1"
                                                    {{ old('is_featured', $data->is_featured) == 1 ? 'checked' : '' }}>
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
                                                    value="1"
                                                    {{ old('is_comment', $data->is_comment) == 1 ? 'checked' : '' }}>
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

        // Add Category in DB and update in select box
        $('#inputCategory').on('input', function() {
            // Detect when a comma is entered
            if (this.value.endsWith(',')) {
                // Remove the trailing comma
                var inputCategory = this.value.slice(0, -1);

                // Make an AJAX request to create a category
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('create.category.ajax') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        inputCategory: inputCategory
                    },
                    success: function(response) {
                        // Handle the success response
                        // alert(response.message); // You can replace this with your desired action

                        // Update the select box options with the newly created categories
                        var $categorySelect = $('#category_id');
                        var categories = response.categories;
                        categories.forEach(function(category) {
                            var option = new Option(category.name, category.id, true, true);
                            $categorySelect.append(option).trigger('change');
                        });
                    },
                    error: function(xhr) {
                        // Handle any errors if necessary
                        console.log(xhr);
                    }
                });

                // Clear the input field
                this.value = '';
            }
        });

        // Add Tag in DB and update in selecbox
        $('#inputTag').on('input', function() {
            // Detect when a comma is entered
            if (this.value.endsWith(',')) {
                // Remove the trailing comma
                var inputTag = this.value.slice(0, -1);

                // Make an AJAX request to create a record
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('create.tag.ajax') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        inputTag: inputTag
                    },
                    success: function(response) {
                        // Handle the success response
                        // alert(response.message); // You can replace this with your desired action

                        // Update the select box options with the newly created tags
                        var $tagSelect = $('#tag_id');
                        var tags = response.tags;
                        tags.forEach(function(tag) {
                            var option = new Option(tag.name, tag.id, true, true);
                            $tagSelect.append(option).trigger('change');
                        });
                    },
                    error: function(xhr) {
                        // Handle any errors if necessary
                        console.log(xhr);
                    }
                });

                // Clear the input field
                this.value = '';
            }
        });
    </script>
@endsection
