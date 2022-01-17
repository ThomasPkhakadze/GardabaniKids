<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function send(Request $request){
        
        $data = $this->validate($request,[
             'name' => 'required|string',
             'email' => 'required|email',
             'phone' => 'required',
             'text' => 'required|string'
 
         ]);
 
         Mail::to('tom@tom.com')->send(new ContactForm($data));
 
         
        return Redirect::to(url('success'));
     }
}
