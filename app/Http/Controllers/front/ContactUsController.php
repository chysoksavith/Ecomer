<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function contactUs(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                "name" => "required|string|max:100",
                "email" => "required|email|max:150",
                "subject" => "required|max:200",
                "message" => "required"
            ];
            $customMessages = [
                'name.required' => "Name is required",
                'email.required' => "Email is required",
                'email.email' => "Please enter a valid Email",
                'subject.required' => "Subject is required",
                'message.required' => "Message is required"
            ];
            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return response()->json(['success' => false, 'errors' => $errors]);
            }

            // send User query to admin

            $email = "admin1000@gmail.com";
            $messageData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'comment' => $data['message']
            ];

            Mail::send('email.enquiry', $messageData, function ($message) use ($email) {
                $message->to($email)->subject("Enquiry from Seller Website");
            });

            $message = "Thanks for your message, We will get back to you soon.";
            return response()->json(['success' => true, 'message' => $message]);
        }
        return view('client.pages.contact_us');
    }
}
