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
<script src="{{ asset('assets/jqwidgets/jqxgrid.edit.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxexport.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.grouping.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/globalization/globalize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqgrid-localization.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jszip.min.js') }}"></script>

<script>

    var selectedIdSelector = $('#selected_id');
    var updateStatusStatusIdSelector = $('#update_status_status_id');

    var corporatesDiv = $('#corporates');
    var UpdateStatusButton = $('#UpdateStatusButton');

    var baseUrl = `https://basvuruapi.bienteknoloji.com.tr/`;
    var bienteknolojiBasvuruApiToken = localStorage.getItem('bienteknolojiBasvuruApiToken');

    function login() {
        var endpoint = `api/login`;

        var email = `basvuru_trendyol@mail.com`;
        var password = `trendyol`;

        $.ajax({
            type: 'post',
            url: baseUrl + endpoint,
            headers: {
                'Accept': 'application/json',
            },
            data: {
                email: email,
                password: password
            },
            success: function (response) {
                localStorage.setItem('bienteknolojiBasvuruApiToken', response.data.token);
                bienteknolojiBasvuruApiToken = response.data.token;
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

    function getTrendyolCorporates() {
        var endpoint = `api/v1/getTrendyolCorporates`;

        if (bienteknolojiBasvuruApiToken == null) {
            login();
        }

        $.ajax({
        	type: 'get',
        	url: baseUrl + endpoint,
        	headers: {
        		'Accept': 'application/json',
        		'Authorization': 'Bearer ' + bienteknolojiBasvuruApiToken
        	},
        	data: {},
        	success: function (response) {
                console.log(response);
                var source = {
                    localdata: response.data,
                    datatype: "array",
                    datafields: [
                        {name: 'id'},
                        {name: 'TaxId'},
                        {name: 'Title'},
                        {name: 'statusDescription'},
                        {name: 'ContactName'},
                        {name: 'Email'},
                        {name: 'Phone'},
                        {name: 'EFatura'},
                        {name: 'EFaturaAktivasyonGecisTarihi'},
                        {name: 'EFaturaGondericiBirim'},
                        {name: 'EFaturaPostaKutusu'},
                        {name: 'EArsiv'},
                        {name: 'EArsivAktivasyonGecisTarihi'},
                        {name: 'EIrsaliye'},
                        {name: 'EIrsaliyeAktivasyonGecisTarihi'},
                        {name: 'EIrsaliyeGondericiBirim'},
                        {name: 'EIrsaliyePostaKutusu'},
                        {name: 'EMustahsilMakbuz'},
                        {name: 'EMustahsilMakbuzAktivasyonGecisTarihi'},
                        {name: 'ESerbestMeslekMakbuz'},
                        {name: 'ESerbestMeslekMakbuzAktivasyonGecisTarihi'},
                        {name: 'Address'},
                        {name: 'a.b'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                corporatesDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: dataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: 'metro',
                    filterable: true,
                    showfilterrow: true,
                    editable: true,
                    editmode: 'dblclick',
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                            width: '3%'
                        },
                        {
                            text: 'VKN/TCKN',
                            dataField: 'TaxId',
                            columntype: 'textbox',
                            width: '6%'
                        },
                        {
                            text: 'ÜNVAN',
                            dataField: 'Title',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'DURUM',
                            dataField: 'statusDescription',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'İLETİŞİM BİLGİSİ',
                            dataField: 'ContactName',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'E-POSTA',
                            dataField: 'Email',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'TELEFON',
                            dataField: 'Phone',
                            columntype: 'textbox',
                            width: '8%'
                        },
                        {
                            text: 'E-FATURA',
                            dataField: 'EFatura',
                            columntype: 'textbox',
                            width: '4%'
                        },
                        {
                            text: 'E-FATURA AKTİVASYON GEÇİŞ TARİHİ',
                            dataField: 'EFaturaAktivasyonGecisTarihi',
                            columntype: 'textbox',
                            width: '8%'
                        },
                        {
                            text: 'E-FATURA GÖNDERİCİ BİRİM',
                            dataField: 'EFaturaGondericiBirim',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'E-FATURA POSTA KUTUSU',
                            dataField: 'EFaturaPostaKutusu',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'E-ARŞİV',
                            dataField: 'EArsiv',
                            columntype: 'textbox',
                            width: '4%'
                        },
                        {
                            text: 'E-ARŞİV AKTİVASYON GEÇİŞ TARİHİ',
                            dataField: 'EArsivAktivasyonGecisTarihi',
                            columntype: 'textbox',
                            width: '8%'
                        },
                        {
                            text: 'E-İRSALİYE',
                            dataField: 'EIrsaliye',
                            columntype: 'textbox',
                            width: '4%'
                        },
                        {
                            text: 'E-İRSALİYE AKTİVASYON GEÇİŞ TARİHİ',
                            dataField: 'EIrsaliyeAktivasyonGecisTarihi',
                            columntype: 'textbox',
                            width: '8%'
                        },
                        {
                            text: 'E-İRSALİYE GÖNDERİCİ BİRİM',
                            dataField: 'EIrsaliyeGondericiBirim',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'E-İRSALİYE POSTA KUTUSU',
                            dataField: 'EIrsaliyePostaKutusu',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'E-MUSTAHSİL MAKBUZ',
                            dataField: 'EMustahsilMakbuz',
                            columntype: 'textbox',
                            width: '4%'
                        },
                        {
                            text: 'E-MUSTAHSİL MAKBUZ AKTİVASYON GEÇİŞ TARİHİ',
                            dataField: 'EMustahsilMakbuzAktivasyonGecisTarihi',
                            columntype: 'textbox',
                            width: '8%'
                        },
                        {
                            text: 'E-SERBEST MESLEK MAKBUZ',
                            dataField: 'ESerbestMeslekMakbuz',
                            columntype: 'textbox',
                            width: '4%'
                        },
                        {
                            text: 'E-SERBEST MESLEK MAKBUZ AKTİVASYON GEÇİŞ TARİHİ',
                            dataField: 'ESerbestMeslekMakbuzAktivasyonGecisTarihi',
                            columntype: 'textbox',
                            width: '4%'
                        },
                        {
                            text: 'ADRES',
                            dataField: 'Address',
                            columntype: 'textbox',
                            width: '8%'
                        },
                        {
                            text: 'TEST',
                            dataField: 'a.b',
                            columntype: 'textbox',
                            width: '8%'
                        }
                    ]
                });
                corporatesDiv.on('contextmenu', function () {
                    return false;
                });
                corporatesDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        selectedIdSelector.val(event.args.row.bounddata.id);
                        $("#corporates").jqxGrid('selectrow', event.args.rowindex);

                        var e = window.event;

                        var top = e.pageY - 10;
                        var left = e.pageX - 10;

                        $("#context-menu").css({
                            display: "block",
                            top: top,
                            left: left
                        });

                        return false;
                    }
                });
                // DownloadExcelButton.show();
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

    function createNewCorporate(id) {

        var updateId = id;

        var endpoint = `api/v1/getTrendyolCorporate`;

        if (bienteknolojiBasvuruApiToken == null) {
            login();
        }

        $.ajax({
            type: 'get',
            url: baseUrl + endpoint,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + bienteknolojiBasvuruApiToken
            },
            data: {
                id: id,
            },
            success: function (responseData) {
                var response = responseData.data;

                var updateTaxId = response.TaxId;

                var name = response.TaxId.length === 11 ? response.tcknData.Ad : response.Title;
                var vkTckNo = response.TaxId ?? ' ';
                var typeEnum = response.TaxId.length === 11 ? 'Person' : 'Enterprise';
                var taxOffice = response.TaxOffice ?? ' ';
                var ownerTypeEnum = 'Private';
                var webSite = response.tcknData.WebAdres !== "null" ? response.tcknData.WebAdres : 'www.trendyol.com';
                var addressCountry = 'Türkiye';
                var addressCity = response.tcknData.Il ?? ' ';
                var addressSubDivisionName = response.tcknData.Ilce ?? ' ';
                var addressStreetName = response.tcknData.Adres ?? ' ';
                var surname = response.tcknData.Soyad ?? ' ';
                var contactName = response.ContactName ?? ' ';
                var contactPhone = response.tcknData.AdminCepTelefonAlanKodu && response.tcknData.AdminCepTelefonNo ?
                    response.tcknData.AdminCepTelefonAlanKodu + response.tcknData.AdminCepTelefonNo: ' ';
                var contactEmail = response.tcknData.AdminEPosta ?? ' ';
                var parentCustomer = 0;
                var sourceType = 3;
                var sourceTypeEnum = 'Trendyol';
                var businessDescription = ' ';
                var email = response.Email ?? ' ';
                var faxNumber = response.Fax ?? ' ';
                var fiscalYearMonth = 1;
                var phoneNumber = response.Phone ?? ' ';
                var phoneTypeEnum = 'Direct';
                var notificationEmails = [];
                var createDefaultUsers = true;
                var usersType = 'CustomUser1';
                var usersUsername = `${response.TaxId}_Trendyol_Webservis`;
                var usersFirstName = response.tcknData.Ad ?? ' ';
                var usersSurname = response.tcknData.Soyad ?? ' ';
                var usersEmail = response.tcknData.AdminEPosta ?? ' ';

                var crsData = {
                    name: name,
                    vkTckNo: vkTckNo,
                    typeEnum: typeEnum,
                    taxOffice: taxOffice,
                    ownerTypeEnum: ownerTypeEnum,
                    webSite: webSite,
                    addressCountry: addressCountry,
                    addressCity: addressCity,
                    addressSubDivisionName: addressSubDivisionName,
                    addressStreetName: addressStreetName,
                    surname: surname,
                    contactName: contactName,
                    contactPhone: contactPhone,
                    contactEmail: contactEmail,
                    parentCustomer: parentCustomer,
                    sourceType: sourceType,
                    sourceTypeEnum: sourceTypeEnum,
                    businessDescription: businessDescription,
                    email: email,
                    faxNumber: faxNumber,
                    fiscalYearMonth: fiscalYearMonth,
                    phoneNumber: phoneNumber,
                    phoneTypeEnum: phoneTypeEnum,
                    notificationEmails: notificationEmails,
                    createDefaultUsers: createDefaultUsers,
                    usersType: usersType,
                    usersUsername: usersUsername,
                    usersFirstName: usersFirstName,
                    usersSurname: usersSurname,
                    usersEmail: usersEmail
                };

                $.ajax({
                	type: 'post',
                	url: '{{ route('api.v1.user.crsService.CreateNewCustomer') }}',
                	headers: {
                        _token: '{{ auth()->user()->apiToken() }}',
                        _auth_type: 'User'
                	},
                	data: crsData,
                	success: function () {
                        updateWebService(
                            updateId,
                            updateTaxId,
                            usersUsername,
                            'password'
                        );
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

    function updateStatus() {
        $('#UpdateStatusModal').modal('show');
    }

    function updateWebService(
        id,
        taxId,
        webServiceUsername,
        webServicePassword
    ) {
        var endpoint = `api/v1/updateWebService`;

        $.ajax({
            type: 'post',
            url: baseUrl + endpoint,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + bienteknolojiBasvuruApiToken
            },
            data: {
                id: id,
                taxId: taxId,
                webServiceUsername: webServiceUsername,
                webServicePassword: webServicePassword
            },
            success: function (response) {
                toastr.success(response.message);
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

    getTrendyolCorporates();

    $('body').on('contextmenu', function () {
        return false;
    }).on('click', function () {
        $("#context-menu").hide();
    });

    UpdateStatusButton.click(function () {
        UpdateStatusButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        var id = parseInt(selectedIdSelector.val());
        var statusId = parseInt(updateStatusStatusIdSelector.val());

        if (statusId === 5) {
            createNewCorporate(id);
        }

        var endpoint = `api/v1/updateTrendyolCorporate`;

        if (bienteknolojiBasvuruApiToken == null) {
            login();
        }

        $.ajax({
            type: 'post',
            url: baseUrl + endpoint,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + bienteknolojiBasvuruApiToken
            },
            data: {
                id: id,
                status: statusId
            },
            success: function (response) {
                toastr.success(response.message);
                UpdateStatusButton.attr('disabled', false).html('Güncelle');
                $('#UpdateStatusModal').modal('hide');
            },
            error: function (error) {
                console.log(error);
                UpdateStatusButton.attr('disabled', false).html('Güncelle');
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });
    });

</script>
