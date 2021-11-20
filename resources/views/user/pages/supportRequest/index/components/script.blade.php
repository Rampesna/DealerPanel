<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    function getSupportRequests() {
        $.ajax({
            type: 'get',
            url: ' {{ route('api.v1.user.supportRequest.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                var waiting = 0;
                var answered = 0;
                var completed = 0;
                $.each(response.response, function (i, supportRequest) {
                    if (parseInt(supportRequest.status_id) === 1) waiting += 1;
                    if (parseInt(supportRequest.status_id) === 2) answered += 1;
                    if (parseInt(supportRequest.status_id) === 3) completed += 1;
                });
                $('#waiting_span').html(waiting);
                $('#answered_span').html(answered);
                $('#completed_span').html(completed);
            },
            error: function () {

            }
        });
    }

    getSupportRequests();

    function show() {
        $(location).prop('href', `{{ route('user.supportRequest.show') }}/${$('#encrypted_id_edit').val()}`);
    }

    var supportRequests = $('#supportRequests').DataTable({
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
                    supportRequests.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#supportRequests tfoot tr');
            $('#supportRequests thead').append(r);
            this.api().columns().every(function (index) {
                var column = this;
                var input = document.createElement('input');

                if (index === 0) {
                    input = document.createElement('select');
                    var option = document.createElement("option");
                    option.setAttribute("value", "");
                    option.innerHTML = "Tümü";
                    input.appendChild(option);

                    option = document.createElement("option");
                    option.setAttribute("value", "App\\Models\\Customer");
                    option.innerHTML = "Müşteri";
                    input.appendChild(option);

                    option = document.createElement("option");
                    option.setAttribute("value", "App\\Models\\DealerUser");
                    option.innerHTML = "Bayi";
                    input.appendChild(option);

                    input.className = 'selectpicker';
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
            url: '{{ route('api.v1.user.supportRequest.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            error: function (error) {
                console.log(error)
            },
        },
        columns: [
            {data: 'creator_type', name: 'creator_type', width: '10%'},
            {data: 'creator_id', name: 'creator_id'},
            {data: 'name', name: 'name'},
            {data: 'category_id', name: 'category_id'},
            {data: 'priority_id', name: 'priority_id'},
            {data: 'status_id', name: 'status_id'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = supportRequests.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);
            $("#EditingContexts").show();
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

    $('#supportRequests tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            supportRequests.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#supportRequestsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            supportRequests.rows().deselect();
        }
    });

</script>
