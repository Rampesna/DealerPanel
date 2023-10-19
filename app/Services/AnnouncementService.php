<?php

namespace App\Services;

use App\Models\Announcement;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class AnnouncementService
{
    use Response;

    public function index()
    {
        return $this->success(
            'Announcements',
            Announcement::get()->skip(0)->take(5)
        );
    }

    public function getById(
        $id
    )
    {
        return $this->success(
            'Announcement',
            Announcement::find($id)
        );
    }

    public function datatable()
    {
        $announcements = Announcement::with([]);

        return DataTables::of($announcements)->make(true);
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        if (!$announcement = Announcement::with([])->find($id)) {
            return $this->error('Announcement not found', 404);
        }

        return $this->success('Announcement details', $announcement);
    }

    public function create(
        $title,
        $description
    )
    {
        $announcement = new Announcement;
        $announcement->title = $title;
        $announcement->description = $description;
        $announcement->save();

        return $this->success('Announcement created', $announcement);
    }

    public function update(
        $id,
        $title,
        $description
    )
    {
        $announcement = Announcement::find($id);
        $announcement->title = $title;
        $announcement->description = $description;
        $announcement->save();

        return $this->success('Announcement updated', $announcement);
    }

    public function drop(
        $id
    )
    {
        return $this->success('Announcement deleted', Announcement::destroy($id));
    }
}
