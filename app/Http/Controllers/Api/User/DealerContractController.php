<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Contract\IndexRequest;
use App\Http\Requests\Api\User\Contract\DatatableRequest;
use App\Http\Requests\Api\User\Contract\ShowRequest;
use App\Http\Requests\Api\User\Contract\SaveRequest;
use App\Http\Requests\Api\User\Contract\DropRequest;
use App\Http\Requests\Api\User\Contract\UploadFileRequest;
use App\Services\ContractService;
use Illuminate\Support\Facades\Crypt;

class DealerContractController extends Controller
{
    private $contractService;

    public function __construct()
    {
        $this->contractService = new ContractService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->contractService->index($request->relation_type, $relation_id);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->contractService->datatable($request->relation_type, $relation_id);
    }

    /**
     * @param ShowRequest $request
     */
    public function show(ShowRequest $request)
    {
        return $this->contractService->show($request->id);
    }

    /**
     * @param SaveRequest $request
     */
    public function save(SaveRequest $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->contractService->save(
            $request->id,
            $request->relation_type,
            $relation_id,
            $request->number,
            $request->start,
            $request->end,
            $request->description,
            $request->status_id,
            $request->file('file')
        );
    }

    /**
     * @param DropRequest $request
     */
    public function drop(DropRequest $request)
    {
        return $this->contractService->drop($request->id);
    }

    /**
     * @param UploadFileRequest $request
     */
    public function uploadFile(UploadFileRequest $request)
    {
        return $this->contractService->uploadFile($request->id, $request->file('file'));
    }
}
