<script>

    var AddRelationServiceButton = $('#AddRelationServiceButton');
    var AddReceiptButton = $('#AddReceiptButton');

    var service_id_create = $('#service_id_create');
    var service_id_edit = $('#service_id_edit');

    var status_id_create = $('#status_id_create');
    var status_id_edit = $('#status_id_edit');

    function getCustomerCredits() {
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.customer.credit.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
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
                toastr.error('Bayi Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCustomerFinance() {
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.customer.receipt.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                relation_type: relation_type,
                relation_id: relation_id,
            },
            success: function (response) {
                var outgoing = 0;
                var incoming = 0;
                $.each(response.response, function (i, receipt) {
                    if (receipt.direction === 1) outgoing += receipt.price;
                    if (receipt.direction === 0) incoming += receipt.price;
                });
                var balance = incoming - outgoing;
                $('#outgoingSpan').html(`${outgoing} TL`);
                $('#incomingSpan').html(`${incoming} TL`);
                $('#balance').html(`${balance} TL`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function addRelationService(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.customer.service.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                $('#AddRelationServiceForm').trigger('reset');
                service_id_create.selectpicker('refresh');
                status_id_create.selectpicker('refresh');
                $('#AddRelationServiceModal').modal('hide');
                toastr.success('Hizmet Talebi Alındı. Onaylanması Bekleniyor.');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function addReceipt(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.customer.receipt.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                $('#AddReceiptForm').trigger('reset');
                $('#AddReceiptModal').modal('hide');
                toastr.success('Ödeme Başarıyla Alındı');
                getCustomerFinance();
            },
            error: function (error) {
                console.log(error)
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
                service_id_edit.empty();
                service_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                service_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, service) {
                    service_id_create.append(`<option value="${service.id}">${service.name}</option>`);
                    service_id_edit.append(`<option value="${service.id}">${service.name}</option>`);
                });
                service_id_create.selectpicker('refresh');
                service_id_edit.selectpicker('refresh');
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
                status_id_edit.empty();
                status_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                status_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, customerServiceStatus) {
                    status_id_create.append(`<option value="${customerServiceStatus.id}">${customerServiceStatus.name}</option>`);
                    status_id_edit.append(`<option value="${customerServiceStatus.id}">${customerServiceStatus.name}</option>`);
                });
                status_id_create.selectpicker('refresh');
                status_id_edit.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    getCustomerCredits();
    getCustomerFinance();
    getServices();
    getCustomerServiceStatuses();

    AddRelationServiceButton.click(function () {
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
            addRelationService('post', {
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

    AddReceiptButton.click(function () {
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $id }}';
        var price = $('#price').val();

        if (price == null || price === '') {
            toastr.warning('Alınacak Ödeme Miktarı Boş Olamaz!');
        } else if (price <= 0) {
            toastr.warning('Alınacak Ödeme Miktarı Sıfır veya Aşağısı Olamaz!');
        } else {
            addReceipt('post', {
                relation_type: relation_type,
                relation_id: relation_id,
                price: price,
                direction: 0
            });
        }
    });

</script>
