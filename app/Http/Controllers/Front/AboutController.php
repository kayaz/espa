<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        return view('front.mission.index', [
            'page' => Page::whereId(7)->first()
        ]);
    }
}
