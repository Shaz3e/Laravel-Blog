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
                        <h1>Create Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">View All</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{ route('categories.store') }}" method="POST" id="submitForm">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ceate New Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="category_type_id">Category Type</label>
                                    <select name="category_type_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($categoryTypes as $type)
                                            <option value="{{ $type->id }}" {{ old('category_type_id', $type->id) }}>
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Parent Category Name</label>
                                    <select name="parent_category_id" class="form-control">
                                        <option value="">Parent</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        required maxlength="255" id="name">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="slug">Category Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control"
                                        required maxlength="255" id="slug">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Status</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- /.row --}}
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
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
        // Auto generate slug depanding on category name
        const textInput = document.getElementById('name');
        const outputInput = document.getElementById('slug');

        textInput.addEventListener('input', function() {
            const inputValue = this.value.trim().toLowerCase(); // Remove trailing spaces and make lowercase
            const modifiedValue = inputValue.replace(/\s+/g, '-'); // Replace spaces with hyphens
            outputInput.value = modifiedValue;
        });
    </script>
@endsection
