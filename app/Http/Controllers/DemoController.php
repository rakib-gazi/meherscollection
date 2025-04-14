<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DemoController extends Controller
{
    //
    function demo(Request $request)
    {
        return Inertia::render('HomePage', );
    }
}
