@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
    <style>
        #image-upload {
            border: 2px dashed #aaa;
        }

        #image-upload:hover {
            border: 2px dashed #000;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Upload Media</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ URL::to('admin/media/') }}">Media</a></li>
                            <li class="breadcrumb-item active">Upload New Media</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">

            <div class="card">

                <div class="card-body">
                    @if (isset($_GET['status']) == 'success')
                        <div class="alert alert-success">File uploaded successfully</div>
                    @endif
                    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data"
                        class="dropzone" id="media-upload-form">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="media_categories_id">Select Category</label>
                                <select name="media_categories_id" id="media_categories_id" class="form-control">
                                    @foreach ($media_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="submit-button">Upload</button>
                    <br>
                    <strong>Note: Upload one file at a time for better experience max 5 files can be uploaded at once.</strong>
                </div>
                </form>

            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            // Initialize Dropzone
            var myDropzone = new Dropzone('#media-upload-form', {
                url: '{{ route('media.store') }}',
                autoProcessQueue: false, // Disable auto processing
                paramName: 'file', // This is the parameter name your server expects
                maxFilesize: 2048, // Set your desired max file size
                parallelUploads: 5, // Adjust the number of parallel uploads as needed
                uploadMultiple: true, // Enable uploading multiple files
                acceptedFiles: 'image/*', // Allow only image files
                addRemoveLinks: true, // Show remove links for uploaded files
                dictRemoveFile: 'Remove file', // Customize the "Remove file" text
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(file, response) {
                    console.log('File uploaded successfully:', response);
                    // alert('File uploaded successfully');
                    // location.reload();
                    window.location.href = window.location.href + '?status=success';
                },
                error: function(file, response) {
                    console.error('File upload error:', response);
                    alert('File upload error');
                }
            });

            // Bind submit button click to process Dropzone queue
            $('#submit-button').on('click', function(e) {
                e.preventDefault();
                myDropzone.processQueue(); // Manually process the queue on button click
            });
        });
    </script>
@endsection
