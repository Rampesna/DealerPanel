<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');
    var UpdateButton = $('#UpdateButton');
    var DeleteButton = $('#DeleteButton');
    var UploadFileButton = $('#UploadFileButton');

    var status_id_create = $('#status_id_create');
    var status_id_edit = $('#status_id_edit');

    function getContractStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.contractStatus.index') }}',
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
                $.each(response.response, function (i, status) {
                    status_id_create.append(`<option value="${status.id}">${status.name}</option>`);
                    status_id_edit.append(`<option value="${status.id}">${status.name}</option>`);
                });
                status_id_create.selectpicker('refresh');
                status_id_edit.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    getContractStatuses();

    function create() {
        $('#CreateModal').modal('show');
    }

    function edit() {
        var id = $('#id_edit').val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.contract.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: parseInt(id)
            },
            success: function (response) {
                $('#number_edit').val(response.response.number);
                $('#start_edit').val(response.response.start);
                $('#end_edit').val(response.response.end);
                $('#status_id_edit').val(response.response.status_id).selectpicker('refresh');
                $('#description_edit').val(response.response.description);
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

    function uploadFile() {
        $('#UploadFileModal').modal('show');
    }

    function downloadFile() {

    }

    function save(method, data) {
        $.ajax({
            type: method,
            processData: false,
            contentType: false,
            url: '{{ route('api.v1.user.dealer.contract.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                $('#CreateModal').modal('hide');
                $('#CreateForm').trigger('reset');
                status_id_create.selectpicker('refresh')
                $('#EditModal').modal('hide');
                toastr.success('Başarıyla Kaydedildi.');
                contracts.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Sözleşme Kaydedilirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function upload(data) {
        $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            url: '{{ route('api.v1.user.dealer.contract.uploadFile') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                $('#UploadFileModal').modal('hide');
                toastr.success('Başarıyla Yüklendi.');
                contracts.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Sözleşme Dosyası Yüklenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    var contracts = $('#contracts').DataTable({
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
                    contracts.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#contracts tfoot tr');
            $('#contracts thead').append(r);
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
            url: '{{ route('api.v1.user.dealer.contract.datatable') }}',
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
            {data: 'number', name: 'number'},
            {data: 'start', name: 'start'},
            {data: 'end', name: 'end'},
            {data: 'status', name: 'status'},
            {data: 'description', name: 'description'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = contracts.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            var number = selectedRows.data()[0].number;
            var file = selectedRows.data()[0].file;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);
            $("#deleting").html(number);

            if (file == null || file === '') {
                $('#UploadFileContext').show();
                $('#DownloadFileContext').hide();
            } else {
                $('#UploadFileContext').hide();
                $('#DownloadFileContext').show();
            }

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

    $('#contracts tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            contracts.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#contractsCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            contracts.rows().deselect();
        }
    });

    CreateButton.click(function () {
        var number = $('#number_create').val();
        var start = $('#start_create').val();
        var end = $('#end_create').val();
        var status_id = $('#status_id_create').val();
        var description = $('#description_create').val();

        if (number == null || number === '') {
            toastr.warning('Sözleşme Numarası Girmediniz!');
        } else if (start == null || start === '') {
            toastr.warning('Sözleşme Başlangıç Tarihini Girmediniz!');
        } else if (end == null || end === '') {
            toastr.warning('Sözleşme Bitiş Tarihini Girmediniz!');
        } else if (status_id == null || status_id === '') {
            toastr.warning('Durum Seçmediniz!');
        } else {
            var data = new FormData();
            data.append('relation_type', 'App\\Models\\Customer');
            data.append('relation_id', '{{ $id }}');
            data.append('number', number);
            data.append('start', start);
            data.append('end', end);
            data.append('status_id', status_id);
            data.append('description', description);
            data.append('file', $('#file_create')[0].files[0]);
            save('post', data);
        }
    });

    UpdateButton.click(function () {
        var id = $('#id_edit').val();
        var number = $('#number_edit').val();
        var start = $('#start_edit').val();
        var end = $('#end_edit').val();
        var status_id = $('#status_id_edit').val();
        var description = $('#description_edit').val();

        if (number == null || number === '') {
            toastr.warning('Sözleşme Numarası Girmediniz!');
        } else if (start == null || start === '') {
            toastr.warning('Sözleşme Başlangıç Tarihini Girmediniz!');
        } else if (end == null || end === '') {
            toastr.warning('Sözleşme Bitiş Tarihini Girmediniz!');
        } else if (status_id == null || status_id === '') {
            toastr.warning('Durum Seçmediniz');
        } else {
            var data = new FormData();
            data.append('id', id);
            data.append('relation_type', 'App\\Models\\Customer');
            data.append('relation_id', '{{ $id }}');
            data.append('number', number);
            data.append('start', start);
            data.append('end', end);
            data.append('status_id', status_id);
            data.append('description', description);
            data.append('file', $('#file_create')[0].files[0]);
            save('post', data);
        }
    });

    DeleteButton.click(function () {
        var id = $('#id_edit').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('api.v1.user.dealer.contract.drop') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function () {
                $('#DeleteModal').modal('hide');
                toastr.success('Sözleşme Silindi');
                contracts.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Sözleşme Silinirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    UploadFileButton.click(function () {
        var id = $('#id_edit').val();
        var data = new FormData();
        data.append('id', id);
        data.append('file', $('#file_upload')[0].files[0]);
        upload(data);
    });

</script>
