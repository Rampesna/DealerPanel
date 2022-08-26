<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ReceiptService;
use App\SoapServices\ParamService;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService;
    }

    public function gateway(Request $request)
    {
        try {
            $payment = $this->paymentService->getByOrderId(Crypt::decrypt($request->encryptedOrderId));
            if (!$payment || $payment->approved == 1) {
                abort(404);
            }

            return view('payment.gateway.index', [
                'payment' => $payment
            ]);
        } catch (\Exception $exception) {
            abort(404);
        }
    }

    public function create(Request $request)
    {
        $paramService = new ParamService;
        $paramServicePosPaymentResponse = $paramService->PosPayment(
            $request->creditCardHolderName,
            $request->creditCardNumber,
            $request->creditCardMonth,
            $request->creditCardYear,
            $request->creditCardCvc,
            '5383761370',
            $request->orderId,
            '',
            1,
            number_format($request->amount, 2, ',', ''),
            number_format($request->amount, 2, ',', ''),
            '3D'
        );

        if ($paramServicePosPaymentResponse->Pos_OdemeResult->Sonuc == "1") {
            return response()->json($paramServicePosPaymentResponse, 200);
        } else {
            return response()->json($paramServicePosPaymentResponse, 400);
        }
    }

    public function success(Request $request)
    {
        $payment = $this->paymentService->getByOrderId($request->TURKPOS_RETVAL_Siparis_ID);

        if ($payment) {
            $payment->approved = 1;
            $payment->save();

            $receiptService = new ReceiptService;
            $receiptService->save(
                null,
                $payment->creator_type,
                $payment->creator_id,
                $payment->relation_type,
                $payment->relation_id,
                0,
                null,
                $payment->amount
            );
        }

        return redirect()->route('payment.success.web');
    }

    public function successWeb()
    {
        return view('payment.success.index');
    }

    public function failure()
    {
        return redirect()->route('payment.failure.web');
    }

    public function failureWeb()
    {
        return view('payment.failure.index');
    }
}
