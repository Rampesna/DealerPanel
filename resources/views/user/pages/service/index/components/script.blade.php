<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');
    var UpdateButton = $('#UpdateButton');
    var DeleteButton = $('#DeleteButton');

    function create() {
        $('#CreateModal').modal('show');
    }

    function edit() {
        var id = $('#encrypted_id_edit').val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.service.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function (response) {
                $('#name_edit').val(response.response.name);
                $('#credit_amount_edit').val(response.response.credit_amount);
                $('#price_edit').val(response.response.price);
                $('#EditModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Hizmet Detayları Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function drop() {
        $('#DeleteModal').modal('show');
    }

    var services = $('#services').DataTable({
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

        lengthMenu: [
            [10, 25, 50, 250, -1],
            [10, 25, 50, 250, "Tümü"]
        ],

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
                    services.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#services tfoot tr');
            $('#services thead').append(r);
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
            url: '{{ route('api.v1.user.service.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'credit_amount', name: 'credit_amount'},
            {data: 'price', name: 'price'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = services.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            var name = selectedRows.data()[0].name;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);
            $("#deleting").html(name);
            $("#EditingContexts").show();

            var auth_user_id = '{{ auth()->id() }}';
            if (parseInt(auth_user_id) === parseInt(id)) {
                $("#DeleteContext").hide();
            } else {
                $("#DeleteContext").show();
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

    $('#services tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            services.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#servicesCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            services.rows().deselect();
        }
    });

    CreateButton.click(function () {
        var name = $('#name_create').val();
        var credit_amount = $('#credit_amount_create').val();
        var price = $('#price_create').val();

        if (!name) {
            toastr.warning('Lütfen Hizmetin Adını Giriniz.');
        } else if (!credit_amount) {
            toastr.warning('Lütfen Hizmetin Kontör Miktarını Giriniz.');
        } else if (!price) {
            toastr.warning('Lütfen Hizmetin Fiyatını Giriniz.');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('api.v1.user.service.create') }}',
                headers: {
                    _token: '{{ auth()->user()->apiToken() }}',
                    _auth_type: 'User'
                },
                data: {
                    name: name,
                    credit_amount: credit_amount,
                    price: price
                },
                success: function () {
                    toastr.success('Başarıyla Kaydedildi!');
                    $('#CreateForm').trigger('reset');
                    $('#CreateModal').modal('hide');
                    services.ajax.reload();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Hizmet Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    UpdateButton.click(function () {
        var id = $('#id_edit').val();
        var name = $('#name_edit').val();
        var credit_amount = $('#credit_amount_edit').val();
        var price = $('#price_edit').val();

        if (!name) {
            toastr.warning('Lütfen Hizmetin Adını Giriniz.');
        } else if (!credit_amount) {
            toastr.warning('Lütfen Hizmetin Kontör Miktarını Giriniz.');
        } else if (!price) {
            toastr.warning('Lütfen Hizmetin Fiyatını Giriniz.');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('api.v1.user.service.update') }}',
                headers: {
                    _token: '{{ auth()->user()->apiToken() }}',
                    _auth_type: 'User'
                },
                data: {
                    id: id,
                    name: name,
                    credit_amount: credit_amount,
                    price: price
                },
                success: function () {
                    toastr.success('Başarıyla Güncellendi!');
                    $('#EditModal').modal('hide');
                    services.ajax.reload();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Hizmet Güncellenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    DeleteButton.click(function () {
        var id = $('#id_edit').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('api.v1.user.service.drop') }}',
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
                services.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Hizmet Silinirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

</script>
