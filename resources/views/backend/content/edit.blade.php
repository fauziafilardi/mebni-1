@extends('layouts.backend.app')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Edit Content</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <a href="{{ route('content.index') }}" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title
                                        <span class="text-danger">*</span></label>
                                        <input id="title" name="title" type="text" class="form-control" placeholder="Enter title" maxlength="100" value="{{ $data->title }}" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Slug
                                        <span class="text-danger">*</span></label>
                                        <input id="slug" name="slug" type="text" class="form-control" placeholder="Enter slug" maxlength="100" value="{{ $data->slug }}" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="is_active">Content Status
                                        <span class="text-danger">*</span></label>
                                        <select class="form-control" id="is_active" name="is_active">
                                            <option value="true" {{ $data->is_active == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="false" {{ $data->is_active == 0 ? 'selected' : '' }}>Not-Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content
                                            <span class="text-danger">*</span></label>
                                        <textarea class="summernote" id="content" name="content">{{ $data->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-primary mr-2" id="submitContentBtn" onclick="submitContent()">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var contentUpdateUrl = "{{ route('content.update', [encrypt($data->id)]) }}";
</script>

<script>
    $(document).ready(function() {

    });

    function submitContent(params) {
        $('#submitContentBtn').prop("disabled", true);

        let is_active = $('#is_active').val();
        let content = $('textarea[name="content"]').val();

        let formData = {
            is_active: is_active,
            content: content,
        };

        $.ajax({
            url: contentUpdateUrl,
            type: "PATCH",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                window.location.href = "{{ route('content.index') }}";
            },
            error: function(error) {
                $('#submitContentBtn').prop("disabled", false);

                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    // Clear previous errors
                    $('.error-message').remove();
                    for (let field in errors) {
                        let errorMsg = errors[field][0]; // Taking only the first error message per field
                        let inputElement = $(`input[name="${field}"], textarea[name="${field}"]`);

                        // Append error message and add error class
                        inputElement.after(`<span class="error-message">${errorMsg}</span>`);
                        inputElement.addClass('error-border');
                    }
                } else if (error.status === 500) {
                    if (error.responseJSON && error.responseJSON.error) {
                        alert('Error: ' + error.responseJSON.error);
                    }
                }
            },
            complete: function() {
                // Remove overlay
                $('.overlay').remove();
            }
        });
    }
</script>
@endsection
