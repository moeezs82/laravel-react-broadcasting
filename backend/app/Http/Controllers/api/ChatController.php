<?php

namespace App\Http\Controllers\api;

use App\Events\Message;
use App\Events\PrivateMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function sendMsg(Request $request)
    {
        $user = auth()->user();

        event(new Message($request->message, $user->email));

        return response()->json("done");
    }

    public function privateMsg(Request $request)
    {
        $user = $request->user();

        // Create a unique channel name for the chat by combining the ids of the two users
        $channelName = 'private.channel.' . $user->id . '.' . $request->to;

        event(new PrivateMessage($request->message, $user->email, $channelName));

        return response()->json("done");
    }
}
