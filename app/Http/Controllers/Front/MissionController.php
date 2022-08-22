<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;

class MissionController extends Controller
{
    public function index()
    {
        return view('front.mission.index', [
            'page' => Page::whereId(6)->first()
        ]);
    }
}
