<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.0.3') }}"></script>

<script>

    var CreateButton = $('#CreateButton');

    var dealer_id_create = $('#dealer_id_create');

    function create() {
        $('#CreateModal').modal('show');
    }

    function save(method, data) {
        $.ajax({
            type: method,
            url: '{{ route('api.v1.dealerUser.opportunity.save') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: data,
            success: function (response) {
                $('#CreateModal').modal('hide');
                toastr.success('Fırsat Başarıyla Oluşturuldu');
                opportunities.ajax.reload();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Oluşturulurken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getDealers() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.dealer.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                dealer_id: '{{ auth()->user()->getDealerId() }}'
            },
            success: function (response) {
                dealer_id_create.empty().append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, dealer) {
                    dealer_id_create.append(`<option value="${dealer.id}">${dealer.name}</option>`);
                });
                dealer_id_create.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getDealers();

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
            url: '{{ route('api.v1.dealerUser.opportunity.datatable') }}',
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
            {data: 'dealer_id', name: 'dealer_id'},
            {data: 'name', name: 'name'},
            {data: 'tax_number', name: 'tax_number'},
            {data: 'tax_office', name: 'tax_office'},
            {data: 'email', name: 'email'},
            {data: 'gsm', name: 'gsm'},
            {data: 'country_id', name: 'country_id'},
            {data: 'province_id', name: 'province_id'},
            {data: 'district_id', name: 'district_id'},
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
        var creator_type = 'App\\Models\\DealerUser';
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

        if (dealer_id == null || dealer_id === '') {
            toastr.warning('Bayi Seçimi Boş Olamaz!');
        } else if (name == null || name === '') {
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

</script>
