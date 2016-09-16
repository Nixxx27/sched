<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class AboutController extends Controller
{
    function company()
    {
        return view('pages.about.company');
    }

}
