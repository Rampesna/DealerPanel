<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Announcement\DropRequest;
use App\Http\Requests\Api\User\Announcement\CreateRequest;
use App\Http\Requests\Api\User\Announcement\UpdateRequest;
use App\Http\Requests\Api\User\Announcement\ShowRequest;
use App\Services\AnnouncementService;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;

class AnnouncementController extends Controller
{
    use Response;

    private $announcementService;

    public function __construct()
    {
        $this->announcementService = new AnnouncementService;
    }

    public function index()
    {
        return $this->announcementService->index();
    }

    public function datatable()
    {
        return $this->announcementService->datatable();
    }

    public function show(ShowRequest $request)
    {
        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $exception) {
            $id = $request->id;
        }
        return $this->announcementService->show($id);
    }

    public function create(CreateRequest $request)
    {
        return $this->announcementService->create(
            $request->title,
            $request->description
        );
    }

    public function update(UpdateRequest $request)
    {
        return $this->announcementService->update(
            $request->id,
            $request->title,
            $request->description
        );
    }

    public function drop(DropRequest $request)
    {
        $this->announcementService->drop($request->id);
    }
}
