<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $msg = Message::all();
        return response()->json($msg, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $covId = Conversation::findOrFail($id);
        $request->validate([
            'message'=>'string|required',
            'sender_id'=>'required|exists:users,id'
        ]);

        $msg = Message::create([
            'message'=>$request->message,
            'sender_id'=>$request->sender_id,
            'conv_id'=>$id
        ]);
        return response()->json([
            'msg'=>'message received',
            'data'=>$msg
        ], 200);

    }

    /**
     * Get messages for a specific conversation
     */
    public function show($id)
    {
        $msg = Message::where('conv_id',$id)->orderBy('created_at', 'asc')->get();
        return response()->json($msg, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $messages)
    {
        //
    }
}
