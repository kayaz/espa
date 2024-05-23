<?php

namespace App\Observers;

use Illuminate\Support\Str;

// CMS
use App\Models\Offer;

class OfferObserver
{

    /**
     * Handle the article "saving" event.
     *
     * @param Offer $offer
     * @return void
     */
    public function saving(Offer $offer)
    {
        if(app()->getLocale() == 'pl') {
            $offer->slug = Str::slug($offer->title);
        }
    }
}
