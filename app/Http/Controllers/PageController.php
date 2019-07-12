<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PageController extends Controller
{

    public function root()
    {
        return view('pages.root');
    }
}
