<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\DealerUser;
use App\Models\SupportRequest;
use App\Models\SupportRequestCategory;
use App\Models\SupportRequestPriority;
use App\Models\SupportRequestStatus;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class SupportRequestService
{
    use Response;

    /**
     * @param string|null $creator_type
     * @param int|null $creator_id
     */
    public function index(
        $creator_type = null,
        $creator_id = null
    )
    {
        $supportRequests = SupportRequest::with([]);

        if ($creator_type && $creator_id) {
            $supportRequests->where('creator_type', $creator_type)->where('creator_id', $creator_id);
        }

        return $this->success('Support requests', $supportRequests->get());
    }

    /**
     * @param string|null $creator_type
     * @param int|null $creator_id
     */
    public function datatable(
        $creator_type = null,
        $creator_id = null
    )
    {
        $supportRequests = SupportRequest::with([
            'creator',
        ]);

        if ($creator_type && $creator_id) {
            $supportRequests->where('creator_type', $creator_type)->where('creator_id', $creator_id);
        }

        return DataTables::of($supportRequests)->
        filterColumn('creator_id', function ($supportRequests, $data) {
            return $supportRequests->whereIn(
                'creator_id',
                array_merge(
                    Customer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray(),
                    DealerUser::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray(),
                    User::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray()
                )
            );
        })->
        filterColumn('category_id', function ($supportRequests, $data) {
            return $supportRequests->whereIn('category_id', SupportRequestCategory::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('priority_id', function ($supportRequests, $data) {
            return $supportRequests->whereIn('priority_id', SupportRequestPriority::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('status_id', function ($supportRequests, $data) {
            return $supportRequests->whereIn('status_id', SupportRequestStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('creator_type', function ($supportRequest) {
            return $supportRequest->creator_type == 'App\\Models\\Customer' ? 'Müşteri' : (
            $supportRequest->creator_type == 'App\\Models\\DealerUser' ? 'Bayi' : '--'
            );
        })->
        editColumn('creator_id', function ($supportRequest) {
            return $supportRequest->creator ? $supportRequest->creator->name : '';
        })->
        editColumn('category_id', function ($supportRequest) {
            return $supportRequest->category ? $supportRequest->category->name : '';
        })->
        editColumn('priority_id', function ($supportRequest) {
            return $supportRequest->priority ? $supportRequest->priority->name : '';
        })->
        editColumn('status_id', function ($supportRequest) {
            return $supportRequest->status ? $supportRequest->status->name : '';
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
        $supportRequest = SupportRequest::with([
            'creator',
            'category',
            'priority',
            'status',
            'files',
            'messages' => function ($messages) {
                $messages->with([
                    'creator',
                    'files'
                ])->orderBy('created_at', 'desc');
            }
        ])->find(Crypt::decrypt($id));

        if (!$supportRequest) {
            return $this->error('Support request not found', 404);
        }

        return $this->success('Support request', $supportRequest);
    }

    /**
     * @param int|null $id
     * @param string $creator_type
     * @param int $creator_id
     * @param string $name
     * @param string|null $description
     * @param int $category_id
     * @param int $priority_id
     * @param int $status_id
     */
    public function save(
        $id,
        $creator_type,
        $creator_id,
        $name,
        $description,
        $category_id,
        $priority_id,
        $status_id
    )
    {
        $supportRequest = $id ? SupportRequest::find($id) : new SupportRequest;

        if ($id && !$supportRequest) {
            return $this->error('Support request not found', 404);
        }

        $supportRequest->creator_type = $creator_type;
        $supportRequest->creator_id = $creator_id;
        $supportRequest->name = $name;
        $supportRequest->description = $description;
        $supportRequest->category_id = $category_id;
        $supportRequest->priority_id = $priority_id;
        $supportRequest->status_id = $status_id;
        $supportRequest->save();

        return $this->success('Support request saved successfully', $supportRequest);
    }

    /**
     * @param string $id
     * @param int $status_id
     */
    public function updateStatus(
        $id,
        $status_id
    )
    {
        $supportRequest = SupportRequest::find(Crypt::decrypt($id));

        if (!$supportRequest) {
            return $this->error('Support request not found', 404);
        }

        $supportRequest->status_id = $status_id;
        $supportRequest->save();

        return $this->success('Support request status updated successfully', $supportRequest);
    }
}
