<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailtrapController extends Controller
{
    public function store(Request $request)
    {
        // Process the incoming email and perform desired actions
        // Example: Log email data
        \Log::info($request->all());
    }
}
