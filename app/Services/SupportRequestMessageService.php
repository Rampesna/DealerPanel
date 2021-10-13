<?php

namespace App\Services;

use App\Models\SupportRequest;
use App\Models\SupportRequestMessage;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;

class SupportRequestMessageService
{
    use Response;

    /**
     * @param int|null $id
     * @param string $support_request_id
     * @param string $creator_type
     * @param int $creator_id
     * @param string $message
     */
    public function save(
        $id,
        $support_request_id,
        $creator_type,
        $creator_id,
        $message
    )
    {
        $supportRequestMessage = $id ? SupportRequestMessage::find($id) : new SupportRequestMessage;

        if ($id && !$supportRequestMessage) {
            return $this->error('Support request message not found', 404);
        }

        $supportRequestMessage->support_request_id = Crypt::decrypt($support_request_id);
        $supportRequestMessage->creator_type = $creator_type;
        $supportRequestMessage->creator_id = $creator_id;
        $supportRequestMessage->message = $message;
        $supportRequestMessage->save();

        return $this->success('Support request message saved successfully', $supportRequestMessage);
    }
}
