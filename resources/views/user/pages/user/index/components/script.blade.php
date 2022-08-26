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
            url: '{{ route('api.v1.user.user.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function (response) {
                $('#name_edit').val(response.response.name);
                $('#email_edit').val(response.response.email);
                $('#EditModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kullanıcı Detayları Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function drop() {
        $('#DeleteModal').modal('show');
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.user.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                toastr.success('Başarıyla Kaydedildi!');
                $('#CreateForm').trigger('reset');
                $('#CreateModal').modal('hide');
                $('#EditModal').modal('hide');
                users.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kullanıcı Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    var users = $('#users').DataTable({
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
                    users.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#users tfoot tr');
            $('#users thead').append(r);
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
            url: '{{ route('api.v1.user.user.datatable') }}',
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
            {data: 'email', name: 'email'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = users.rows({selected: true});
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

    $('#users tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            users.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#usersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            users.rows().deselect();
        }
    });

    CreateButton.click(function () {
        var name = $('#name_create').val();
        var email = $('#email_create').val();
        var password = $('#password_create').val();

        if (name == null || name === '') {
            toastr.warning('Kullanıcı Adı Boş Olamaz!');
        } else if (email == null || email === '') {
            toastr.warning('E-posta Adresi Boş Olamaz!');
        } else if (password == null || password === '') {
            toastr.warning('Şifre Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.user.checkEmail') }}',
                data: {
                    email: email
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu E-posta Adresi Zaten Sistemde Kayıtlı!');
                    } else {
                        save('post', {
                            name: name,
                            email: email,
                            password: password,
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('E-posta Kontrolü Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    UpdateButton.click(function () {
        var id = $('#id_edit').val();
        var name = $('#name_edit').val();
        var email = $('#email_edit').val();
        var password = $('#password_edit').val();

        if (name == null || name === '') {
            toastr.warning('Kullanıcı Adı Boş Olamaz!');
        } else if (email == null || email === '') {
            toastr.warning('E-posta Adresi Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.user.checkEmail') }}',
                data: {
                    email: email,
                    except_id: id
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu E-posta Adresi Zaten Sistemde Kayıtlı!');
                    } else {
                        save('put', {
                            id: id,
                            name: name,
                            email: email,
                            password: password,
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('E-posta Kontrolü Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    DeleteButton.click(function () {
        var id = $('#id_edit').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('api.v1.user.user.drop') }}',
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
                users.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kullanıcı Silinirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

</script>
