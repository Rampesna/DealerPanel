<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var AcceptButton = $('#AcceptButton');
    var RejectButton = $('#RejectButton');

    function accept() {
        $('#AcceptModal').modal('show');
    }

    function reject() {
        $('#RejectModal').modal('show');
    }

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
                1,
                "asc"
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
                    relationServices.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#relationServices tfoot tr');
            $('#relationServices thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');
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
            url: '{{ route('api.v1.user.waitingTransaction.relationService.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                transaction_status_id: 1
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'relation_type', name: 'relation_type', width: '10%'},
            {data: 'relation_id', name: 'relation_id', width: '25%'},
            {data: 'amount', name: 'amount', width: '5%'},
            {data: 'service_id', name: 'service_id'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = relationServices.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);
            $("#EditingContexts").show();

            var top = e.pageY - 10;
            var left = e.pageX - 10;

            $("#context-menu").css({
                display: "block",
                top: top,
                left: left
            });
        } else {
            $("#EditingContexts").hide();
        }

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

    AcceptButton.click(function () {
        var customer_service_id = $('#id_edit').val();
        var transaction_status_id = 2;
        $.ajax({
            type: 'put',
            url: '{{ route('api.v1.user.waitingTransaction.relationService.accept') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                customer_service_id: customer_service_id,
                transaction_status_id: transaction_status_id,
                auth_type: '{{ str_replace('\\', '\\\\', auth()->user()->authType()) }}',
                auth_id: '{{ auth()->id() }}'
            },
            success: function () {
                $('#AcceptModal').modal('hide');
                relationServices.ajax.reload();
                toastr.success('Hizmet Onaylandı.');
            },
            error: function (error) {
                if (error.responseJSON.message === 'Not enough balance') {
                    toastr.error('Talebi Oluşturanın Yeterli Kontör Bakiyesi Bulunmadığından İşlem Onaylanamıyor!');
                } else {
                    console.log(error);
                    toastr.error('Hizmet Onaylanırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin');
                }
            }
        });
    });

    RejectButton.click(function () {
        var customer_service_id = $('#id_edit').val();
        var transaction_status_id = 3;
        $.ajax({
            type: 'put',
            url: '{{ route('api.v1.user.waitingTransaction.relationService.accept') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                customer_service_id: customer_service_id,
                transaction_status_id: transaction_status_id,
                auth_type: '{{ str_replace('\\', '\\\\', auth()->user()->authType()) }}',
                auth_id: '{{ auth()->id() }}'
            },
            success: function () {
                $('#RejectModal').modal('hide');
                relationServices.ajax.reload();
                toastr.success('Hizmet Reddedildi.');
            },
            error: function (error) {
                if (error.responseJSON.message === 'Not enough balance') {
                    toastr.error('Talebi Oluşturanın Yeterli Kontör Bakiyesi Bulunmadığından İşlem Onaylanamıyor!');
                } else {
                    console.log(error);
                    toastr.error('Hizmet Reddedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin');
                }
            }
        });
    });

</script>
