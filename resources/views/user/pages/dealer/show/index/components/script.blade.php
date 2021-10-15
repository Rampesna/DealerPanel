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
                            name: name
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
                            name: name
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
        var relation_type = 'App\\Models\\Dealer';
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
