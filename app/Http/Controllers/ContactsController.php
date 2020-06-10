<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    // public function index()
    // {
    //     return view('/contacts');
    // }

    public function create()
    {
        return view('/contacts');
    }

    public function store()
    {
        $data = request()->validate([
            'user_name' => 'required',
            'user_email' => 'required|email',
            'topic' => 'required',
            'message' => 'required'
        ]);

        Mail::to(env('CONTACT_EMAIL', 'test@test.com'))
            ->send(new ContactMail($data));

        return redirect('/contacts');
    }
}
