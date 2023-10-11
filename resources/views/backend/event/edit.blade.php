@extends('layouts.backend.app')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Edit Event</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    <a href="{{ route('event.index') }}" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="eventForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event Name
                                                <span class="text-danger">*</span></label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="Enter event name" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Place
                                                <span class="text-danger">*</span></label>
                                            <input id="place" name="place" type="text" class="form-control"
                                                placeholder="Enter place" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Event Date
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" id="date" name="date" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>PIC
                                                <span class="text-danger">*</span></label>
                                            <input id="pic" name="pic" type="text" class="form-control"
                                                placeholder="Enter pic" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price
                                                <span class="text-danger">*</span></label>
                                            <input id="price" name="price" type="number" class="form-control"
                                                placeholder="Enter price" maxlength="100" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image<span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image_path" name="image_path" accept="image/*"/>
                                                <label class="custom-file-label" for="image_path">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Event Description
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
        var eventUpdateUrl = "{{ route('event.update', [encrypt($data->id)]) }}";
    </script>
    <script>
        $(document).ready(function() {
        });

        function submitEvent() {
            $('#submitEventBtn').prop("disabled", true);

            // var formData = new FormData(document.getElementById('eventForm'));

            let name = $('input[name="name"]').val();
            let place = $('input[name="place"]').val();
            let date = $('input[name="date"]').val();
            let description = $('textarea[name="description"]').val();
            let pic = $('input[name="pic"]').val();
            let price = $('input[name="price"]').val();

            // formData.append('name', name);
            // formData.append('place', place);
            // formData.append('date', date);
            // formData.append('description', description);
            // formData.append('pic', pic);
            // formData.append('price', price);

            // formData.append('file', $('#image_path')[0].files[0]);

            $.ajax({
                url: eventUpdateUrl,
                type: "PATCH",
                data: {
                    name: name,
                    place: place,
                    date: date,
                    description: description,
                    pic: pic,
                    price: price,
                },
                contentType: false, // Don't set content type
                processData: false, // Don't process data (FormData does it for you)
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = "{{ route('event.index') }}";
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
