<script>

    function getCustomers() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.customer.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                var accepted = 0;
                var waiting = 0;
                $.each(response.response, function (i, customer) {
                    if (customer.transaction_status_id === 2) accepted += 1;
                    if (customer.transaction_status_id === 1) waiting += 1;
                });
                $('#acceptedCustomerSpan').html(accepted);
                $('#waitingCustomerSpan').html(waiting);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getDealers() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                var accepted = 0;
                var waiting = 0;
                $.each(response.response, function (i, dealer) {
                    if (dealer.transaction_status_id === 2) accepted += 1;
                    if (dealer.transaction_status_id === 1) waiting += 1;
                });
                $('#acceptedDealerSpan').html(accepted);
                $('#waitingDealerSpan').html(waiting);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getOpportunities() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.opportunity.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                $('#opportunitiesSpan').html(Object.keys(response.response).length);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCustomers();
    getDealers();
    getOpportunities();

</script>
