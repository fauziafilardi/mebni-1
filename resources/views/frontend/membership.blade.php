@extends('layouts.frontend.app')

@section('content')
<main>
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="contact-title">Form Keanggotaan</h2>
                    <h2>Silahkan Pilih Kategori Keanggotaan (Perusahaan/Asosiasi, Perorangan)</h2>
                </div>
                <div class="col-lg-12 mt-5 mb-5">
                    <div class="row">
                        <div class="col-6" style="padding-right: 8px !important;">
                            <button type="button" class="button button-contactForm boxed-btn w-100 selected-btn" data-membership="C" id="companyBtn">Perusahaan / Asosiasi</button>
                        </div>
                        <div class="col-6" style="padding-left: 8px !important;">
                            <button type="button" class="button button-contactForm boxed-btn w-100" data-membership="P" id="personalBtn">Perorangan</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form class="form-contact contact_form" id="membershipForm">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label id="labelName" for="name" class="text-md-end">Company Name / Assosiation*</label>
                                <div class="form-group">
                                    <input class="form-control @error('name') is-invalid @else valid @enderror"
                                        name="name" id="name" type="text" value="{{ old('name') }}" required
                                        autocomplete="name" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label id="labelPhoneNumber" for="phone_number" class="text-md-end">Company/Asosiation Phone Number*</label>
                                <div class="form-group">
                                    <input class="form-control"
                                        name="phone_number" id="phone_number" type="number" value="{{ old('phone_number') }}" required
                                        autocomplete="phone_number" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter phone number'"
                                        placeholder="Enter phone number">

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="address" class="text-md-end">Address*</label>
                                <div class="form-group">
                                    <textarea
                                        class="form-control @error('address') is-invalid @else valid @enderror w-100"
                                        name="address" id="address" cols="30" rows="5" required
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Address'"
                                        placeholder=" Enter Address">{{ old('address') }}</textarea>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12" id="occupationDivX"></div>

                            <div class="col-sm-6" id="contactPersonDivX">
                                <div id="contactPersonDiv">
                                    <label for="contact_person" class="text-md-end">Contact Person*</label>
                                    <div class="form-group">
                                        <input class="form-control" name="contact_person" id="contact_person" type="text"
                                            value="" required autocomplete="contact_person"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter contact person'"
                                            placeholder="Enter contact person">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6" id="cpPhoneNumberDivX">
                                <div id="cpPhoneNumberDiv">
                                    <label for="cp_phone_number" class="text-md-end">Contact Person Phone Number*</label>
                                    <div class="form-group">
                                        <input class="form-control"
                                            name="cp_phone_number" id="cp_phone_number" type="number" value="{{ old('cp_phone_number') }}" required
                                            autocomplete="cp_phone_number" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter phone number'"
                                            placeholder="Enter phone number">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="email" class="text-md-end">Email*</label>
                                <div class="form-group">
                                    <input class="form-control @error('email') is-invalid @else valid @enderror"
                                        name="email" id="email" type="email" value="{{ old('email') }}" required
                                        autocomplete="email" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email address'"
                                        placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="password" class="text-md-end">Password*</label>
                                <div class="form-group password-wrapper">
                                    <input class="form-control password-field"
                                        name="password" id="password"
                                        type="password" required
                                        autocomplete="new-password" onfocus="this.placeholder = ''"
                                        onblur="confirmPassword()"
                                        placeholder="Enter password">
                                    <span class="dashicons dashicons-visibility password-toggle">
                                        <img src="{{ asset('assets/frontend/img/icon/show.jpg') }}" width="30px;" alt="">
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="confirm_password" class="text-md-end">Confirm Password*</label>
                                <div class="form-group password-wrapper">
                                    <input class="form-control password-field"
                                        name="confirm_password" id="confirm_password"
                                        type="password" required
                                        autocomplete="new-password"
                                        onfocus="this.placeholder = ''"
                                        onblur="confirmPassword()"
                                        placeholder="Confrim password">
                                    <span class="dashicons dashicons-visibility password-toggle">
                                        <img src="{{ asset('assets/frontend/img/icon/show.jpg') }}" width="30px;" alt="">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_agree" id="is_agree" value="1" checked required>
                                    <label class="form-check-label ml-3" for="is_agree" style="font-size: 20px;">
                                        Centang Bahwa Anda Mendukung Energi Nuklir Dimanfaatkan Di Indonesia*
                                    </label>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12"
                                style="text-align: -webkit-center; margin-top: 10px; margin-bottom: 15px">
                                <div class="g-recaptcha" data-sitekey="6LeSX1YbAAAAAKcP-erBCdT0_DD-I6kjfJoSrTDk">
                                </div>
                                <div id="captMsg"></div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" class="genric-btn mebni w-100" aria-selected="true" id="registerBtn"
                               style="font-size: 20px;" onclick="register()">Register</button>
                        </div>
                    </form>
                </div>
                <div class="col-12" id="noteDivX">
                    <div class="note" id="noteDiv" style="border-radius: 15px;">
                        <p class="m-0"><b style="color: #5aac4e;">Noted :</b></p>
                        <p class="m-0">Untuk para pendaftar <b style="color: #5aac4e;">Perusahaan / Asosiasi</b> akan dihubungi kembali oleh <b style="color: #5aac4e;">Admin MEBNI</b> terkait level keanggotaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .form-check-input {
        position: absolute;
        margin-top: 1.3rem !important;
        margin-left: -1.25rem;
    }
</style>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>

    $(document).ready(function() {
        const defaultBtn = $('#companyBtn');
        defaultBtn.attr('aria-selected', 'true').addClass('selected-btn');

        const defaultMembershipType = defaultBtn.data('membership');
        // console.log(`Default selected membership type is: ${defaultMembershipType}`);

        $('#companyBtn, #personalBtn').click(function() {
            const isSelected = $(this).attr('aria-selected') === 'true';
            const membershipType = $(this).data('membership');

            hideCondition(membershipType);

            $('#companyBtn, #personalBtn').attr('aria-selected', 'false').removeClass('selected-btn');

            $(this).attr('aria-selected', !isSelected);

            if (!isSelected) {
                $(this).addClass('selected-btn');
            }
            // console.log(`Selected membership type is: ${membershipType}`);
        });

        $('input, textarea').on('input', function() {
            const $this = $(this);

            // Check if the input or textarea has content now
            if ($this.val()) {
                // Remove error message and border if present
                $this.next('.error-message').remove();
                $this.removeClass('error-border');
            }
        });

        $(".password-toggle").click(function() {
            let $passwordField = $(this).siblings(".password-field");

            // Toggle input type
            if ($passwordField.attr("type") === "password") {
                $passwordField.attr("type", "text");
                $(this).find("img").attr("src", "{{ asset('assets/frontend/img/icon/hide.jpg') }}");
            } else {
                $passwordField.attr("type", "password");
                $(this).find("img").attr("src", "{{ asset('assets/frontend/img/icon/show.jpg') }}");
            }
        });
    });

    function register() {
        if (!validateForm()) {
            return; // Stop the execution if the form is not valid
        }

        var $overlay = $("<div class='overlay'> <div class='loader'> loading ... </div></div>");
        $('#registerBtn').prop("disabled", true);
        $('body').append($overlay);
        $overlay.height($(document).height());

        const selectedBtn = $('#companyBtn, #personalBtn').filter('[aria-selected="true"]');
        const membershipType = selectedBtn.data('membership');

        let name = $('input[name="name"]').val();
        let phone_number = $('input[name="phone_number"]').val();
        let address = $('textarea[name="address"]').val();
        let contact_person = $('input[name="contact_person"]').val();
        let cp_phone_number = $('input[name="cp_phone_number"]').val();
        let occupation = $('input[name="occupation"]').val();
        let is_agree = $('input[type="checkbox"][name="is_agree"]').prop("checked");
        let email = $('input[name="email"]').val();
        let password = $('input[name="password"]').val();
        let recaptcha = grecaptcha.getResponse();

        let formData = {
            name: name,
            phone_number: phone_number,
            address: address,
            contact_person: contact_person,
            cp_phone_number: cp_phone_number,
            occupation: occupation,
            is_agree: is_agree,
            email: email,
            password: password,
            recaptcha: recaptcha,
            membership_type: membershipType
        };

        $.ajax({
            url: "{{ route('register') }}",
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                grecaptcha.reset();
                window.location.href = "{{ route('login') }}";
            },
            error: function(error) {
                console.log(error);
                $('#registerBtn').prop("disabled", false);
                $('.overlay').remove();
                grecaptcha.reset();

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

                        if (field === 'recaptcha') {
                            $('#captMsg').html('<strong style="color: red">' + errorMsg + '</strong>');
                        }
                    }
                } else if (error.status === 500) {
                    if (error.responseJSON && error.responseJSON.error) {
                        alert('Error: ' + error.responseJSON.error);
                    }
                } else if (error.status === 401){
                    if (error.responseJSON && error.responseJSON.error) {
                    $('#captMsg').html('<strong style="color: red">' + error.responseJSON.error + '</strong>');
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

    function hideCondition(membershipType) {
        const labelName = $('#labelName');
        const labelPhoneNumber = $('#labelPhoneNumber');


        if (membershipType == "C") {
            $('#occupationDiv').remove();

            if ($('#contactPersonDiv').length === 0) {
                const contactPersonHTML = `<div id="contactPersonDiv">
                                            <label for="contact_person" class="text-md-end">Contact Person*</label>
                                            <div class="form-group">
                                                <input class="form-control" name="contact_person" id="contact_person" type="text"
                                                    value="" required autocomplete="contact_person"
                                                    onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = 'Enter contact person'"
                                                    placeholder="Enter contact person">
                                            </div>
                                        </div>`;
                $('#contactPersonDivX').append(contactPersonHTML);
            }

            if ($('#cpPhoneNumberDiv').length === 0) {
                const cpPhoneNumberHTML = `<div id="cpPhoneNumberDiv">
                                            <label for="cp_phone_number" class="text-md-end">Contact Person Phone Number*</label>
                                            <div class="form-group">
                                                <input class="form-control"
                                                    name="cp_phone_number" id="cp_phone_number" type="number" value="{{ old('cp_phone_number') }}" required
                                                    autocomplete="cp_phone_number" onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = 'Enter phone number'"
                                                    placeholder="Enter phone number">
                                            </div>
                                        </div>`;
                $('#cpPhoneNumberDivX').append(cpPhoneNumberHTML);
            }

            if ($('#noteDiv').length === 0) {
                const noteHTML = `<div class="note" id="noteDiv">
                                    <p class="m-0"><b>Noted :</b></p>
                                    <p class="m-0">Untuk para pendaftar <b>Perusahaan / Asosiasi</b> akan dihubungi kembali oleh <b>Admin MEBNI</b> terkait level keanggotaan.</p>
                                </div>`;
                $('#noteDivX').append(noteHTML);
            }

            labelName.text('Company Name / Assosiation*');
            labelPhoneNumber.text('Company/Asosiation Phone Number*');


            $('#occupation').removeAttr('required');
            $('#contact_person').attr('required', 'required');
            $('#cp_phone_number').attr('required', 'required');
        } else if (membershipType == 'P') {
            $('#contactPersonDiv').remove();
            $('#cpPhoneNumberDiv').remove();
            $('#noteDiv').remove();

            if ($('#occupationDiv').length === 0) {
                const occupationHTML = `<div id="occupationDiv">
                                            <label for="occupation" class="text-md-end">Occupation*</label>
                                            <div class="form-group">
                                                <input class="form-control" name="occupation" id="occupation" type="text"
                                                    value="" required autocomplete="occupation"
                                                    onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = 'Enter occupation'"
                                                    placeholder="Enter occupation">
                                            </div>
                                        </div>`;
                $('#occupationDivX').append(occupationHTML);
            }

            labelName.text('Full Name*');
            labelPhoneNumber.text('Phone Number*');
        }
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
