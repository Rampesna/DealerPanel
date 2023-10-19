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

    var paymentsDiv = $('#payments');
    var UpdateStatusButton = $('#UpdateStatusButton');

    function getPayments() {
        $.ajax({
        	type: 'get',
        	url: '{{ route('api.v1.user.payment.getApproved') }}',
        	headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
        	},
        	data: {},
        	success: function (response) {
                var payments = [];
                $.each(response, function (i, payment) {
                    payments.push({
                        id: payment.id,
                        taxNumber: payment.relation.tax_number,
                        title: payment.relation.name,
                        amount: `${payment.amount} TL`,
                        approvedDate: reformatDatetimeToDateForHuman(payment.updated_at),
                    });
                });

                var source = {
                    localdata: payments,
                    datatype: "array",
                    datafields: [
                        {name: 'id', type: 'string'},
                        {name: 'taxNumber', type: 'string'},
                        {name: 'title', type: 'string'},
                        {name: 'amount', type: 'string'},
                        {name: 'approvedDate', type: 'string'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);

                paymentsDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: dataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: 'metro',
                    filterable: true,
                    showfilterrow: true,
                    pageable: true,
                    sortable: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    // localization: getLocalization('tr'),
                    columns: [
                        {
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'VKN/TCKN',
                            dataField: 'taxNumber',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'Ünvan',
                            dataField: 'title',
                            columntype: 'textbox',
                            width: '40%'
                        },
                        {
                            text: 'Tutar',
                            dataField: 'amount',
                            columntype: 'textbox',
                            width: '20%'
                        },
                        {
                            text: 'Onaylanma Tarihi',
                            dataField: 'approvedDate',
                            columntype: 'textbox',
                            width: '20%'
                        }
                    ],
                });
                paymentsDiv.on('contextmenu', function (e) {
                    return false;
                });
        	},
        	error: function (error) {
        		console.log(error);
        		if (parseInt(error.status) === 422) {
        			$.each(error.responseJSON.response, function (i, error) {
        				toastr.error(error[0]);
        			});
        		} else {
        			toastr.error(error.responseJSON.message);
        		}
        	}
        });
    }

    getPayments();

</script>
