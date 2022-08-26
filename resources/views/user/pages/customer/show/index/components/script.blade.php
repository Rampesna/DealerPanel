<script>

    var customerInformation = null;

    var EditButton = $('#EditButton');
    var AddRelationServiceButton = $('#AddRelationServiceButton');
    var AddReceiptButton = $('#AddReceiptButton');
    var UpdateButton = $('#UpdateButton');

    var dealer_id_edit = $('#dealer_id_edit');

    var service_id_create = $('#service_id_create');
    var service_id_edit = $('#service_id_edit');

    var status_id_create = $('#status_id_create');
    var status_id_edit = $('#status_id_edit');

    var country_id_edit = $('#country_id_edit');
    var province_id_edit = $('#province_id_edit');
    var district_id_edit = $('#district_id_edit');

    EditButton.click(function () {
        var id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.customer.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function (response) {
                dealer_id_edit.val(response.response.dealer_id).selectpicker('refresh');
                $('#tax_number_edit').val(response.response.tax_number);
                $('#name_edit').val(response.response.name);
                $('#email_edit').val(response.response.email);
                $('#gsm_edit').val(response.response.gsm);
                $('#tax_office_edit').val(response.response.tax_office);
                $('#website_edit').val(response.response.website);
                $('#foundation_date_edit').val(response.response.foundation_date);
                country_id_edit.val(response.response.country_id).selectpicker('refresh');
                getProvincesForEdit(response.response.province_id);
                getDistrictsForEdit(response.response.district_id);
                $('#EditModal').modal('show');
            },
            error: function () {

            }
        });
    });

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
                var credits = response.response;
                $.ajax({
                    type: 'get',
                    url: '{{ route('api.v1.user.bienSoapService.usageReport') }}',
                    headers: {
                        _token: '{{ auth()->user()->apiToken() }}',
                        _auth_type: 'User',
                    },
                    data: {
                        tax_number: customerInformation.tax_number,
                        start_date: '2015-01-01T00:00:00',
                        end_date: '2050-01-01T00:00:00'
                    },
                    success: function (usageResponse) {
                        console.log(usageResponse);
                        var total = 0;
                        $.each(credits, function (i, credit) {
                            if (credit.direction === 1) total += credit.amount;
                        });
                        var remaining = total - usageResponse.response;
                        $('#totalCreditSpan').html(reformatFloatNumber(total));
                        $('#usedCreditSpan').html(reformatFloatNumber(usageResponse.response));
                        $('#remainingCreditSpan').html(reformatFloatNumber(remaining));
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Kontör Kullanım Raporu Alınırken Serviste Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
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
                var balance = outgoing - incoming;
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
                    service_id_create.append(`<option value="${service.id}">${service.name} (${service.credit_amount} Kontör)</option>`);
                    service_id_edit.append(`<option value="${service.id}">${service.name} (${service.credit_amount} Kontör)</option>`);
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

    function getCustomer() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('api.v1.user.customer.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: '{{ $id }}'
            },
            success: function (response) {
                customerInformation = response.response;
                $('#id_edit').val(response.response.id);
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

    function getDealers() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.all') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                dealer_id_edit.empty();
                $.each(response.response, function (i, dealer) {
                    dealer_id_edit.append(`<option value="${dealer.id}">${dealer.name}</option>`);
                });
                dealer_id_edit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.l');
            }
        });
    }

    function getCountries() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.country.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'User'
            },
            data: {},
            success: function (response) {
                country_id_edit.empty();
                country_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, country) {
                    country_id_edit.append(`<option value="${country.id}">${country.name}</option>`);
                });
                country_id_edit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ülke Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getProvincesForEdit(province_id) {
        var country_id = country_id_edit.val();
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('api.v1.general.province.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'User'
            },
            data: {
                country_id: country_id
            },
            success: function (response) {
                province_id_edit.empty();
                province_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, province) {
                    province_id_edit.append(`<option ${parseInt(province_id) === parseInt(province.id) ? 'selected' : ''} value="${province.id}">${province.name}</option>`);
                });
                province_id_edit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şehir Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getDistrictsForEdit(district_id) {
        var province_id = province_id_edit.val();
        console.log(province_id)
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.district.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'User'
            },
            data: {
                province_id: province_id
            },
            success: function (response) {
                district_id_edit.empty();
                district_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, district) {
                    district_id_edit.append(`<option ${parseInt(district_id) === parseInt(district.id) ? 'selected' : ''} value="${district.id}">${district.name}</option>`);
                });
                district_id_edit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İlçe Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.customer.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                toastr.success('Başarıyla Kaydedildi!');
                $('#EditModal').modal('hide');
                getCustomer();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCustomer();
    getDealers();
    getCustomerCredits();
    getCustomerFinance();
    getServices();
    getCustomerServiceStatuses();
    getCountries();

    AddRelationServiceButton.click(function () {
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $id }}';
        var creator_type = 'App\\Models\\User';
        var creator_id = '{{ auth()->id() }}';
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
                creator_type: creator_type,
                creator_id: creator_id,
                service_id: service_id,
                start: start,
                end: end,
                amount: amount,
                status_id: status_id
            });
        }
    });

    AddReceiptButton.click(function () {
        var creatorType = 'App\\Models\\User';
        var creatorId = '{{ auth()->id() }}';
        var relationType = 'App\\Models\\Customer';
        var relationId = '{{ $id }}';
        var amount = $('#price').val();

        if (price == null || price === '') {
            toastr.warning('Alınacak Ödeme Miktarı Boş Olamaz!');
        } else if (price <= 0) {
            toastr.warning('Alınacak Ödeme Miktarı Sıfır veya Aşağısı Olamaz!');
        } else {
            $('#AddReceiptModal').modal('hide');
            $('#loader').show();
            $.ajax({
                type: 'post',
                url: '{{ route('api.v1.user.payment.create') }}',
                data: {
                    creatorType: creatorType,
                    creatorId: creatorId,
                    relationType: relationType,
                    relationId: relationId,
                    amount: amount
                },
                success: function (encryptedOrderId) {
                    $('#loader').hide();
                    $('#paymentLink').attr('href', `{{ route('payment.gateway') }}/${encryptedOrderId}`).html(`Ödeme Sayfasına Gitmek İçin Tıklayın`);
                    $('#ShowPaymentLinkModal').modal('show');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Oluşturulurken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateButton.click(function () {
        var id = $('#id_edit').val();
        var dealer_id = $('#dealer_id_edit').val();
        var tax_number = $('#tax_number_edit').val();
        var name = $('#name_edit').val();
        var email = $('#email_edit').val();
        var gsm = $('#gsm_edit').val();
        var tax_office = $('#tax_office_edit').val();
        var website = $('#website_edit').val();
        var foundation_date = $('#foundation_date_edit').val();
        var country_id = country_id_edit.val();
        var province_id = province_id_edit.val();
        var district_id = district_id_edit.val();

        if (dealer_id == null || dealer_id === '') {
            toastr.warning('Bayi Seçilmesi Zorunludur!');
        } else if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz!');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır!');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olmalıdır!');
        } else if (name == null || name === '') {
            toastr.warning('Müşteri Ünvanı Boş Olamaz!');
        } else if (email == null || email === '') {
            toastr.warning('E-posta Adresi Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.customer.checkTaxNumber') }}',
                data: {
                    tax_number: tax_number,
                    except_id: id
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu Vergi Numarasına Ait Müşteri Zaten Sistemde Kayıtlı!');
                    } else {
                        save('post', {
                            id: id,
                            dealer_id: dealer_id,
                            tax_number: tax_number,
                            name: name,
                            email: email,
                            gsm: gsm,
                            tax_office: tax_office,
                            website: website,
                            foundation_date: foundation_date,
                            country_id: country_id,
                            province_id: province_id,
                            district_id: district_id,
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vergi Numarası Kontrolü Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    country_id_edit.change(function () {
        province_id_edit.empty().selectpicker('refresh');
        district_id_edit.empty().selectpicker('refresh');
        getProvincesForEdit();
    });

    province_id_edit.change(function () {
        district_id_edit.empty().selectpicker('refresh');
        getDistrictsForEdit();
    });

</script>
