<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');

    var category_id_create = $('#category_id_create');
    var priority_id_create = $('#priority_id_create');

    function create() {
        $('#CreateModal').modal('show');
    }

    function show() {
        $(location).prop('href', `{{ route('dealerUser.supportRequest.show') }}/${$('#encrypted_id_edit').val()}`);
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.dealerUser.supportRequest.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: data,
            success: function (response) {
                $('#CreateModal').modal('hide');
                toastr.success('Talep Başarıyla Oluşturuldu');
                supportRequests.ajax.reload();
                console.log(response)
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Oluşturulurken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getSupportRequestCategories() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.supportRequestCategory.index') }}',
            data: {
                type: 'DealerUser'
            },
            success: function (response) {
                category_id_create.empty();
                $.each(response.response, function (i, supportRequestCategory) {
                    category_id_create.append(`<option value="${supportRequestCategory.id}">${supportRequestCategory.name}</option>`);
                });
                category_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Kategorileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getSupportRequestPriorities() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.supportRequestPriority.index') }}',
            data: {
                type: 'DealerUser'
            },
            success: function (response) {
                priority_id_create.empty();
                $.each(response.response, function (i, supportRequestPriority) {
                    priority_id_create.append(`<option value="${supportRequestPriority.id}">${supportRequestPriority.name}</option>`);
                });
                priority_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Öncelikleri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getSupportRequestCategories();
    getSupportRequestPriorities();

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
            url: '{{ route('api.v1.dealerUser.customer.supportRequest.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                creator_type: 'App\\Models\\Customer',
                creator_id: '{{ $id }}'
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
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

    CreateButton.click(function () {
        var creator_type = '{{ str_replace('\\', '\\\\', auth()->user()->authType()) }}';
        var creator_id = '{{ auth()->id() }}';
        var name = $('#name_create').val();
        var description = $('#description_create').val();
        var category_id = category_id_create.val();
        var priority_id = priority_id_create.val();
        var status_id = 1;

        if (creator_type === '' || creator_id === '') {
            toastr.warning('Kullanıcı Kontrolünde Sorun Oluştu. Lütfen Sayfayı Yenilemeyi Deneyin.');
        } else if (name == null || name === '') {
            toastr.warning('Talep Başlığı Boş Olamaz!');
        } else if (category_id == null || category_id === '') {
            toastr.warning('Talep Kategorisi Boş Olamaz!');
        } else if (priority_id == null || priority_id === '') {
            toastr.warning('Talep Önceliği Boş Olamaz!');
        } else {
            save('post', {
                creator_type: creator_type,
                creator_id: creator_id,
                name: name,
                description: description,
                category_id: category_id,
                priority_id: priority_id,
                status_id: status_id
            });
        }
    });

</script>
