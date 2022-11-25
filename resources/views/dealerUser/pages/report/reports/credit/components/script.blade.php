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
        toastr.info('Rapor Oluşturuluyor, Lütfen Bekleyiniz...');
        reportDiv.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.report.credit.customer.report') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                dealer_id: parseInt('{{ auth()->id() }}'),
            },
            success: function (response) {
                var source = {
                    localdata: response,
                    datatype: "array",
                    datafields: [
                        {name: 'taxNumber'},
                        {name: 'name'},
                        {name: 'dealer'},
                        {name: 'bought'},
                        {name: 'used'},
                        {name: 'remaining'},
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
                            text: 'Bayi',
                            dataField: 'dealer',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Alınan Kontör',
                            dataField: 'bought',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Kullanılan Kontör',
                            dataField: 'used',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Kalan Kontör',
                            dataField: 'remaining',
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
