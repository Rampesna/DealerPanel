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
        var id = $('#id_edit').val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.dealer.dealerUser.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: parseInt(id)
            },
            success: function (response) {
                $('#name_edit').val(response.response.name);
                $('#email_edit').val(response.response.email);
                $('#EditModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Sözleşme Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function drop() {
        $('#DeleteModal').modal('show');
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.dealerUser.dealer.dealerUser.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                $('#CreateModal').modal('hide');
                $('#CreateForm').trigger('reset');
                $('#EditModal').modal('hide');
                toastr.success('Başarıyla Kaydedildi.');
                dealerUsers.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Sözleşme Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function sendPassword() {
        toastr.info('İşleminiz Yapılıyor Lütfen Bekleyin...');
        var id = $('#id_edit').val();
        $.ajax({
            type: 'post',
            url: '{{ route('api.v1.dealerUser.dealer.dealerUser.sendPassword') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function () {
                toastr.success('Bayi Kullanıcı Şifresi Başarıyla Mail Olarak Gönderildi');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Kullanıcı Şifresi Mail Gönderilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    var dealerUsers = $('#dealerUsers').DataTable({
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
                    dealerUsers.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#dealerUsers tfoot tr');
            $('#dealerUsers thead').append(r);
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
            url: '{{ route('api.v1.dealerUser.dealer.dealerUser.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                dealer_id: '{{ $id }}'
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
        var selectedRows = dealerUsers.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            var name = selectedRows.data()[0].name;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);
            $("#deleting").html(name);

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

    $('#dealerUsers tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            dealerUsers.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#dealerUsersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            dealerUsers.rows().deselect();
        }
    });

    CreateButton.click(function () {
        var dealer_id = '{{ $id }}';
        var name = $('#name_create').val();
        var email = $('#email_create').val();

        if (name == null || name === '') {
            toastr.warning('Ad Soyad Boş Olamaz');
        } else if (email == null || email === '') {
            toastr.warning('E-posta Adresi Boş Olamaz');
        } else {
            save('post', {
                dealer_id: dealer_id,
                name: name,
                email: email
            });
        }
    });

    UpdateButton.click(function () {
        var id = $('#id_edit').val();
        var dealer_id = '{{ $id }}';
        var name = $('#name_edit').val();
        var email = $('#email_edit').val();

        if (name == null || name === '') {
            toastr.warning('Ad Soyad Boş Olamaz');
        } else if (email == null || email === '') {
            toastr.warning('E-posta Adresi Boş Olamaz');
        } else {
            save('post', {
                id: id,
                dealer_id: dealer_id,
                name: name,
                email: email
            });
        }
    });

    DeleteButton.click(function () {
        var id = $('#id_edit').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('api.v1.dealerUser.dealer.dealerUser.drop') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function () {
                $('#DeleteModal').modal('hide');
                toastr.success('Bayi Kullanıcısı Silindi');
                dealerUsers.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Kullanıcısı Silinirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

</script>
