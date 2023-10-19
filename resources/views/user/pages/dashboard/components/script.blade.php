<script>

    var announcementsRow = $('#announcementsRow');

    function getAnnouncements() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.announcement.index') }}',
            headers: {},
            data: {},
            success: function (response) {
                announcementsRow.html('');
                $.each(response.response, function (i, announcement) {
                    announcementsRow.append(`
                    <div class="announcementItem">
                        <hr class="text-muted pb-3">
                        <div class="d-flex align-items-center pb-3">
                            <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                <div class="">
                                    <i class="fa fa-info-circle fa-2x text-warning"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <div onclick="openAnnouncement(${announcement.id})" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg mb-1 cursor-pointer">${announcement.title}</div>
                                <span class="text-dark-50 font-weight-normal font-size-sm">
                                ${announcement.description.substring(0, 100)}
                            </span>
                            </div>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function openAnnouncement(id) {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.general.announcement.getById') }}',
            headers: {},
            data: {
                id: id
            },
            success: function (response) {
                $('#announcement_title').html(response.response.title);
                $('#announcement_description').html(response.response.description);
                $('#AnnouncementModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });

    }

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
                var accepted = 0;
                var waiting = 0;
                $.each(response.response, function (i, customer) {
                    if (customer.transaction_status_id === 2) accepted += 1;
                    if (customer.transaction_status_id === 1) waiting += 1;
                });
                $('#acceptedCustomerSpan').html(accepted);
                $('#waitingCustomerSpan').html(waiting);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Müşteri Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
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
                var accepted = 0;
                var waiting = 0;
                $.each(response.response, function (i, dealer) {
                    if (dealer.transaction_status_id === 2) accepted += 1;
                    if (dealer.transaction_status_id === 1) waiting += 1;
                });
                $('#acceptedDealerSpan').html(accepted);
                $('#waitingDealerSpan').html(waiting);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getOpportunities() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.user.opportunity.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {},
            success: function (response) {
                $('#opportunitiesSpan').html(Object.keys(response.response).length);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fırsat Verileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCustomers();
    getDealers();
    getOpportunities();
    getAnnouncements();

</script>
