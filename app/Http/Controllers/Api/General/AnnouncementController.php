<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\District\IndexRequest;
use App\Services\AnnouncementService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private $announcementService;

    public function __construct()
    {
        $this->announcementService = new AnnouncementService;
    }

    public function index(IndexRequest $request)
    {
        return $this->announcementService->index();
    }

    public function getById(Request $request)
    {
        return $this->announcementService->getById(
            $request->id
        );
    }
}
