@extends('layouts.backend.app')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Input Content</h3>
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
                                        <input id="title" name="title" type="text" class="form-control" placeholder="Enter title" maxlength="100"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Slug
                                        <span class="text-danger">*</span></label>
                                        <input id="slug" name="slug" type="text" class="form-control" placeholder="Enter slug" maxlength="100"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="is_active">Content Status
                                        <span class="text-danger">*</span></label>
                                        <select class="form-control" id="is_active" name="is_active">
                                            <option value="true">Active</option>
                                            <option value="false">Not-Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content
                                            <span class="text-danger">*</span></label>
                                        {{-- <div class="summernote" id="kt_summernote_1"></div> --}}
                                        <textarea class="summernote" id="content" name="content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-primary mr-2" id="submitContentBtn" onclick="submitContent()">Submit</button>
                            <a href="{{ route('content.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

    });

    function submitContent(params) {
        $('#submitContentBtn').prop("disabled", true);

        let title = $('input[name="title"]').val();
        let slug = $('input[name="slug"]').val();
        let is_active = $('#is_active').val();
        let content = $('textarea[name="content"]').val();

        let formData = {
            title: title,
            slug: slug,
            is_active: is_active,
            content: content,
        };

        $.ajax({
            url: "{{ route('content.store') }}",
            type: "POST",
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
                        Swal.fire("Error!", error.responseJSON.error, "error");
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
