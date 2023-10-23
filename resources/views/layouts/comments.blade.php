<div id="messageDiv" class="alert alert-success" style="display: none;"></div>
<form action="{{ route('user.comment.store') }}" method="POST" id="commentForm">

    @csrf
    <input type="hidden" name="post_id" value="{{$post->id}}" />
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Full name" maxlength="255"
                        required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" maxlength="255"
                        required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="website" class="form-control" placeholder="Website" maxlength="255" />
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="form-group">
                    <textarea name="comment" class="form-control" placeholder="Comment" required></textarea>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <button type="text" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
</form>
