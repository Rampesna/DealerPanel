<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    function creditDetail() {
        creditDetails.ajax.reload();
        $('#CreditDetailModal').modal('show');
    }

    var credits = $('#credits').DataTable({
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
                    credits.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#credits tfoot tr');
            $('#credits thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');
                input.className = 'form-control';

                if (index === 0) {
                    input = null;
                } else if (index === 1) {
                    input.setAttribute("type", "datetime-local");
                }


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
            url: '{{ route('api.v1.user.customer.credit.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
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
            {data: 'show_credit_details', name: 'show_credit_details', width: '2%', sortable: false, orderable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'relation_service_id', name: 'relation_service_id'},
            {data: 'amount', name: 'amount'},
            {data: 'direction', name: 'direction'},
        ],

        responsive: true,
        colReorder: true,
        stateSave: true,
        select: 'single'
    });

    var creditDetails = $('#creditDetails').DataTable({
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

        dom: 'rtipl',

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
                    credits.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#creditDetails tfoot tr');
            $('#creditDetails thead').append(r);
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
            url: '{{ route('api.v1.user.credit.creditDetail.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: function (d) {
                return $.extend({}, d, {
                    credit_id: $('#id_edit').val()
                });
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'type', name: 'type'},
            {data: 'amount', name: 'amount'},
        ],

        responsive: true,
        colReorder: true,
        stateSave: true,
        select: 'single'
    });

    function getCredits() {
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
                relation_id: relation_id
            },
            success: function (response) {
                var total = 0;
                var used = 0;
                $.each(response.response, function (i, credit) {
                    if (credit.direction === 1) total += credit.amount;
                    if (credit.direction === 0) used += credit.amount;
                });
                var remaining = total - used;
                $('#totalSpan').html(reformatFloatNumber(total));
                $('#usedSpan').html(reformatFloatNumber(used));
                $('#remainingSpan').html(reformatFloatNumber(remaining));
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCredits();

    $('body').on('contextmenu', function (e) {
        var selectedRows = credits.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            var direction = selectedRows.data()[0].direction;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);

            if (direction === 'Kullanıldı') {
                $("#EditingContexts").show();

                var top = e.pageY - 10;
                var left = e.pageX - 10;

                $("#context-menu").css({
                    display: "block",
                    top: top,
                    left: left
                });
            }
        } else {
            $("#EditingContexts").hide();
        }

        return false;
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

    $('#credits tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            credits.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#creditsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            credits.rows().deselect();
        }
    });

    $(document).delegate('.show_credit_details', 'click', function () {
        $('#id_edit').val($(this).data('id'));
        creditDetails.ajax.reload();
        $('#CreditDetailModal').modal('show');
    });

</script>
