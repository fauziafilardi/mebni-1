@extends('layouts.backend.app')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Input User</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    <a href="{{ route('user.index') }}" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="userForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name
                                                <span class="text-danger">*</span></label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="Enter event name" maxlength="100" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number
                                                <span class="text-danger">*</span></label>
                                            <input id="phone_number" name="phone_number" type="text" class="form-control"
                                                placeholder="Enter phone number" maxlength="20" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address
                                                <span class="text-danger">*</span></label>
                                            <textarea id="address" name="address" type="text" class="form-control"
                                                placeholder="Enter address" maxlength="100" rows="3" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email
                                                <span class="text-danger">*</span></label>
                                            <input id="email" name="email" type="email" class="form-control"
                                                placeholder="Enter email" maxlength="50" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password (min 8 characters)
                                                <span class="text-danger">*</span></label>
                                            <input id="password" name="password" type="password" class="form-control"
                                                placeholder="Enter password" maxlength="50" required onblur="confirmPassword()"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password (min 8 character)
                                                <span class="text-danger">*</span></label>
                                            <input id="confirm_password" name="confirm_password" type="password" class="form-control"
                                                placeholder="Enter confirm password" maxlength="50" required onblur="confirmPassword()"/>
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
                                            <label class="col-3 col-form-label">Verified Status</label>
                                            <div class="col-9 col-form-label">
                                                <div class="checkbox-list">
                                                    <label class="checkbox">
                                                        <input type="checkbox" id="is_verified" name="is_verified" checked/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Photo Profile</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="photo_profile" name="photo_profile" accept="image/*"/>
                                                <label class="custom-file-label" for="photo_profile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-primary mr-2" id="submitUserBtn"
                                    onclick="submitUser()">Submit</button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('input, textarea').on('input', function() {
                const $this = $(this);

                // Check if the input or textarea has content now
                if ($this.val()) {
                    // Remove error message and border if present
                    $this.next('.error-message').remove();
                    $this.removeClass('error-border');
                }
            });
        });

        function submitUser() {
            if (!validateForm()) {
                return; // Stop the execution if the form is not valid
            }

            $('#submitUserBtn').prop("disabled", true);

            var formData = new FormData(document.getElementById('userForm'));

            let name = $('input[name="name"]').val();
            let phone_number = $('input[name="phone_number"]').val();
            let address = $('textarea[name="address"]').val();
            let email = $('input[name="email"]').val();
            let password = $('input[name="password"]').val();
            let is_active = $('input[name="is_active"]:checked').val();
            let is_verified = $('input[name="is_verified"]:checked').val();


            formData.append('name', name);
            formData.append('phone_number', phone_number);
            formData.append('address', address);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('is_active', is_active);
            formData.append('is_verified', is_verified);

            formData.append('file', $('#photo_profile')[0].files[0]);

            $.ajax({
                url: "{{ route('user.store') }}",
                type: "POST",
                data: formData,
                contentType: false, // Don't set content type
                processData: false, // Don't process data (FormData does it for you)
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = "{{ route('user.index') }}";
                },
                error: function(error) {
                    $('#submitUserBtn').prop("disabled", false);

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

        function validateForm() {
            let isValid = true;

            // Remove previous error classes
            $('input, textarea, input[type="checkbox"]').removeClass('error-border');

            $('input, textarea, input[type="checkbox"]').each(function() {
                const $this = $(this);

                // Reset existing errors
                $this.next('.error-message').remove();

                if ($this.prop('required')) {
                    if ($this.is(':checkbox')) {
                        // Handle checkbox
                        if (!$this.is(':checked')) {
                            $this.after('<span class="error-message">This checkbox is required.</span>');
                            $this.addClass('error-border');
                            isValid = false;
                        }
                    } else {
                        // Handle input and textarea
                        if (!$this.val()) {
                            $this.after('<span class="error-message">This field is required.</span>');
                            $this.addClass('error-border');
                            isValid = false;
                        }
                    }
                }
            });

            // Password match validation
            const password = $('input[name="password"]').val();
            const confirmPassword = $('input[name="confirm_password"]').val();

            if (password !== confirmPassword) {
                $('input[name="confirm_password"]').after('<span class="error-message">Passwords must match.</span>');
                $('input[name="confirm_password"]').addClass('error-border');
                isValid = false;
            }

            return isValid;
        }

        function confirmPassword() {
            let isValid = true;
            // Password match validation
            const password = $('input[name="password"]').val();
            const confirmPassword = $('input[name="confirm_password"]').val();

            // Remove existing error message and error class
            $('input[name="confirm_password"]').next('.error-message').remove();
            $('input[name="confirm_password"]').removeClass('error-border');

            if (password !== confirmPassword) {
                // Add a new error message and error class
                $('input[name="confirm_password"]').after('<span class="error-message">Passwords must match.</span>');
                $('input[name="confirm_password"]').addClass('error-border');
                isValid = false;
            }

            return isValid;
        }

    </script>
@endsection
