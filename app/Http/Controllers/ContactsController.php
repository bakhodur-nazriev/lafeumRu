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
            'name' => 'required',
            'email' => 'required|email',
            'theme' => 'required',
            'message' => 'required'
        ]);
        Mail::to('test@test.com')->send(new ContactMail($data));

        return redirect('/contacts');
    }
}
