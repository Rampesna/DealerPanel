<script src="{{ asset('assets/plugins/custom/jstree/jstree.bundle.js') }}"></script>

<script>

    function getDealerCredits() {
        var relation_type = 'App\\Models\\Dealer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.dealer.credit.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                relation_type: relation_type,
                relation_id: relation_id,
                transaction_status_id: 2
            },
            success: function (response) {
                var total = 0;
                var used = 0;
                $.each(response.response, function (i, credit) {
                    if (credit.direction === 1) total += credit.amount;
                    if (credit.direction === 0) used += credit.amount;
                });
                var remaining = total - used;
                $('#totalCreditSpan').html(total);
                $('#usedCreditSpan').html(used);
                $('#remainingCreditSpan').html(remaining);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getDealerFinance() {
        var relation_type = 'App\\Models\\Dealer';
        var relation_id = '{{ $id }}';
        $.ajax({
            type: 'get',
            url: '{{ route('api.v1.dealerUser.dealer.receipt.index') }}',
            headers: {
                _token: '{{ auth()->user()->apiToken() }}',
                _auth_type: 'User'
            },
            data: {
                relation_type: relation_type,
                relation_id: relation_id,
            },
            success: function (response) {
                var outgoing = 0;
                var incoming = 0;
                $.each(response.response, function (i, receipt) {
                    if (receipt.direction === 1) outgoing += receipt.price;
                    if (receipt.direction === 0) incoming += receipt.price;
                });
                var balance = outgoing - incoming;
                $('#outgoingSpan').html(`${outgoing} TL`);
                $('#incomingSpan').html(`${incoming} TL`);
                $('#balance').html(`${balance} TL`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bayi Kontör Bilgileri Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getDealerCredits();
    getDealerFinance();

</script>
