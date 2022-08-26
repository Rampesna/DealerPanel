<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');
    var UpdateButton = $('#UpdateButton');
    var DeleteButton = $('#DeleteButton');

    var dealer_id_create = $('#dealer_id_create');
    var dealer_id_edit = $('#dealer_id_edit');

    var country_id_create = $('#country_id_create');
    var country_id_edit = $('#country_id_edit');

    var province_id_create = $('#province_id_create');
    var province_id_edit = $('#province_id_edit');

    var district_id_create = $('#district_id_create');
    var district_id_edit = $('#district_id_edit');

    function create() {
        $('#CreateModal').modal('show');
    }

    function edit() {
        var id = $('#id_edit').val();
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.opportunity.show') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function (response) {
                $('#creator_type_edit').val(response.response.creator_type);
                $('#creator_id_edit').val(response.response.creator_id);
                dealer_id_edit.val(response.response.dealer_id).selectpicker('refresh');
                $('#name_edit').val(response.response.name);
                $('#tax_number_edit').val(response.response.tax_number);
                $('#tax_office_edit').val(response.response.tax_office);
                $('#email_edit').val(response.response.email);
                $('#gsm_edit').val(response.response.gsm);
                $('#description_edit').val(response.response.description);
                country_id_edit.val(response.response.country_id).selectpicker('refresh');
                getProvincesForEdit(response.response.province_id);
                getDistrictsForEdit(response.response.district_id);
                $('#date_edit').val(response.response.date);
                $('#EditModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Detayları Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.user.opportunity.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: data,
            success: function (response) {
                $('#CreateForm').trigger('reset');
                dealer_id_create.selectpicker('refresh');
                country_id_create.selectpicker('refresh');
                province_id_create.selectpicker('refresh');
                district_id_create.selectpicker('refresh');
                $('#CreateModal').modal('hide');
                $('#EditModal').modal('hide');
                toastr.success('Fırsat Başarıyla Oluşturuldu');
                opportunities.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Oluşturulurken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function drop() {
        $('#DeleteModal').modal('show');
    }

    function getDealers() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.dealer.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                dealer_id_create.empty().append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                dealer_id_edit.empty().append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, dealer) {
                    dealer_id_create.append(`<option value="${dealer.id}">${dealer.name}</option>`);
                    dealer_id_edit.append(`<option value="${dealer.id}">${dealer.name}</option>`);
                });
                dealer_id_create.selectpicker('refresh');
                dealer_id_edit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCountries() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.country.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'User'
            },
            data: {},
            success: function (response) {
                country_id_create.empty();
                country_id_edit.empty();
                country_id_create.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                country_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, country) {
                    country_id_create.append(`<option value="${country.id}">${country.name}</option>`);
                    country_id_edit.append(`<option value="${country.id}">${country.name}</option>`);
                });
                country_id_create.selectpicker('refresh');
                country_id_edit.selectpicker('refresh');
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
                auth_type: 'User'
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

    function getProvincesForEdit(province_id) {
        var country_id = country_id_edit.val();
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('api.v1.general.province.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'User'
            },
            data: {
                country_id: country_id
            },
            success: function (response) {
                province_id_edit.empty();
                province_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, province) {
                    province_id_edit.append(`<option ${parseInt(province_id) === parseInt(province.id) ? 'selected' : ''} value="${province.id}">${province.name}</option>`);
                });
                province_id_edit.selectpicker('refresh');
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
                auth_type: 'User'
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

    function getDistrictsForEdit(district_id) {
        var province_id = province_id_edit.val();
        console.log(province_id)
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.district.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                auth_type: 'User'
            },
            data: {
                province_id: province_id
            },
            success: function (response) {
                district_id_edit.empty();
                district_id_edit.append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, district) {
                    district_id_edit.append(`<option ${parseInt(district_id) === parseInt(district.id) ? 'selected' : ''} value="${district.id}">${district.name}</option>`);
                });
                district_id_edit.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İlçe Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getDealers();
    getCountries();

    var opportunities = $('#opportunities').DataTable({
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
                    opportunities.search('').columns().search('').ajax.reload().draw();
                }
            }
        ],

        initComplete: function () {
            var r = $('#opportunities tfoot tr');
            $('#opportunities thead').append(r);
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
            url: '{{ route('api.v1.user.opportunity.datatable') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            error: function (error) {
                console.log(error)
            }
        },
        columns: [
            {data: 'dealer_id', name: 'dealer_id'},
            {data: 'name', name: 'name'},
            {data: 'tax_number', name: 'tax_number'},
            {data: 'tax_office', name: 'tax_office'},
            {data: 'email', name: 'email'},
            {data: 'gsm', name: 'gsm'},
            {data: 'status_id', name: 'status_id'},
        ],

        responsive: true,
        select: 'single'
    });

    $('body').on('contextmenu', function (e) {
        var selectedRows = opportunities.rows({selected: true});
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

    $('#opportunities tbody').on('mousedown', 'tr', function (e) {
        if (e.button === 0) {
            return false;
        } else {
            opportunities.row(this).select();
        }
    });

    $(document).click((e) => {
        if ($.contains($("#opportunitiesCard").get(0), e.target)) {
        } else {
            $("#context-menu").hide();
            opportunities.rows().deselect();
        }
    });

    CreateButton.click(function () {
        var creator_type = 'App\\Models\\User';
        var creator_id = '{{ auth()->id() }}';
        var dealer_id = dealer_id_create.val();
        var name = $('#name_create').val();
        var tax_number = $('#tax_number_create').val();
        var tax_office = $('#tax_office_create').val();
        var email = $('#email_create').val();
        var gsm = $('#gsm_create').val();
        var description = $('#description_create').val();
        var country_id = $('#country_id_create').val();
        var province_id = $('#province_id_create').val();
        var district_id = $('#district_id_create').val();
        var status_id = 1;
        var date = $('#date_create').val();

        if (name == null || name === '') {
            toastr.warning('Müşteri Ünvanı Boş Olamaz');
        } else if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olmalıdır');
        } else if (date == null || date === '') {
            toastr.warning('Tarih Boş Olamaz');
        } else {
            save('post', {
                creator_type: creator_type,
                creator_id: creator_id,
                dealer_id: dealer_id,
                name: name,
                tax_number: tax_number,
                tax_office: tax_office,
                email: email,
                gsm: gsm,
                description: description,
                country_id: country_id,
                province_id: province_id,
                district_id: district_id,
                status_id: status_id,
                date: date
            });
        }
    });

    UpdateButton.click(function () {
        var id = $('#id_edit').val();
        var creator_type = $('#creator_type_edit').val();
        var creator_id = $('#creator_id_edit').val();
        var dealer_id = dealer_id_edit.val();
        var name = $('#name_edit').val();
        var tax_number = $('#tax_number_edit').val();
        var tax_office = $('#tax_office_edit').val();
        var email = $('#email_edit').val();
        var gsm = $('#gsm_edit').val();
        var description = $('#description_edit').val();
        var country_id = $('#country_id_edit').val();
        var province_id = $('#province_id_edit').val();
        var district_id = $('#district_id_edit').val();
        var status_id = 1;
        var date = $('#date_edit').val();

        if (name == null || name === '') {
            toastr.warning('Müşteri Ünvanı Boş Olamaz');
        } else if (tax_number == null || tax_number === '') {
            toastr.warning('Vergi Numarası Boş Olamaz');
        } else if (tax_number.length < 10) {
            toastr.warning('Vergi Numarası En Az 10 Karakter Olmalıdır');
        } else if (tax_number.length > 11) {
            toastr.warning('Vergi Numarası En Fazla 11 Karakter Olmalıdır');
        } else if (date == null || date === '') {
            toastr.warning('Tarih Boş Olamaz');
        } else {
            save('post', {
                id: id,
                creator_type: creator_type,
                creator_id: creator_id,
                dealer_id: dealer_id,
                name: name,
                tax_number: tax_number,
                tax_office: tax_office,
                email: email,
                gsm: gsm,
                description: description,
                country_id: country_id,
                province_id: province_id,
                district_id: district_id,
                status_id: status_id,
                date: date
            });
        }
    });

    DeleteButton.click(function () {
        var id = $('#id_edit').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('api.v1.user.opportunity.drop') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                id: id
            },
            success: function () {
                $('#DeleteModal').modal('hide');
                toastr.success('Fırsat Başarıyla Silindi');
                opportunities.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Silinirken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    country_id_create.change(function () {
        province_id_create.empty().selectpicker('refresh');
        district_id_create.empty().selectpicker('refresh');
        getProvincesForCreate();
    });

    country_id_edit.change(function () {
        province_id_edit.empty().selectpicker('refresh');
        district_id_edit.empty().selectpicker('refresh');
        getProvincesForEdit();
    });

    province_id_create.change(function () {
        district_id_create.empty().selectpicker('refresh');
        getDistrictsForCreate();
    });

    province_id_edit.change(function () {
        district_id_edit.empty().selectpicker('refresh');
        getDistrictsForEdit();
    });

</script>
