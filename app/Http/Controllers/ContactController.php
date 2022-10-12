<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reply;
use App\Models\Contact;
use App\Models\UserReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //contact page
    public function contactPage(){
        return view('user.contact.contact');
    }

    //contact message
    public function contact(Request $request){
        // dd($request->all());
        $this->messageValidationCheck($request);
        $data = $this->getUserData($request);
        Contact::create($data);
        return back()->with(['SendSuccess' => 'Your message sent success....']);
    }

    
    //message reply
    public function messageReply(Request $request){
        $this->replyValidationCheck($request);
        $replyData = $this->replyData($request);

        UserReply::create($replyData);
        return redirect()->route('user#messagePage');
    }

    // reply data
    private function replyData($request){
        return [
            'message' => $request->message,
            'email' => $request->userEmail,
            'created_at' => Carbon::now(),
        ];
    }
    // reply validaitoncheck
    private function replyValidationCheck($request){
        Validator::make($request->all(),[
            'message' => 'required',
        ])->validate();
    }

    //private user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ];
    }

    //account validation check
    private function messageValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required',
            'subject'=> 'required',
            'message'=> 'required',
        ])->validate();
    }
}
