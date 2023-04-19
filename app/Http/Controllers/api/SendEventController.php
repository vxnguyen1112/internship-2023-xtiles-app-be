<?php

    namespace App\Http\Controllers\api;

    use App\Events\Event;
    use App\Helpers\CommonResponse;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\SendEventRequest;
    use Illuminate\Http\Request;

    class SendEventController extends Controller
    {
        public function sendEvent(SendEventRequest $request)
        {
            $data = $request->all();
            $sendEvent = new Event($data['id']);
            $account_id = auth()->user()['id'];
            event($sendEvent->create($data['event'], $account_id, $data['data']));
            return CommonResponse::sendSuccessfullyResponse();
        }
    }
