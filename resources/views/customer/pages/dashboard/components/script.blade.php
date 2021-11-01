<script>

    function getCredits() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.customer.credit.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'Customer'
            },
            data: {
                relation_type: 'App\\Models\\Customer',
                relation_id: '{{ auth()->id() }}'
            },
            success: function (response) {
                var total = 0;
                var used = 0;
                $.each(response.response, function (i, credit) {
                    if (credit.direction === 1) total += credit.amount;
                    if (credit.direction === 0) used += credit.amount;
                });
                var remaining = total - used;
                $('#creditSpan').html(remaining);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kontör Bilgisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getReceipts() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.customer.receipt.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'Customer'
            },
            data: {
                relation_type: 'App\\Models\\Customer',
                relation_id: '{{ auth()->id() }}'
            },
            success: function (response) {
                var outgoing = 0;
                var incoming = 0;
                $.each(response.response, function (i, receipt) {
                    if (receipt.direction === 1) outgoing += receipt.price;
                    if (receipt.direction === 0) incoming += receipt.price;
                });
                var balance = outgoing - incoming;
                $('#balanceSpan').html(`${balance} TL`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bakiye Bilgisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getSupportRequests() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.customer.supportRequest.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'Customer'
            },
            data: {
                creator_type: 'App\\Models\\Customer',
                creator_id: '{{ auth()->id() }}'
            },
            success: function (response) {
                var counter = 0;
                $.each(response.response, function (i, supportRequest) {
                    if (supportRequest.status_id === 1) counter += 1;
                });
                $('#supportRequestsSpan').html(counter);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talepleri Bilgisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCredits();
    getReceipts();
    getSupportRequests();

</script>
