<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPass;
class MailController extends Controller
{
    public static function sendSignupEmail($email, $vkey) {
        $data =[
            'email' => $email,
            'vkey' => $vkey        
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }

    public static function sendForgotPass($email, $vkey) {
        $data =[
            'email' => $email,
            'vkey' => $vkey
        ];

        Mail::to($email)->send(new ForgotPass($data));
    }
}
