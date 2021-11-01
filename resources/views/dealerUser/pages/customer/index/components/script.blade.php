<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');

    var country_id_create = $('#country_id_create');
    var province_id_create = $('#province_id_create');
    var district_id_create = $('#district_id_create');

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
                $('#CreateForm').trigger('reset');
                country_id_create.selectpicker('refresh');
                province_id_create.selectpicker('refresh');
                district_id_create.selectpicker('refresh');
                toastr.success('Müşteri Oluşturma Talebiniz Alındı. Onaylandığında Müşteri Listenize Eklenecektir.');
                $('#CreateModal').modal('hide');
                customers.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Eklenirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCountries() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.country.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'DealerUser'
            },
            data: {},
            success: function (response) {
                country_id_create.empty();
                country_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, country) {
                    country_id_create.append(`<option value="${country.id}">${country.name}</option>`);
                });
                country_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ülke Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getProvincesForCreate() {
        var country_id = country_id_create.val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.province.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'DealerUser'
            },
            data: {
                country_id: country_id
            },
            success: function (response) {
                province_id_create.empty();
                province_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, province) {
                    province_id_create.append(`<option value="${province.id}">${province.name}</option>`);
                });
                province_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şehir Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getDistrictsForCreate() {
        var province_id = province_id_create.val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.district.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'DealerUser'
            },
            data: {
                province_id: province_id
            },
            success: function (response) {
                district_id_create.empty();
                district_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, district) {
                    district_id_create.append(`<option value="${district.id}">${district.name}</option>`);
                });
                district_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İlçe Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCountries();

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
            data: {
                dealer_id: '{{ auth()->user()->getDealerId() }}'
            },
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'tax_number', name: 'tax_number', width: '10%'},
            {data: 'dealer_id', name: 'dealer_id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'gsm', name: 'gsm'},
            {data: 'province_id', name: 'province_id'},
            {data: 'balance', name: 'balance'},
            {data: 'transaction_status', name: 'transaction_status'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = customers.rows({selected: true});
        if (selectedRows.count() > 0) {
            var id = selectedRows.data()[0].id;
            var encrypted_id = selectedRows.data()[0].encrypted_id;
            var transaction_status_id = selectedRows.data()[0].transaction_status_id;
            $("#id_edit").val(id);
            $("#encrypted_id_edit").val(encrypted_id);

            if (transaction_status_id === 2) {
                $("#EditingContexts").show();
            } else {
                $("#EditingContexts").hide();
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
        var tax_office = $('#tax_office_create').val();
        var website = $('#website_create').val();
        var foundation_date = $('#foundation_date_create').val();
        var country_id = country_id_create.val();
        var province_id = province_id_create.val();
        var district_id = district_id_create.val();

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
                            gsm: gsm,
                            tax_office: tax_office,
                            website: website,
                            foundation_date: foundation_date,
                            country_id: country_id,
                            province_id: province_id,
                            district_id: district_id,
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

    country_id_create.change(function () {
        province_id_create.empty().selectpicker('refresh');
        district_id_create.empty().selectpicker('refresh');
        getProvincesForCreate();
    });

    province_id_create.change(function () {
        district_id_create.empty().selectpicker('refresh');
        getDistrictsForCreate();
    });

</script>
