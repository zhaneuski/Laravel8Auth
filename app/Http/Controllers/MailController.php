<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
        public function sendemail() {
            $details = [
                'title' => 'Test email',
                'body' => 'This is a test email from my google account'
            ];

            Mail::to('kuttestmail@gmail.com')->send(new TestMail($details));

            return "Email sent";
        }
}
