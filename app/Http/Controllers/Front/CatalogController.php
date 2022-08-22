<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

//CMS
use App\Models\Offer;
use App\Models\Page;
use App\Repositories\OfferRepository;

class CatalogController extends Controller
{
    private $repository;
    public function __construct(OfferRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        return view('front.catalog.index', [
            'page' => Page::whereId(5)->first(),
            'list' => $this->repository->allSort('ASC')
        ]);
    }

    public function show($lang, $slug)
    {
        return view('front.catalog.show', [
            'page' => Page::whereId(5)->first(),
            'offer' =>  Offer::where('slug', $slug)->first(),
            'list' => $this->repository->allSort('ASC')
        ]);
    }
}
