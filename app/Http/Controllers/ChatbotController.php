<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotMessage;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    /**
     * Display the chatbot interface.
     */
    public function index()
    {
        $messages = ChatbotMessage::orderBy('created_at', 'asc')->get();
        return view('chatbot.index', compact('messages'));
    }

    /**
     * Handle user message and bot response.
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'language' => 'required|in:English,Swahili',
        ]);

        $userId = Auth::id();

        // Save the user's message
        ChatbotMessage::create([
            'user_id' => $userId,
            'message' => $request->message,
            'sender' => 'user',
            'language' => $request->language,
        ]);

        // Generate bot response
        $botReply = $this->generateBotResponse($request->message, $request->language);

        // Save bot message
        ChatbotMessage::create([
            'user_id' => $userId,
            'message' => $botReply,
            'sender' => 'bot',
            'language' => $request->language,
        ]);

        return redirect()->back()->with('success', 'Message sent!');
    }

    /**
     * Clear all user chat messages.
     */
    public function clear()
    {
        $userId = Auth::id();
        ChatbotMessage::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', 'Chat cleared successfully!');
    }

    /**
     * Generate bot responses based on message and language.
     */
    private function generateBotResponse(string $message, string $language): string
    {
        $msg = strtolower(trim($message));

        if ($language === 'Swahili') {
            if (str_contains($msg, 'habari') || str_contains($msg, 'hello') || str_contains($msg, 'hi')) {
                return 'Habari! 👋 Ninaweza kusaidia kuhusu maagizo, bidhaa, au malipo.';
            } elseif (str_contains($msg, 'bidhaa')) {
                return 'Unaweza kutazama bidhaa zetu zote hapa 👉 <a href="' . route('products.index') . '" class="text-primary fw-bold" target="_blank">Tazama Bidhaa</a>';
            } elseif (str_contains($msg, 'kategoria')) {
                return 'Hizi ndizo kategoria zetu kuu 👉 <a href="' . route('categories.index') . '" class="text-primary fw-bold" target="_blank">Angalia Kategoria</a>';
            } elseif (str_contains($msg, 'malipo')) {
                return 'Unaweza kulipa kwa COD, M-Pesa au kadi 💳.';
            } elseif (str_contains($msg, 'maagizo') || str_contains($msg, 'order')) {
                return 'Tazama maagizo yako yote hapa 👉 <a href="' . route('orders.index') . '" class="text-primary fw-bold" target="_blank">Angalia Maagizo</a>';
            } elseif (str_contains($msg, 'mawasiliano') || str_contains($msg, 'contact')) {
                return 'Unaweza kuwasiliana nasi kupitia ukurasa huu 👉 <a href="' . route('contact') . '" class="text-primary fw-bold" target="_blank">Wasiliana Nasi</a>';
            } elseif (str_contains($msg, 'msaada')) {
                return 'Kwa msaada zaidi, tembelea ukurasa wetu wa maswali 👉 <a href="' . route('faq') . '" class="text-primary fw-bold" target="_blank">Maswali ya Mara kwa Mara</a>';
            } else {
                return 'Samahani, sijaelewa vizuri. Tafadhali jaribu kuuliza kwa njia nyingine 😊';
            }
        }

        if (str_contains($msg, 'hello') || str_contains($msg, 'hi') || str_contains($msg, 'hey')) {
            return 'Hello! 👋 I can help you with orders, products, payments, or contact info.';
        } elseif (str_contains($msg, 'product') || str_contains($msg, 'shop')) {
            return 'You can browse our products here 👉 <a href="' . route('products.index') . '" class="text-primary fw-bold" target="_blank">View Products</a>';
        } elseif (str_contains($msg, 'category') || str_contains($msg, 'categories')) {
            return 'Here are our main categories 👉 <a href="' . route('categories.index') . '" class="text-primary fw-bold" target="_blank">Browse Categories</a>';
        } elseif (str_contains($msg, 'order')) {
            return 'You can view your orders here 👉 <a href="' . route('orders.index') . '" class="text-primary fw-bold" target="_blank">View Orders</a>';
        } elseif (str_contains($msg, 'payment')) {
            return 'We accept COD, M-Pesa, and card payments 💳.';
        } elseif (str_contains($msg, 'contact')) {
            return 'You can reach us through our contact page 👉 <a href="' . route('contact') . '" class="text-primary fw-bold" target="_blank">Contact Us</a>';
        } elseif (str_contains($msg, 'help') || str_contains($msg, 'support')) {
            return 'Need assistance? Visit our help page 👉 <a href="' . route('faq') . '" class="text-primary fw-bold" target="_blank">Help & FAQ</a>';
        } else {
            return "I'm sorry, I didn't quite understand that. Please try asking about products, orders, or payments 😊";
        }
    }
}
