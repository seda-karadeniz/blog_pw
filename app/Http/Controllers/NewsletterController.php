<?php


namespace App\Http\Controllers;


use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;

class NewsletterController
{
    public function __invoke(Newsletter $newsletter){
    request()->validate(['email'=>'required|email']);

    try {
        //$newsletter = new \App\Services\Newsletter();
        $newsletter->subscribe(request('email'));
    }
    catch (\Exception $e){
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email'=> 'the email could not be added to our list'
        ]);
    }


    return redirect('/')->with('success', 'you are now signed in for our newsletter');

    }

}
