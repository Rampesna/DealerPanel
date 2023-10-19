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

    var dealers = $('#dealers').DataTable({
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
                    dealers.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#dealers tfoot tr');
            $('#dealers thead').append(r);
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
            url: '{{ route('api.v1.user.waitingTransaction.dealer.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'tax_number', name: 'tax_number', width: '10%'},
            {data: 'name', name: 'name'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = dealers.rows({selected: true});
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

    $('#dealers tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            dealers.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#dealersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            dealers.rows().deselect();
        }
    });

    AcceptButton.click(function () {
        var dealer_id = $('#id_edit').val();
        var transaction_status_id = 2;
        toastr.info('İşleminiz Yapılıyor Lütfen Bekleyin...');
        $.ajax({
            type: 'put',
            url: '{{ route('api.v1.user.waitingTransaction.dealer.accept') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                dealer_id: dealer_id,
                transaction_status_id: transaction_status_id,
            },
            success: function () {
                $('#AcceptModal').modal('hide');
                dealers.ajax.reload();
                toastr.success('Bayi Onaylandı.');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Onaylanırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin');
            }
        });
    });

    RejectButton.click(function () {
        var dealer_id = $('#id_edit').val();
        var transaction_status_id = 3;
        toastr.info('İşleminiz Yapılıyor Lütfen Bekleyin...');
        $.ajax({
            type: 'put',
            url: '{{ route('api.v1.user.waitingTransaction.dealer.accept') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                dealer_id: dealer_id,
                transaction_status_id: transaction_status_id,
            },
            success: function () {
                $('#RejectModal').modal('hide');
                dealers.ajax.reload();
                toastr.error('Bayi Reddedildi.');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Reddedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin');
            }
        });
    });

</script>
