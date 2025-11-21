<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminReplyFeedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function reply(Request $request, Feedback $feedback)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        Mail::to($feedback->email)->send(new AdminReplyFeedback($feedback, $request->reply));

        return redirect()->route('admin.feedback.index')->with('success', "Reply sent to {$feedback->user_name}!");
    }
}
