<script>

    var AddServiceModalTriggerButton = $('#AddServiceModalTriggerButton');
    var AddServiceButton = $('#AddServiceButton');

    var service_id_create = $('#service_id_create');
    var status_id_create = $('#status_id_create');

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.dealerUser.customer.service.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: data,
            success: function () {
                $('#AddServiceForm').trigger('reset');
                service_id_create.selectpicker('refresh');
                status_id_create.selectpicker('refresh');
                $('#AddServiceModal').modal('hide');
                toastr.success('Hizmet Talebi Alındı. Onaylanması Bekleniyor.');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

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

    function getServices() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.service.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                service_id_create.empty();
                service_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, service) {
                    service_id_create.append(`<option value="${service.id}">${service.name}</option>`);
                });
                service_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Hizmet Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCustomerServiceStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.relationServiceStatus.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                status_id_create.empty();
                status_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, customerServiceStatus) {
                    status_id_create.append(`<option value="${customerServiceStatus.id}">${customerServiceStatus.name}</option>`);
                });
                status_id_create.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    getCustomer();
    getServices();
    getCustomerCredits();
    getCustomerServiceStatuses();

    AddServiceModalTriggerButton.click(function () {
        $('#AddServiceModal').modal('show');
    });

    AddServiceButton.click(function () {
        var creator_type = 'App\\Models\\Dealer';
        var creator_id = '{{ auth()->id() }}';
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $id }}';
        var service_id = service_id_create.val();
        var start = $('#start_create').val();
        var end = $('#end_create').val();
        var amount = $('#amount_create').val();
        var status_id = status_id_create.val();

        if (relation_type === '' || relation_id === '') {
            toastr.warning('Müşteri Bağlantısından Bir Sorun Oluştu. Lütfen Sayfayı Yenileyip Tekrar Deneyin. Sorun Devam Ederse Geliştirici Ekibi İle İletişime Geçin.');
        } else if (service_id == null || service_id === '') {
            toastr.warning('Hizmet Seçimi Zorunludur!');
        } else if (start == null || start === '') {
            toastr.warning('Hizmet Başlangıcı Seçimi Zorunludur!');
        } else if (end == null || end === '') {
            toastr.warning('Hizmet Bitişi Seçimi Zorunludur!');
        } else if (amount == null || amount === '') {
            toastr.warning('Hizmet Adedi Girilmesi Zorunludur!');
        } else if (status_id == null || status_id === '') {
            toastr.warning('Hizmet Durumu Girilmesi Zorunludur!');
        } else {
            save('post', {
                creator_type: creator_type,
                creator_id: creator_id,
                relation_type: relation_type,
                relation_id: relation_id,
                service_id: service_id,
                start: start,
                end: end,
                amount: amount,
                status_id: status_id
            });
        }
    });

</script>
