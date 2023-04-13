<?php

namespace App\Http\Controllers\api;

use App\Events\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function sendMsg(Request $request)
    {
        event(new Message($request->message, $request->username));

        return response()->json("done");
    }
}
