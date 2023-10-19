<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Payment\CreateRequest;
use App\Http\Requests\Api\User\Payment\GetByIdRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService;
    }

    public function getAll()
    {
        return $this->paymentService->getAll();
    }

    public function getApproved()
    {
        return $this->paymentService->getApproved();
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->paymentService->getById($request->id);
    }

    public function create(CreateRequest $request)
    {
        $orderId = 'order_' . strtotime('now');
        $this->paymentService->create(
            $request->creatorType,
            $request->creatorId,
            $request->relationType,
            Crypt::decrypt($request->relationId),
            $orderId,
            $request->amount
        );

        return Crypt::encrypt($orderId);
    }

    public function testJqxServerSide(Request $request)
    {
        return response()->json(
            $this->paymentService->testJqxServerSide($request)
        );
    }
}
