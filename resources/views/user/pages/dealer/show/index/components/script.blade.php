<script src="{{ asset('assets/plugins/custom/jstree/jstree.bundle.js') }}"></script>

<script>

    var CreateButton = $('#CreateButton');
    var UpdateButton = $('#UpdateButton');
    var DeleteButton = $('#DeleteButton');

    function create() {
        $('#CreateModal').modal('show');
    }

    function edit() {
        var id = $('#dealer_id_edit').val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function (response) {
                $('#tax_number_edit').val(response.response.tax_number);
                $('#name_edit').val(response.response.name);
                $('#EditModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function drop() {
        $('#DeleteModal').modal('show');
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.dealer.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function () {
                toastr.success('Başarıyla Kaydedildi');
                $('#CreateModal').modal('hide');
                $('#CreateForm').trigger('reset');
                $('#EditModal').modal('hide');
                jsTree.jstree('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Eklenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    var jsTree = $("#jsTree").jstree({
        plugins: [
            'dnd',
            'types',
            'conditionalselect',
            'state',
            'contextmenu'
        ],
        contextmenu: {
            items: {}
        },
        core: {
            themes: {
                responsive: false
            },
            check_callback: true,
            data: {
                url: '{{ route('api.v1.user.dealer.jsTree') }}',
                headers: {
                    _token: '{{ auth()->user()->apiToken() }}',
                    _auth_type: 'User'
                },
                data: {
                    dealer_id: '{{ $id }}'
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Bayi Hiyerarşisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            }
        }
    });

    $('body').on('contextmenu', function (e) {
        var nodeData = jsTree.jstree().get_selected(true)[0];
        $('#dealer_id_edit').val(nodeData.original.dealer_id);

        console.log(nodeData);

        var top = e.pageY - 10;
        var left = e.pageX - 10;

        $("#context-menu").css({
            display: "block",
            top: top,
            left: left
        });

        return false;
    }).on("click", function (e) {
        $("#context-menu").hide();
        if (!$.contains($("#JsTreeCardSelector").get(0), e.target)) {
            jsTree.jstree().deselect_all(true);
        }
    });

    CreateButton.click(function () {
        var top_id = $('#dealer_id_edit').val();
        var tax_number = $('#tax_number_create').val();
        var name = $('#name_create').val();

        if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olmalıdır');
        } else if (name == null || name === '') {
            toastr.warning('Bayi Ünvanı Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.dealer.checkTaxNumber') }}',
                data: {
                    tax_number: tax_number
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu Vergi Numarasına Ait Bayi Zaten Sistemde Kayıtlı!');
                    } else {
                        save('post', {
                            top_id: top_id,
                            tax_number: tax_number,
                            name: name
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vergi Numarası Kontrolü Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    UpdateButton.click(function () {
        var id = $('#dealer_id_edit').val();
        var tax_number = $('#tax_number_edit').val();
        var name = $('#name_edit').val();

        if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olmalıdır');
        } else if (name == null || name === '') {
            toastr.warning('Bayi Ünvanı Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.dealer.checkTaxNumber') }}',
                data: {
                    tax_number: tax_number,
                    except_id: id
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu Vergi Numarasına Ait Bayi Zaten Sistemde Kayıtlı!');
                    } else {
                        save('put', {
                            id: id,
                            tax_number: tax_number,
                            name: name
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vergi Numarası Kontrolü Yapılırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    DeleteButton.click(function () {
        var id = $('#dealer_id_edit').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('api.v1.user.dealer.drop') }}',
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
                jsTree.jstree('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Silinirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

</script>
