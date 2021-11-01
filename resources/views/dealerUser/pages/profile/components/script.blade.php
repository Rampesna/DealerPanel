<script>

    var UpdatePasswordButton = $('#UpdatePasswordButton');

    UpdatePasswordButton.click(function () {
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var confirm_new_password = $('#confirm_new_password').val();

        if (old_password == null || old_password === '') {
            toastr.warning('Eski Şifrenizi Girmediniz.');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.dealerUser.password.check') }}',
                headers: {
                    _token: '{{ auth()->user()->apiToken() }}',
                    _auth_type: 'DealerUser'
                },
                data: {
                    dealer_user_id: '{{ auth()->id() }}',
                    password: old_password
                },
                success: function (response) {
                    if (response.response === 1) {
                        if (new_password == null || new_password === '') {
                            toastr.warning('Yeni Şifrenizi Girmediniz!');
                        } else if (confirm_new_password == null || confirm_new_password === '') {
                            toastr.warning('Yeni Şifre Tekrarını Girmediniz!');
                        } else if (new_password === confirm_new_password) {
                            $.ajax({
                                type: 'post',
                                url: '{{ route('api.v1.dealerUser.password.update') }}',
                                headers: {
                                    _token: '{{ auth()->user()->apiToken() }}',
                                    auth_type: 'DealerUser'
                                },
                                data: {
                                    dealer_user_id: '{{ auth()->id() }}',
                                    password: new_password
                                },
                                success: function (response) {
                                    console.log(response)
                                    toastr.success('Şifreniz Başarıyla Değiştirildi.');
                                    $('#PasswordForm').trigger('reset');
                                },
                                error: function (error) {
                                    console.log(error);
                                    toastr.error('Şifre Güncellenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                                }
                            });
                        } else {
                            toastr.warning('Yeni Şifreler Eşleşmiyor. Lütfen Kontrol Edin.');
                        }
                    } else {
                        toastr.warning('Eski Şifreniz Hatalı. Lütfen Kontrol Edip Tekrar Deneyin.');
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Eski Şifre Kontrolü Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

</script>
