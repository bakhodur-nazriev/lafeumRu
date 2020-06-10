<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    public function get()
    {
        return Feedback::all();
    }
}
