<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        

        return view('pages.landing-page.contact.index');
    }
}

