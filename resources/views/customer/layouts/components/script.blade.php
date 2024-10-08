<script>

    var LogoutButton = $('#LogoutButton');

    LogoutButton.click(function () {
        $.ajax({
            type: 'post',
            url: '{{ route('customer.logout') }}',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function () {
                $(location).prop('href', '{{ route('customer.login') }}');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Çıkış Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    });

</script>
