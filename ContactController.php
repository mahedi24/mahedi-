<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('your@email.com')
                 ->subject('Message from ' . $request->name)
                 ->replyTo($request->email);
        });

        return back()->with('success', 'Message sent successfully!');
    }
}
