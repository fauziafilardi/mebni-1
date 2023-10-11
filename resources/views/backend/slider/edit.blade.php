@extends('layouts.backend.app')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Input Slider</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    <a href="{{ route('slider.index') }}" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="sliderForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title
                                                <span class="text-danger">*</span></label>
                                            <input id="title" name="title" type="text" class="form-control"
                                                placeholder="Enter event title" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description
                                                <span class="text-danger">*</span></label>
                                            <input id="description" name="description" type="text" class="form-control"
                                                placeholder="Enter description" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Url
                                                <span class="text-danger">*</span></label>
                                            <input id="url" name="url" type="text" class="form-control"
                                                placeholder="Enter url" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Youtube Url
                                                <span class="text-danger">*</span></label>
                                            <input id="youtube_url" name="youtube_url" type="text" class="form-control"
                                                placeholder="Enter youtube_url" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Active Status</label>
                                            <div class="col-9 col-form-label">
                                                <div class="checkbox-list">
                                                    <label class="checkbox">
                                                        <input type="checkbox" id="is_active" name="is_active" checked/>
                                                        <span></span>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Display Caption</label>
                                            <div class="col-9 col-form-label">
                                                <div class="checkbox-list">
                                                    <label class="checkbox">
                                                        <input type="checkbox" id="is_caption" name="is_caption" checked/>
                                                        <span></span>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image<span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="slider_path" name="slider_path" accept="image/*"/>
                                                <label class="custom-file-label" for="slider_path">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-primary mr-2" id="submitEventBtn"
                                    onclick="submitEvent()">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Class definition

            var KTBootstrapSwitch = function() {

            // Private functions
            var demos = function() {
            // minimum setup
                $('[data-switch=true]').bootstrapSwitch();
            };

            return {
                // public functions
                init: function() {
                    demos();
                },
            };
            }();

            jQuery(document).ready(function() {
                KTBootstrapSwitch.init();
            });
        });

        function submitEvent() {
            $('#submitEventBtn').prop("disabled", true);

            var formData = new FormData(document.getElementById('sliderForm'));

            let title = $('input[name="title"]').val();
            let description = $('input[name="description"]').val();
            let url = $('input[name="url"]').val();
            let youtube_url = $('textarea[name="youtube_url"]').val();
            var is_active = $('input[name="is_active"]:checked').val();
            var is_caption = $('input[name="is_caption"]:checked').val();


            formData.append('title', title);
            formData.append('description', description);
            formData.append('url', url);
            formData.append('youtube_url', youtube_url);
            formData.append('is_active', is_active);
            formData.append('is_caption', is_caption);

            formData.append('file', $('#slider_path')[0].files[0]);

            $.ajax({
                url: "{{ route('slider.store') }}",
                type: "POST",
                data: formData,
                contentType: false, // Don't set content type
                processData: false, // Don't process data (FormData does it for you)
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = "{{ route('slider.index') }}";
                },
                error: function(error) {
                    $('#submitEventBtn').prop("disabled", false);

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
