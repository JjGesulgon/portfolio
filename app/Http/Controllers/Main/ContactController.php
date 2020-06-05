<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * send message to email address.
     *
     * @return
    */
    public function sendEmail(Request $request)
    {   
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'body'          => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message'  => 'Validation failed.',
                'errors'   => $validator->errors()
            ], 400);
        }
       
        // return Mail::to('jjgesulgon@gmail.com')->send(new ContactUs($request));
        // return Mail::to($request->receiver)->send(new ContactUs($request));
        return Mail::to('jjgesulgon@gmail.com')->send(new ContactMail($request));
    }
}
