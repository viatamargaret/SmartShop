<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display all feedback for admin, or user-specific feedback for customers.
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $feedbacks = Feedback::with('user')->latest()->get();
        } else {
            $feedbacks = Feedback::where('user_id', Auth::id())->latest()->get();
        }

        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Store a new feedback entry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    /**
     * Allow admin to delete feedback.
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }
}
