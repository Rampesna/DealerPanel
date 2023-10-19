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
            url: '{{ route('api.v1.dealerUser.customer.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                dealer_id: '{{ auth()->user()->getDealerId() }}'
            },
            success: function (response) {
                $('#customersSpan').html(Object.keys(response.response).length);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kontör Bilgisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCredits() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.credit.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                relation_type: 'App\\Models\\Dealer',
                relation_id: '{{ auth()->user()->getDealerId() }}'
            },
            success: function (response) {
                var total = 0;
                var used = 0;
                $.each(response.response, function (i, credit) {
                    if (credit.direction === 1) total += credit.amount;
                    if (credit.direction === 0) used += credit.amount;
                });
                var remaining = total - used;
                $('#creditSpan').html(remaining);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kontör Bilgisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getReceipts() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.receipt.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                relation_type: 'App\\Models\\Dealer',
                relation_id: '{{ auth()->user()->getDealerId() }}'
            },
            success: function (response) {
                var outgoing = 0;
                var incoming = 0;
                $.each(response.response, function (i, receipt) {
                    if (receipt.direction === 1) outgoing += receipt.price;
                    if (receipt.direction === 0) incoming += receipt.price;
                });
                var balance = outgoing - incoming;
                $('#balanceSpan').html(`${balance} TL`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bakiye Bilgisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getSupportRequests() {
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.supportRequest.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'DealerUser'
            },
            data: {
                creator_type: 'App\\Models\\Dealer',
                creator_id: '{{ auth()->user()->getDealerId() }}'
            },
            success: function (response) {
                var counter = 0;
                $.each(response.response, function (i, supportRequest) {
                    if (supportRequest.status_id === 1) counter += 1;
                });
                $('#supportRequestsSpan').html(counter);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talepleri Bilgisi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCustomers();
    getCredits();
    getReceipts();
    getSupportRequests();
    getAnnouncements();

</script>
