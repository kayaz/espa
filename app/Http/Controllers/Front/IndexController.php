<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

// CMS
use App\Models\Boxes;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\Inline;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Testimonial;

class IndexController extends Controller
{

    public function index()
    {
        $sliders = Slider::all()->sortBy("sort");
        $gallery = Gallery::with('photos')->find(1);
        $array = Inline::getElements(1);
        $contact = Page::whereId(4)->first();
        $clients = Client::all()->sortBy("sort");
        $boxes = Boxes::all()->sortBy("sort");
        $testimonials = Testimonial::all()->sortBy("sort");

        $box_grid = 12 / count($boxes);

        return view('layouts.homepage', compact(
            [
                'sliders',
                'gallery',
                'array',
                'contact',
                'clients',
                'boxes',
                'box_grid',
                'testimonials'
            ]
        ));
    }
}
