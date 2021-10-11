<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');

    function create() {
        $('#CreateModal').modal('show');
    }

    function show() {
        $(location).prop('href', `{{ route('dealerUser.customer.show') }}/${$('#encrypted_id_edit').val()}/index`)
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.dealerUser.customer.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: data,
            success: function () {
                toastr.success('Müşteri Başarıyla Eklendi.');
                $('#CreateModal').modal('hide');
                customers.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Eklenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    var customers = $('#customers').DataTable({
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
                    customers.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#customers tfoot tr');
            $('#customers thead').append(r);
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
            url: '{{ route('api.v1.dealerUser.customer.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
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
        var selectedRows = customers.rows({selected: true});
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

    $('#customers tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            customers.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#customersCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            customers.rows().deselect();
        }
    });

    CreateButton.click(function () {
        var dealer_id = '{{ auth()->user()->getDealerId() }}';
        var tax_number = $('#tax_number_create').val();
        var name = $('#name_create').val();
        var email = $('#email_create').val();
        var gsm = $('#gsm_create').val();

        if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz!');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır!');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olabilir!');
        } else if (name == null || name === '') {
            toastr.warning('Müşteri Ünvanı Boş Olamaz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('api.v1.general.customer.checkTaxNumber') }}',
                data: {
                    tax_number: tax_number
                },
                success: function (response) {
                    if (response.response === 1) {
                        toastr.warning('Bu Vergi Numarasına Ait Müşteri Zaten Sistemde Kayıtlı!');
                    } else {
                        save('post', {
                            dealer_id: dealer_id,
                            tax_number: tax_number,
                            name: name,
                            email: email,
                            gsm: gsm
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

</script>
