<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail()
    {
        //send mail
        $to_name = "Pro";
        $to_email = "dungnv090398@gmail.com";//send to this email

        $data = array("title"=>"tiêu đề","body"=>"Nội dung"); //body of mail.blade.php
       
        Mail::send('home.sendMail',$data,function($message) use ($to_name,$to_email){
            $message->from($to_email,$to_name);//send from this mail
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
        });
        //--send mail
    }
    public static function send_signup_email($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }
}
