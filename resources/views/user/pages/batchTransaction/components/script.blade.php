<script>

    var SelectAllButton = $('#SelectAllButton');
    var DeSelectAllButton = $('#DeSelectAllButton');
    var UpdateDealersButton = $('#UpdateDealersButton');

    var customersArray = [];

    var customers = $('#customers');
    var dealers = $('#dealers');

    var searching = $('#searching');

    function updateDealersModalTrigger() {
        $('#UpdateDealersModal').modal('show');
    }

    function setCustomersArray() {
        var selectedCustomers = $('.selectedCustomer');
        customersArray = [];
        $.each(selectedCustomers, function () {
            customersArray.push($(this).data('id'));
        });
    }

    function getCustomers() {
        $('#loader').fadeIn(250);
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.customer.searching') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                keyword: searching.val()
            },
            success: function (response) {
                var baseAsset = '{{ asset('') }}';
                customers.empty();
                $.each(response.response, function (i, customer) {
                    customers.append(`
                    <div class="col-xxl-4 col-xl-6 col-md-12 each_customer">
                            <div class="card card-custom gutter-b">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                            <div class="symbol symbol-50 symbol-lg-120 customerSelector" data-id="${customer.id}">
                                                <img src="${baseAsset}assets/media/logos/avatar.jpg" alt="image" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between flex-wrap mt-1">
                                                <div class="d-flex mr-3">
                                                    <a class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3 customer-name">${customer.name}</a>
                                                    <a>
                                                        <i class="flaticon2-correct text-success font-size-h5"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap justify-content-between mt-1">
                                                <div class="d-flex flex-column flex-grow-1 pr-8">
                                                    <div class="flex-wrap mb-4 mt-4 pt-1">
                                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-5">
                                                            <i class="flaticon2-phone mr-2 font-size-lg"></i> ${customer.gsm ?? 'Dahili Numara Yok'}
                                                        </a>
                                                        <br>
                                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-5">
                                                            <i class="flaticon2-new-email mr-2 font-size-lg"></i> ${customer.email ?? 'E-posta Adresi Yok'}
                                                        </a>
                                                        <br>
                                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-5">
                                                            <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i> ${customer.tax_number ?? '--'}
                                                        </a>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
                $('#loader').fadeOut(250);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').fadeOut(250);
            }
        });
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
                dealers.empty().append(`<optgroup label=""><option value="">Seçim Yapılmadı</option></optgroup>`);
                $.each(response.response, function (i, dealer) {
                    dealers.append(`<option value="${dealer.id}">${dealer.name}</option>`);
                });
                dealers.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCustomers();
    getDealers();

    $(document).delegate('.customerSelector', 'click', function () {
        $(this).toggleClass('selectedCustomer');
        setCustomersArray();
    });

    SelectAllButton.click(function () {
        $('.customerSelector').removeClass('selectedCustomer').addClass('selectedCustomer');
        setCustomersArray();
    });

    DeSelectAllButton.click(function () {
        $('.customerSelector').removeClass('selectedCustomer');
        setCustomersArray();
    });

    $('body').on('contextmenu', function (e) {
        if (customersArray.length > 0) {
            var top = e.pageY - 10;
            var left = e.pageX - 10;

            $("#context-menu").css({
                display: "block",
                top: top,
                left: left
            });
        }

        return false;
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

    UpdateDealersButton.click(function () {
        var dealer_id = dealers.val();

        if (dealer_id == null || dealer_id === '') {
            toastr.warning('Bayi Seçimi Yapılması Zorunludur!');
        } else if (customersArray.length <= 0) {
            toastr.warning('En Az 1 Müşteri Seçilmelidir!');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('api.v1.user.customer.updateDealer') }}',
                headers: {
                    _token: '{{ auth()->user()->apiToken() }}',
                    _auth_type: 'User'
                },
                data: {
                    dealer_id: dealer_id,
                    customer_ids: customersArray
                },
                success: function (response) {
                    console.log(response)
                    $('#UpdateDealersModal').modal('hide');
                    $('#UpdateDealersForm').trigger('reset');
                    dealers.selectpicker('refresh');
                    $('.customerSelector').removeClass('selectedCustomer');
                    setCustomersArray();
                    toastr.success('Atamalar Başarıyla Yapıldı');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Müşteriler Bayiye Atanırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    searching.on('keypress', function (e) {
        if (e.which === 13) {
            console.log('deneme')
            getCustomers();
        }
    });

</script>
