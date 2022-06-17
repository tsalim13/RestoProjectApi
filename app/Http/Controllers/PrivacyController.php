<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;

class PrivacyController extends Controller
{
    /**
     * Show the contact form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('privacy');
    }

}