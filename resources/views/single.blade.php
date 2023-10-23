@extends('layouts.main')

@section('title')
    <title>{{ $post->title }} - {{ config('app.name') }}</title>
@endsection

@section('content')
    <h2>{{ $post->title }}</h2>
    <a href="{{ $post->id . '-' . $post->slug }}">
        <img src="{{ asset('images/' . $post->featured_image) }}" alt="{{ $post->title }}">
        </a>
    <ul>
        <li>{{ getCategoryNameById($post->category_id) }}</li>
        <li>{{ $post->created_at }}</li>
        <li>{{ $post->created_by }}</li>
    </ul>
    {!! nl2br($post->description) !!}

    @if ($post->is_comment == 1)
        @include('layouts.comments')
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#commentForm').submit(function(e) {
                e.preventDefault(); // Prevent the regular form submission
                console.log('AJAX request sent');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.comment.store') }}',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle success, e.g., show a success message
                        // alert(response.message);
                        $('#messageDiv').removeClass('alert-danger').addClass('alert-success')
                            .text(response.message).show();
                        // Clear the form or take any other desired action
                        $('#commentForm')[0].reset();
                        $('#commentForm').hide();
                    },
                    error: function(xhr) {
                        // $('#messageDiv').removeClass('alert-success').addClass('alert-danger')
                        //     .text(xhr.responseText).show();
                        console.log(xhr.responseText);
                    }
                });
            });
        });
        $('#commentForm').validate({
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
    </script>
@endsection
