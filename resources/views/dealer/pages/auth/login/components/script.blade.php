<script>

    var taxNumberInput = $('#tax_number');
    var passwordInput = $('#password');

    var LoginButton = $('#LoginButton');

    LoginButton.click(function () {
        var tax_number = taxNumberInput.val();
        var password = passwordInput.val();

        if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numaranızı Girmediniz');
            taxNumberInput.focus();
        } else if (password == null || password === '') {
            toastr.warning('Şifrenizi Girmediniz!');
            passwordInput.focus();
        } else {
            LoginButton.attr('disabled', true);
            $.ajax({
                type: 'post',
                url: '{{ route('api.v1.auth.login.dealer') }}',
                data: {
                    tax_number: tax_number,
                    password: password
                },
                success: function (response) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('dealer.oAuthLogin') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            api_token: response.response.api_token
                        },
                        success: function () {
                            $(location).prop('href', '{{ route('dealer.dashboard.index') }}')
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
