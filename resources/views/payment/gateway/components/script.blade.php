<script>

    var PaymentButton = $('#PaymentButton');

    PaymentButton.click(function () {
        var creditCardHolderName = $('#creditCardHolderName').val();
        var creditCardNumber = $('#creditCardNumber').val();
        var creditCardMonth = $('#creditCardMonth').val();
        var creditCardYear = $('#creditCardYear').val();
        var creditCardCvc = $('#creditCardCvc').val();
        var orderId = '{{ $payment->order_id }}';
        var amount = '{{ $payment->amount }}';

        if (!creditCardHolderName) {
            toastr.warning('Kartın Üzerindeki İsim Boş Olamaz!');
        } else if (!creditCardNumber) {
            toastr.warning('Kart Numarası Boş Olamaz!');
        } else if (!creditCardMonth) {
            toastr.warning('Ay Boş Olamaz!');
        } else if (!creditCardYear) {
            toastr.warning('Yıl Boş Olamaz!');
        } else if (!creditCardCvc) {
            toastr.warning('CVV Boş Olamaz!');
        } else if (!orderId) {
            toastr.warning('Sipariş Numarası Boş Olamaz!');
        } else if (!amount) {
            toastr.warning('Ödeme Tutarı Boş Olamaz!');
        } else {
            PaymentButton.attr('disabled', true);
            $.ajax({
                type: 'post',
                url: '{{ route('payment.create') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    creditCardHolderName: creditCardHolderName,
                    creditCardNumber: creditCardNumber,
                    creditCardMonth: creditCardMonth,
                    creditCardYear: creditCardYear,
                    creditCardCvc: creditCardCvc,
                    orderId: orderId,
                    amount: amount
                },
                success: function (paramServicePosPaymentResponse) {
                    window.location.href = paramServicePosPaymentResponse.Pos_OdemeResult.UCD_URL;
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Param Servisinde Hata Oluştu! Lütfen Daha Sonra Tekrar Deneyin.');
                    PaymentButton.attr('disabled', false);
                }
            });
        }
    });

</script>
