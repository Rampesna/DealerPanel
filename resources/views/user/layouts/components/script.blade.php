<script>

    var LogoutButton = $('#LogoutButton');

    LogoutButton.click(function () {
        $.ajax({
            type: 'post',
            url: '{{ route('user.logout') }}',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function () {
                $(location).prop('href', '{{ route('user.login') }}');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Çıkış Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    });

</script>
