<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');
    var AcceptButton = $('#AcceptButton');

    var service_id_create = $('#service_id_create');
    var status_id_create = $('#status_id_create');

    function create() {
        $('#CreateModal').modal('show');
    }

    function accept() {
        $('#AcceptModal').modal('show');
    }

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
                $('#CreateForm').trigger('reset');
                service_id_create.selectpicker('refresh');
                status_id_create.selectpicker('refresh');
                $('#CreateModal').modal('hide');
                toastr.success('Hizmet Talebi Alındı. Onaylanması Bekleniyor.');
                services.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
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

    getServices();
    getCustomerServiceStatuses();

    var relationServices = $('#relationServices').DataTable({
        language: {
            info: "_TOTAL_ Kayıttan _START_ - _END_ Arasındaki Kayıtlar Gösteriliyor.",
            infoEmpty: "Gösterilecek Hiç Kayıt Yok.",
            loadingRecords: "Kayıtlar Yükleniyor.",
            zeroRecords: "Tablo Boş",
            search: "Arama:",
            infoFiltered: "(Toplam _MAX_ Kayıttan Filtrelenenler)",
            lengthMenu: "Sayfa Başı _MENU_ Kayıt Göster",
            sProcessing: "Yükleniyor...",
            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
            select: {
                rows: {
                    "_": "%d kayıt seçildi",
                    "0": "",
                    "1": "1 kayıt seçildi"
                }
            },
            buttons: {
                print: {
                    title: 'Yazdır'
                }
            }
        },

        dom: 'Brtipl',

        order: [
            [
                0,
                "desc"
            ]
        ],

        buttons: [
            {
                extend: 'collection',
                text: '<i class="fa fa-download"></i> Dışa Aktar',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF İndir'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Excel İndir'
                    }
                ]
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Yazdır'
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i> Sütunlar'
            },
            {
                text: '<i class="fas fa-undo"></i> Yenile',
                action: function (e, dt, node, config) {
                    $('table input').val('');
                    services.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#relationServices tfoot tr');
            $('#relationServices thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');

                if (index === 1 || index === 2) {
                    input.setAttribute("type", "date");
                }

                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
            });
        },

        processing: true,
        serverSide: true,
        ajax: {
            type: 'get',
            url: '{{ route('api.v1.dealerUser.customer.service.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                relation_type: 'App\\Models\\Customer',
                relation_id: '{{ $id }}'
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'service_id', name: 'service_id'},
            {data: 'start', name: 'start'},
            {data: 'end', name: 'end'},
            {data: 'amount', name: 'amount'},
            {data: 'transaction_status', name: 'transaction_status'},
        ],

        responsive: true,
        colReorder: true,
        stateSave: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = relationServices.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            var transaction_status_id = selectedRows.data()[0].transaction_status_id;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);

            if (transaction_status_id === 1) {
                $("#EditingContexts").show();
            } else {
                $("#EditingContexts").hide();
            }

        } else {
            $("#EditingContexts").hide();
        }

        var top = e.pageY - 10;
        var left = e.pageX - 10;

        $("#context-menu").css({
            display: "block",
            top: top,
            left: left
        });

        return false;
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

    $('#relationServices tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            relationServices.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#relationServicesCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            relationServices.rows().deselect();
        }
    });

    CreateButton.click(function () {
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

    AcceptButton.click(function () {
        var relation_service_id = $('#id_edit').val();
        var transaction_status_id = 2;
        $.ajax({
            type: 'put',
            url: '{{ route('api.v1.dealerUser.customer.service.updateTransactionStatus') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                relation_service_id: relation_service_id,
                transaction_status_id: transaction_status_id
            },
            success: function () {
                $('#AcceptModal').modal('hide');
                relationServices.ajax.reload();
                toastr.success('Hizmet Onaylandı.');
                services.ajax.reload();
            },
            error: function (error) {
                if (error.responseJSON.message === 'Not enough balance') {
                    toastr.error('Bayi Yeterli Bakiyeye Sahip Olmadığı İçin İşlem Onaylanamıyor!')
                } else {
                    console.log(error);
                    toastr.error('Hizmet Onaylanırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin');
                }
            }
        });
    });

</script>
