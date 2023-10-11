function register() {
    var $overlay = $("<div class='overlay'> <div class='loader'> <img src='{{ asset('assets/frontend/img/logo/logo_mebni.png') }}' alt=''></div></div>");
    $('#registerBtn').prop("disabled", true);
    $('body').append($overlay);
    $overlay.height($(document).height());

    let responden = $('input[name="responden"]').val();
    let message = $('textarea[name="message"]').val();

    let name = $('input[name="name"]').val();
    let email = $('input[name="email"]').val();
    let phone = $('input[name="phone"]').val();
    let address = $('textarea[name="address"]').val();
    let occupation = $('input[name="occupation"]').val();
    let password = $('input[name="password"]').val();
    let recaptcha = grecaptcha.getResponse();

    let formData = {
        name: name,
        email: email,
        phone: phone,
        address: address,
        occupation: occupation,
        password: password,
        recaptcha: recaptcha,
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
            $('.overlay').remove();
            grecaptcha.reset();
            if (error.responseJSON && error.responseJSON.error) {
                $('#captMsg').html('<strong style="color: red">' + error.responseJSON.error + '</strong>');
            } else {
            }
        },
        complete: function() {
            // Remove overlay
            $('.overlay').remove();
        }
    });
}
