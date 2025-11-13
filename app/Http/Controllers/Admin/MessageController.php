<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ChatbotMessage::with('user')->latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function reply(Request $request, $id)
    {
        $message = ChatbotMessage::findOrFail($id);
        $message->reply = $request->input('reply');
        $message->save();

        return redirect()->back()->with('success', 'Reply sent successfully');
    }
}
