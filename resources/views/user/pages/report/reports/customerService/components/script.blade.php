<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.selection.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsreorder.js') }}"></script>
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
<script src="{{ asset('assets/jqwidgets/jqgrid-localization.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jszip.min.js') }}"></script>

<script>

    var reportDiv = $('#report');

    var DownloadExcelButton = $('#DownloadExcelButton');

    function getReport() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.customer.indexWithServices') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                transaction_status_id: 2,
            },
            success: function (response) {
                var dataList = [];

                $.each(response.response, function (i, customer) {
                    if (customer.services.length > 0) {
                        $.each(customer.services, function (j, service) {
                            dataList.push({
                                taxNumber: customer.tax_number,
                                name: customer.name,
                                service: service.service.name,
                                amount: service.amount,
                                price: service.service.price,
                                start: reformatDatetimeToDateForHuman(service.start),
                                end: (new Date() > new Date(service.end)) ? 'Sona Erdi' : reformatDatetimeToDateForHuman(service.end),
                            });
                        });
                    }
                });

                var source = {
                    localdata: dataList,
                    datatype: "array",
                    datafields: [
                        {name: 'taxNumber'},
                        {name: 'name'},
                        {name: 'service'},
                        {name: 'amount'},
                        {name: 'price'},
                        {name: 'start'},
                        {name: 'end'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                reportDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: dataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: 'metro',
                    filterable: true,
                    showfilterrow: true,
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: 'VKN/TCKN',
                            dataField: 'taxNumber',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Müşteri',
                            dataField: 'name',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hizmet',
                            dataField: 'service',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Adet',
                            dataField: 'amount',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Fiyat',
                            dataField: 'price',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Başlangıç',
                            dataField: 'start',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Bitiş',
                            dataField: 'end',
                            columntype: 'textbox',
                        }
                    ]
                });
                reportDiv.on('contextmenu', function () {
                    return false;
                });
                reportDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        $("#employeesGrid").jqxGrid('selectrow', event.args.rowindex);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();
                        contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        return false;
                    }
                });
                DownloadExcelButton.show();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rapor alınırken bir hata oluştu.');
            }
        });
    }

    getReport();

    DownloadExcelButton.click(function () {
        reportDiv.jqxGrid('exportdata', 'xlsx', 'Müşteri Kontör Raporu');
    });

</script>
