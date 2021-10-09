<script>

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    var emailInput = $('#email');
    var passwordInput = $('#password');

    var LoginButton = $('#LoginButton');

    LoginButton.click(function () {
        var email = emailInput.val();
        var password = passwordInput.val();

        if (email == null || email === '') {
            toastr.warning('E-posta Adresinizi Girmediniz!');
            emailInput.focus();
        } else if (!isEmail(email)) {
            toastr.warning('Lütfen E-posta Adresinizi Doğru Girin!');
            emailInput.focus();
        } else if (password == null || password === '') {
            toastr.warning('Şifrenizi Girmediniz!');
            passwordInput.focus();
        } else {
            LoginButton.attr('disabled', true);
            $.ajax({
                type: 'post',
                url: '{{ route('api.v1.user.auth.login') }}',
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.oAuthLogin') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            api_token: response.response.api_token
                        },
                        success: function () {
                            $(location).prop('href', '{{ route('user.dashboard.index') }}')
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Giriş Yapılırken Sistemsel Bir Sorun Oluştu!');
                            LoginButton.attr('disabled', false);
                        }
                    });
                },
                error: function (error) {
                    if (parseInt(error.responseJSON.code) === 404) {
                        toastr.error('Sistemde Kayıtlı Böyle Bir Kullanıcı Bulunamadı.');
                    }

                    if (parseInt(error.responseJSON.code) === 400) {
                        toastr.error('Girdiğiniz Bilgiler Eşleşmiyor!');
                    }

                    LoginButton.attr('disabled', false);
                }
            });
        }
    });

</script>
