<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotMessage;

class ChatbotMessageController extends Controller
{
    public function index()
    {
        $messages = ChatbotMessage::latest()->get();
        return view('admin.chatbot_messages.index', compact('messages'));
    }
}
