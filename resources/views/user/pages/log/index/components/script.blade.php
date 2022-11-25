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
        toastr.info('Kayıtlar Yükleniyor Lütfen Bekleyin...');
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.log.relationService.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {

                console.log(response.response);

                var dataList = [];

                $.each(response.response, function (i, relationService) {
                    dataList.push({
                        id: relationService.id,
                        createdAt: reformatDatetimeForHuman(relationService.created_at),
                        creatorType: relationService.creator_type === 'App\\Models\\User' ? 'Yönetici' : (
                            relationService.creator_type === 'App\\Models\\Dealer' ? 'Bayi' : (
                                relationService.creator_type === 'App\\Models\\Customer' ? 'Müşteri' : relationService.creator_type
                            )
                        ),
                        creator: relationService.creator ? relationService.creator.name : '',
                        relationType: relationService.relation_type === 'App\\Models\\User' ? 'Yönetici' : (
                            relationService.relation_type === 'App\\Models\\Dealer' ? 'Bayi' : (
                                relationService.relation_type === 'App\\Models\\Customer' ? 'Müşteri' : relationService.relation_type
                            )
                        ),
                        relation: relationService.relation ? relationService.relation.name : '',
                        relationDealer: relationService.relation.dealer ? relationService.relation.dealer.name : '',
                        serviceName: relationService.service ? relationService.service.name : '',
                        serviceAmount: relationService.amount ?? '',
                        serviceStart: relationService.start ? reformatDatetimeForHuman(relationService.start) : '',
                        serviceEnd: relationService.end ? reformatDatetimeForHuman(relationService.end) : '',
                    });
                });

                var source = {
                    localdata: dataList,
                    datatype: "array",
                    datafields: [
                        {name: 'id'},
                        {name: 'createdAt'},
                        {name: 'creatorType'},
                        {name: 'creator'},
                        {name: 'relationType'},
                        {name: 'relation'},
                        {name: 'relationDealer'},
                        {name: 'serviceName'},
                        {name: 'serviceAmount'},
                        {name: 'serviceStart'},
                        {name: 'serviceEnd'},
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
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Oluşturulma Tarihi',
                            dataField: 'createdAt',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Oluşturan',
                            dataField: 'creatorType',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Oluşturan Ünvan',
                            dataField: 'creator',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hizmeti Alan',
                            dataField: 'relationType',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hizmeti Alan Ünvan',
                            dataField: 'relation',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Bayi Bilgisi',
                            dataField: 'relationDealer',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hizmet',
                            dataField: 'serviceName',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hizmet Adeti',
                            dataField: 'serviceAmount',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hizmet Başlangıç',
                            dataField: 'serviceStart',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hizmet Bitiş',
                            dataField: 'serviceEnd',
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
        reportDiv.jqxGrid('exportdata', 'xlsx', 'Hizmet Logları');
    });

</script>
