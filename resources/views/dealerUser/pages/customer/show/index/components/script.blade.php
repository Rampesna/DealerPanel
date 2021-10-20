<script>

    function getCustomerCredits() {
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.customer.credit.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                relation_type: relation_type,
                relation_id: relation_id,
                transaction_status_id: 2
            },
            success: function (response) {
                var total = 0;
                var used = 0;
                $.each(response.response, function (i, credit) {
                    if (credit.direction === 1) total += credit.amount;
                    if (credit.direction === 0) used += credit.amount;
                });
                var remaining = total - used;
                $('#totalCreditSpan').html(total);
                $('#usedCreditSpan').html(used);
                $('#remainingCreditSpan').html(remaining);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCustomer() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.customer.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                id: '{{ $id }}'
            },
            success: function (response) {
                $('#dealer_id_span').html(response.response.dealer ? response.response.dealer.name : '--');
                $('#name_span').html(response.response.name ?? '--');
                $('#tax_number_span').html(response.response.tax_number ?? '--');
                $('#tax_office_span').html(response.response.tax_office ?? '--');
                $('#email_span').html(response.response.email ?? '--');
                $('#gsm_span').html(response.response.gsm ?? '--');
                $('#website_span').html(response.response.website ?? '--');
                $('#foundation_date_span').html(response.response.foundation_date ? reformatDateForHuman(response.response.foundation_date) : '--');
                $('#country_id_span').html(response.response.country ? response.response.country.name : '--');
                $('#province_id_span').html(response.response.province ? response.response.province.name : '--');
                $('#district_id_span').html(response.response.district ? response.response.district.name : '--');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCustomer();
    getCustomerCredits();

</script>
