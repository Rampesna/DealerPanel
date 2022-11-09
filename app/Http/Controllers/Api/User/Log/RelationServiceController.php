<?php

namespace App\Http\Controllers\Api\User\Log;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerService\DatatableRequest;
use App\Services\RelationServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RelationServiceController extends Controller
{
    private $relationServiceService;

    public function __construct()
    {
        $this->relationServiceService = new RelationServiceService;
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->relationServiceService->index(
            $request->relation_type,
            $relation_id,
            $request->transaction_status_id
        );
    }

    /**
     * @param Request $request
     */
    public function datatable(Request $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->relationServiceService->datatable(
            $request->relation_type,
            $relation_id,
            $request->transaction_status_id
        );
    }
}
