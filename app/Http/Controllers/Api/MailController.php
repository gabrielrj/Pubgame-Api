<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailServicePlayerRegisterConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function test(){
        Mail::send(new MailServicePlayerRegisterConfirmation());
    }
}
