<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

use App\Models\Page;
use App\Models\RodoClient;
use Illuminate\Support\Facades\Mail;

use App\Mail\MailSend;

use App\Models\Recipient;
use App\Models\RodoRules;

use App\Notifications\ContactNotification;

class ContactController extends Controller
{
    function index()
    {
        return view('front.contact.index', [
            'rules' => RodoRules::orderBy('sort')->whereStatus(1)->get(),
            'page' => Page::whereId(4)->first()
        ]);
    }

    function send(ContactFormRequest $request, Recipient $recipient)
    {

        $recipient->notify(new ContactNotification($request));

        Mail::to('biuro@volumetric.pl')->send(new MailSend($request));

        (new RodoClient)->saveOrCreate($request);
        return redirect()->back()->with(
            'success',
            trans('cms.emailsend-thanks')
        );
    }
}
