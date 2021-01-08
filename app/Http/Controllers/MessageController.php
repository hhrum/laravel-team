<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Http\Resources\Message as MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $chat = Chat::find($request->input('chatId'));
        $content = htmlspecialchars($request->input('content'));

        if (!$chat || !$content) return response()->json(false, 419);

        $message = new Message();

        $message->content = $content;
        $message->chat_id = $chat->id;
        $message->user_id = $user->id;

        $message->save();

        $chat->updated_at = $message->created_at;
        $chat->save();

        return response()->json(['status' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
