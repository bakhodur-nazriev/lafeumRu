<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    public function create()
    {
        return view('/contacts');
    }

    public function get(Request $request)
    {
        return Feedback::latest()->paginate($request->perPage ?: 15);
    }

    public function store()
    {
        $data = request()->validate([
            'user_name' => 'required',
            'user_email' => 'required|email',
            'topic' => 'required',
            'message' => 'required'
        ]);

        Feedback::create($data);

        // Mail::to(env('CONTACT_EMAIL', 'test@test.com'))
        //     ->send(new ContactMail($data));

        return redirect('/contacts');
    }
}
