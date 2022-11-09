<?php

namespace App\Services;

use App\Models\RelationService;
use App\Models\Dealer;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class RelationServiceService
{
    use Response;

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     * @param int|null $transaction_status_id
     */
    public function index(
        $relation_type = null,
        $relation_id = null,
        $transaction_status_id = null
    )
    {
        $relationServices = RelationService::with([
            'creator',
            'relation',
            'service'
        ]);

        if ($relation_type && $relation_id) {
            $relationServices->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        if ($transaction_status_id) {
            $relationServices->where('transaction_status_id', $transaction_status_id);
        }

        return $this->success('Relation services', $relationServices->get());
    }

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     * @param int|null $transaction_status_id
     */
    public function datatable(
        $relation_type = null,
        $relation_id = null,
        $transaction_status_id = null
    )
    {
        $relationServices = RelationService::with([]);

        if ($relation_type && $relation_id) {
            $relationServices->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        if ($transaction_status_id) {
            $relationServices->where('transaction_status_id', $transaction_status_id);
        }

        return DataTables::of($relationServices)->
        editColumn('relation_type', function ($relationService) {
            return $relationService->relation_type == 'App\\Models\\Customer' ? 'Müşteri' : (
            $relationService->relation_type == 'App\\Models\\Dealer' ? 'Bayi' : ''
            );
        })->
        editColumn('creator_type', function ($relationService) {
            return $relationService->creator_type == 'App\\Models\\Customer' ? 'Müşteri' : (
            $relationService->creator_type == 'App\\Models\\Dealer' ? 'Bayi' : (
            $relationService->creator_type == 'App\\Models\\User' ? 'Yönetici' : (
            $relationService->creator_type
            )
            )
            );
        })->
        editColumn('relation_id', function ($relationService) {
            return $relationService->relation ? $relationService->relation->name : '';
        })->
        editColumn('creator_id', function ($relationService) {
            return $relationService->creator ? $relationService->creator->name : '';
        })->
        editColumn('service_id', function ($relationService) {
            return $relationService->service ? $relationService->service->name : '';
        })->
        editColumn('status_id', function ($relationService) {
            return $relationService->status ? $relationService->status->name : '';
        })->
        editColumn('start', function ($relationService) {
            return date('d.m.Y, H:i', strtotime($relationService->start ?? ''));
        })->
        editColumn('end', function ($relationService) {
            return date('d.m.Y, H:i', strtotime($relationService->end ?? ''));
        })->
        editColumn('created_at', function ($relationService) {
            return $relationService->created_at ? date('d.m.Y, H:i', strtotime($relationService->created_at ?? '')) : '';
        })->
        addColumn('transaction_status', function ($relationService) {
            return $relationService->transactionStatus ? $relationService->transactionStatus->name : '';
        })->
        make(true);
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        $relationService = RelationService::find($id);

        if (!$relationService) {
            return $this->error('Relation service not found', 404);
        }

        return $this->success('Relation service details', $relationService);
    }

    /**
     * @param int|null $id
     * @param string $creator_type
     * @param int $creator_id
     * @param string $relation_type
     * @param int $relation_id
     * @param int $service_id
     * @param \DateTime $start
     * @param \DateTime $end
     * @param double $amount
     * @param int $status_id
     */
    public function save(
        $id,
        $creator_type,
        $creator_id,
        $relation_type,
        $relation_id,
        $service_id,
        $start,
        $end,
        $amount,
        $status_id
    )
    {
        $relationService = $id ? RelationService::find($id) : new RelationService;

        if ($id && !$relationService) {
            return $this->error('Relation service not found', 404);
        }

        $relationService->creator_type = $creator_type;
        $relationService->creator_id = $creator_id;
        $relationService->relation_type = $relation_type;
        $relationService->relation_id = $relation_id;
        $relationService->service_id = $service_id;
        $relationService->start = $start;
        $relationService->end = $end;
        $relationService->amount = $amount;
        $relationService->status_id = $status_id;
        $relationService->save();

        return $this->success('Relation service saved successfully', $relationService);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        $relationService = RelationService::find($id);

        if (!$relationService) {
            return $this->error('Relation service not found', 404);
        }

        return $this->success('Relation service deleted successfully', $relationService->delete());
    }

    /**
     * @param int $relation_service_id
     * @param int $transaction_status_id
     * @param string $auth_type
     * @param int $auth_id
     */
    public function updateTransactionStatus(
        $relation_service_id,
        $transaction_status_id
    )
    {
        $relationService = RelationService::find($relation_service_id);

        if (!$relationService) {
            return $this->error('Relation service not found', 404);
        }

        if (
            $transaction_status_id == 2
        ) {
            if ($relationService->transaction_status_id == 2) {
                return $this->error('Relation service already accepted', 400);
            }

            $creditService = new CreditService;

            if ($relationService->creator_type == 'App\\Models\\Dealer') {
                if (Dealer::find($relationService->creator_id)->balance < ($relationService->amount * $relationService->service->price)) {
                    return $this->error('Not enough balance', 400);
                }
            }

            $creditService->save(
                null,
                $relationService->relation_type,
                $relationService->relation_id,
                $relationService->id,
                $relationService->amount * $relationService->service->credit_amount,
                1,
                'Hizmet Onayı İle Otomatik Kontör Aktarımı'
            );

            $creditService->save(
                null,
                $relationService->creator_type,
                $relationService->creator_id,
                $relationService->id,
                $relationService->amount * $relationService->service->credit_amount,
                0,
                'Müşteriye Aktarılan Kontörün Bakiyeden Otomatik Düşülme İşlemi'
            );

            $receiptService = new ReceiptService;
            $receiptService->save(
                null,
                $relationService->creator_type,
                $relationService->creator_id,
                $relationService->relation_type,
                $relationService->relation_id,
                1,
                $relationService->id,
                $relationService->amount * $relationService->service->price
            );
        }

        $relationService->transaction_status_id = $transaction_status_id;
        $relationService->save();

        return $this->success('Relation service transaction status updated successfully', $relationService);
    }
}
