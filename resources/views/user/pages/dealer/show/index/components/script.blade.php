<script src="{{ asset('assets/plugins/custom/jstree/jstree.bundle.js') }}"></script>

<script>

    var CreateButton = $('#CreateButton');
    var UpdateButton = $('#UpdateButton');
    var DeleteButton = $('#DeleteButton');
    var AddRelationServiceButton = $('#AddRelationServiceButton');
    var AddReceiptButton = $('#AddReceiptButton');

    var service_id_create = $('#service_id_create');
    var service_id_edit = $('#service_id_edit');

    var status_id_create = $('#status_id_create');
    var status_id_edit = $('#status_id_edit');

    var country_id_create = $('#country_id_create');
    var country_id_edit = $('#country_id_edit');

    var province_id_create = $('#province_id_create');
    var province_id_edit = $('#province_id_edit');

    var district_id_create = $('#district_id_create');
    var district_id_edit = $('#district_id_edit');

    var DeleteContext = $('#DeleteContext');

    function getDealerCredits() {
        var relation_type = 'App\\Models\\Dealer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.credit.index') }}',
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
                $('#totalCreditSpan').html(reformatFloatNumber(total));
                $('#usedCreditSpan').html(reformatFloatNumber(used));
                $('#remainingCreditSpan').html(reformatFloatNumber(remaining));
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getDealerFinance() {
        var relation_type = 'App\\Models\\Dealer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.receipt.index') }}',
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

    function create() {
        $('#CreateModal').modal('show');
    }

    function edit() {
        var id = $('#dealer_id_edit').val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function (response) {
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
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function drop() {
        $('#DeleteModal').modal('show');
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.dealer.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                toastr.success('Başarıyla Kaydedildi');
                $('#CreateModal').modal('hide');
                $('#CreateForm').trigger('reset');
                $('#EditModal').modal('hide');
                jsTree.jstree('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Eklenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
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
            type: 'post',
            url: '{{ route('api.v1.user.dealer.receipt.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                $('#AddReceiptForm').trigger('reset');
                $('#AddReceiptModal').modal('hide');
                toastr.success('Ödeme Başarıyla Alındı');
                getDealerFinance();
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
                country_id_create.empty();
                country_id_edit.empty();
                country_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                country_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, country) {
                    country_id_create.append(`<option value="${country.id}">${country.name}</option>`);
                    country_id_edit.append(`<option value="${country.id}">${country.name}</option>`);
                });
                country_id_create.selectpicker('refresh');
                country_id_edit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ülke Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getProvincesForCreate() {
        var country_id = country_id_create.val();
        $.ajax({
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
                province_id_create.empty();
                province_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, province) {
                    province_id_create.append(`<option value="${province.id}">${province.name}</option>`);
                });
                province_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şehir Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
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

    function getDistrictsForCreate() {
        var province_id = province_id_create.val();
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
                district_id_create.empty();
                district_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, district) {
                    district_id_create.append(`<option value="${district.id}">${district.name}</option>`);
                });
                district_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İlçe Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
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

    getCountries();
    getDealerCredits();
    getDealerFinance();
    getServices();
    getCustomerServiceStatuses();

    var jsTree = $("#jsTree").jstree({
        plugins: [
            'dnd',
            'types',
            'conditionalselect',
            'state',
            'contextmenu'
        ],
        contextmenu: {
            items: {}
        },
        core: {
            themes: {
                responsive: false
            },
            check_callback: true,
            data: {
                url: '{{ route('api.v1.user.dealer.jsTree') }}',
                headers: {
                    _token: '{{ auth()->user()->apiToken() }}',
                    _auth_type: 'User'
                },
                data: {
                    dealer_id: '{{ $id }}'
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Bayi Hiyerarşisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            }
        }
    });

    $('body').on('contextmenu', function (e) {
        var nodeData = jsTree.jstree().get_selected(true)[0];
        $('#dealer_id_edit').val(nodeData.original.dealer_id);
        $('#deleting').html(nodeData.original.text);

        nodeData.original.top_id == null ? DeleteContext.hide() : DeleteContext.show();

        var top = e.pageY - 10;
        var left = e.pageX - 10;

        $("#context-menu").css({
            display: "block",
            top: top,
            left: left
        });

        return false;
    }).on("click", function (e) {
        $("#context-menu").hide();
        if (!$.contains($("#JsTreeCardSelector").get(0), e.target)) {
            jsTree.jstree().deselect_all(true);
        }
    });

    CreateButton.click(function () {
        var top_id = $('#dealer_id_edit').val();
        var tax_number = $('#tax_number_create').val();
        var name = $('#name_create').val();
        var email = $('#email_create').val();
        var gsm = $('#gsm_create').val();
        var tax_office = $('#tax_office_create').val();
        var website = $('#website_create').val();
        var foundation_date = $('#foundation_date_create').val();
        var country_id = country_id_create.val();
        var province_id = province_id_create.val();
        var district_id = district_id_create.val();

        if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olmalıdır');
        } else if (name == null || name === '') {
            toastr.warning('Bayi Ünvanı Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.dealer.checkTaxNumber') }}',
                data: {
                    tax_number: tax_number
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu Vergi Numarasına Ait Bayi Zaten Sistemde Kayıtlı!');
                    } else {
                        save('post', {
                            top_id: top_id,
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

    UpdateButton.click(function () {
        var id = $('#dealer_id_edit').val();
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

        if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olmalıdır');
        } else if (name == null || name === '') {
            toastr.warning('Bayi Ünvanı Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.dealer.checkTaxNumber') }}',
                data: {
                    tax_number: tax_number,
                    except_id: id
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu Vergi Numarasına Ait Bayi Zaten Sistemde Kayıtlı!');
                    } else {
                        save('put', {
                            id: id,
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

    DeleteButton.click(function () {
        var id = $('#dealer_id_edit').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('api.v1.user.dealer.drop') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function () {
                toastr.success('Başarıyla Silindi');
                $('#DeleteModal').modal('hide');
                jsTree.jstree('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Silinirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    AddRelationServiceButton.click(function () {
        var creator_type = 'App\\Models\\User';
        var creator_id = '{{ auth()->id() }}';
        var relation_type = 'App\\Models\\Dealer';
        var relation_id = '{{ $id }}';
        var service_id = service_id_create.val();
        var start = $('#start_create').val();
        var end = $('#end_create').val();
        var amount = $('#amount_create').val();
        var status_id = status_id_create.val();

        if (relation_type === '' || relation_id === '') {
            toastr.warning('Bayi Bağlantısından Bir Sorun Oluştu. Lütfen Sayfayı Yenileyip Tekrar Deneyin. Sorun Devam Ederse Geliştirici Ekibi İle İletişime Geçin.');
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

    AddReceiptButton.click(function () {
        var creator_type = 'App\\Models\\User';
        var creator_id = '{{ auth()->id() }}';
        var relation_type = 'App\\Models\\Dealer';
        var relation_id = '{{ $id }}';
        var price = $('#price').val();

        if (price == null || price === '') {
            toastr.warning('Alınacak Ödeme Miktarı Boş Olamaz!');
        } else if (price <= 0) {
            toastr.warning('Alınacak Ödeme Miktarı Sıfır veya Aşağısı Olamaz!');
        } else {
            addReceipt('post', {
                creator_type: creator_type,
                creator_id: creator_id,
                relation_type: relation_type,
                relation_id: relation_id,
                price: price,
                direction: 0
            });
        }
    });

    country_id_create.change(function () {
        province_id_create.empty().selectpicker('refresh');
        district_id_create.empty().selectpicker('refresh');
        getProvincesForCreate();
    });

    country_id_edit.change(function () {
        province_id_edit.empty().selectpicker('refresh');
        district_id_edit.empty().selectpicker('refresh');
        getProvincesForEdit();
    });

    province_id_create.change(function () {
        district_id_create.empty().selectpicker('refresh');
        getDistrictsForCreate();
    });

    province_id_edit.change(function () {
        district_id_edit.empty().selectpicker('refresh');
        getDistrictsForEdit();
    });

</script>
