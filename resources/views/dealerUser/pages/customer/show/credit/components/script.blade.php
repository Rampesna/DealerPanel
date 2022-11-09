<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.selection.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.filter.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.sort.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.pager.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxnumberinput.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxwindow.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxexport.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.grouping.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/globalization/globalize.js') }}"></script>
<script src="{{ asset('assets/js/jqgrid-localization.js') }}"></script>
<script src="{{ asset('assets/js/jszip.min.js') }}"></script>

<script>

    var usageDiv = $('#usages');

    function creditDetail() {
        creditDetails.ajax.reload();
        $('#CreditDetailModal').modal('show');
    }

    function getCredits() {
        var relation_type = 'App\\Models\\Customer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.customer.credit.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                relation_type: relation_type,
                relation_id: relation_id
            },
            success: function (response) {
                var credits = response.response;
                $.ajax({
                    type: 'get',
                    url: '{{ route('api.v1.dealerUser.bienSoapService.usageReportByCustomerId') }}',
                    headers: {
                        _token: '{{ auth()->user()->apiToken() }}',
                        _auth_type: 'User'
                    },
                    data: {
                        customer_id: '{{ $id }}',
                        start_date: '2015-01-01T00:00:00',
                        end_date: '2050-01-01T00:00:00'
                    },
                    success: function (usageResponse) {
                        var total = 0;
                        $.each(credits, function (i, credit) {
                            if (credit.direction === 1) total += credit.amount;
                        });
                        var remaining = total - usageResponse.response;
                        $('#totalSpan').html(reformatFloatNumber(total));
                        $('#usedSpan').html(reformatFloatNumber(usageResponse.response));
                        $('#remainingSpan').html(reformatFloatNumber(remaining));
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Kontör Kullanım Raporu Alınırken Serviste Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCreditUsages() {
        var customer_id = '{{ $id }}';
        var relation_type = 'App\\Models\\Customer';
        var start_date = '2015-01-01T00:00:00';
        var end_date = '2050-01-01T00:00:00';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.customer.credit.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                relation_id: customer_id,
                relation_type: relation_type
            },
            success: function (creditsResponse) {
                console.log(creditsResponse);
                var credits = creditsResponse.response;
                $.ajax({
                    type: 'get',
                    url: '{{ route('api.v1.dealerUser.bienSoapService.usageListByCustomerId') }}',
                    headers: {
                        _token: '{{ auth()->user()->apiToken() }}',
                        _auth_type: 'User'
                    },
                    data: {
                        customer_id: customer_id,
                        start_date: start_date,
                        end_date: end_date
                    },
                    success: function (response) {
                        var usages = response.response.Usages;
                        var usageArray = [];

                        console.log(usages);

                        if ($.isArray(usages)) {
                            $.each(usages, function (i, usage) {

                                var date = '';
                                var service = '';
                                var amount = 0;
                                var direction = '';

                                if (usage.Type === 'InboxInvoice') {
                                    service = 'E-fatura Gelen';
                                } else if (usage.Type === 'OutboxEInvoice') {
                                    service = 'E-fatura Giden';
                                } else if (usage.Type === 'OutboxEArchive') {
                                    service = 'E-arşiv Giden';
                                } else if (usage.Type === 'Ledger') {
                                    service = 'E-Defter';
                                } else if (usage.Type === 'Ticket') {
                                    service = 'E-Posta';
                                } else if (usage.Type === 'EseVoucher') {
                                    service = 'E-MM';
                                } else {
                                    service = usage.Type;
                                }

                                if (usage.Type === 'Ledger') {
                                    amount = `${reformatFloatNumber(usage.Items.Count / 1000)} MB`;
                                } else if (usage.Type === 'OutboxEArchive') {
                                    amount = parseInt(usage.Items.Count / response.response.customer.divisor);
                                } else if (usage.Type === 'Ticket') {
                                    amount = parseInt(usage.Items.Count / 5);
                                } else {
                                    amount = usage.Items.Count;
                                }

                                direction = 'Kullanıldı';

                                usageArray.push({
                                    date: date,
                                    service: service,
                                    amount: amount,
                                    direction: direction
                                });
                            });
                        } else {
                            var date = '';
                            var service = '';
                            var amount = 0;
                            var direction = '';

                            if (usages.Type === 'InboxInvoice') {
                                service = 'E-fatura Gelen';
                            } else if (usages.Type === 'OutboxEInvoice') {
                                service = 'E-fatura Giden';
                            } else if (usages.Type === 'OutboxEArchive') {
                                service = 'E-arşiv Giden';
                            } else if (usages.Type === 'Ledger') {
                                service = 'E-Defter';
                            } else if (usages.Type === 'Ticket') {
                                service = 'E-Posta';
                            } else if (usages.Type === 'EseVoucher') {
                                service = 'E-MM';
                            } else {
                                service = usages.Type;
                            }

                            amount = usages.Items ? usages.Items.Count : 0;
                            direction = 'Kullanıldı';

                            usageArray.push({
                                date: date,
                                service: service,
                                amount: amount,
                                direction: direction
                            });
                        }

                        $.each(credits, function (i, credit) {
                            if (credit.direction === 1) {
                                usageArray.push({
                                    date: reformatDateForHuman(credit.created_at),
                                    service: credit.service.name || '',
                                    amount: credit.amount,
                                    direction: 'Satın Alındı'
                                });
                            }
                        });

                        var usageSource =
                            {
                                localdata: usageArray,
                                datatype: "array",
                                datafields:
                                    [
                                        {name: 'date', type: 'string'},
                                        {name: 'service', type: 'string'},
                                        {name: 'amount', type: 'integer'},
                                        {name: 'direction', type: 'string'},
                                    ]
                            };
                        var usageDataAdapter = new $.jqx.dataAdapter(usageSource);

                        usageDiv.jqxGrid(
                            {
                                width: '100%',
                                height: '500',
                                source: usageDataAdapter,
                                columnsresize: true,
                                groupable: true,
                                theme: 'metro',
                                filterable: true,
                                showfilterrow: true,
                                pageable: true,
                                sortable: true,
                                pagesizeoptions: ['10', '20', '50', '1000'],
                                localization: getLocalization('tr'),
                                columns: [
                                    {
                                        text: 'Tarih',
                                        dataField: 'date',
                                        columntype: 'textbox',
                                        width: '25%'

                                    },
                                    {
                                        text: 'Hizmet',
                                        dataField: 'service',
                                        columntype: 'textbox',
                                        width: '25%'
                                    },
                                    {
                                        text: 'Miktar',
                                        dataField: 'amount',
                                        columntype: 'textbox',
                                        width: '25%'
                                    },
                                    {
                                        text: 'İşlem',
                                        dataField: 'direction',
                                        columntype: 'textbox',
                                        width: '25%'
                                    }
                                ],
                            });

                        usageDiv.on('contextmenu', function (e) {
                            return false;
                        });

                        usageDiv.on('rowclick', function (event) {
                            if (event.args.rightclick) {
                                usageDiv.jqxGrid('selectrow', event.args.rowindex);
                                var rowindex = usageDiv.jqxGrid('getselectedrowindex');
                                $('#selected_row_index').val(rowindex);
                                var dataRecord = usageDiv.jqxGrid('getrowdata', rowindex);
                                $('#id_edit').val(dataRecord.id);
                                $('#deleting').html(dataRecord.adi);
                                return false;
                            } else {
                                $("#context-menu").hide();
                            }
                        });

                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Kontör Kullanım Listesi Alınırken Serviste Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kontör Kullanım Listesi Alınırken Serviste Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCredits();
    getCreditUsages();

</script>
