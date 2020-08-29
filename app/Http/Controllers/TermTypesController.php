<?php

namespace App\Http\Controllers;

use App\TermType;
use Illuminate\Http\Request;

class TermTypesController extends Controller
{
    public function get()
    {
        return TermType::all();
    }
}
