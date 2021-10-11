<?php

namespace App\Services;

use App\Models\SupportRequestCategory;
use App\Traits\Response;

class SupportRequestCategoryService
{
    use Response;

    /**
     * @param string $type
     */
    public function index(
        $type
    )
    {
        return $this->success('Support request categories', SupportRequestCategory::where('type', $type)->get());
    }
}
