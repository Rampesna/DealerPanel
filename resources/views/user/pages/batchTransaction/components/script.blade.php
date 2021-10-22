<script>

    var customers = $('#customers');

    function getCustomers() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.customer.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
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
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getCustomers();

</script>
