<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Reply;
use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //admin password change
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        // dd($request->all());
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

            return back()->with(['changeSuccess' => 'Password Changed Success....']);
        }
        return back()->with(['notMatch' => 'The old Password not Match.Try Again!']);

    }

    //profile details
    public function details(){
        return view('admin.account.details');
    }

    //edit profile
    public function edit(){
        return view('admin.account.edit');
    }
    //update profile
    public function update(Request $request,$id){
        // dd($request->all(),$id);
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            // dd('ayeidffh');
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            // dd($dbImage);

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }{
                $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
                // dd($fileName);
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] =$fileName;
            }

        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Profile updated']);
    }

    //admin list
    public function list(){
        $admin = User::when( request('key'),function($query){
                $query->orWhere('name','like','%'.request('key').'%')
                    ->orWhere('email','like','%'.request('key').'%')
                    ->orWhere('address','like','%'.request('key').'%')
                    ->orWhere('gender','like','%'.request('key').'%')
                    ->orWhere('phone','like','%'.request('key').'%');
                })
                ->where('role','admin')->paginate(3);
        // dd($admin->toArray());
        return view('admin.account.list',compact('admin'));
    }

    //admin list delete
    public function delete($id){
        // dd($id);
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully deleted']);
    }

    //admin change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        // dd($admin->toArray());
        return view('admin.account.changeRole',compact('account'));
    }

    //change
    public function change($id,Request $request){
        // dd($id,$request->all());
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list')->with(['updateSuccess'=>'Successfully changed']);
    }

    //ajax role change
    public function ajaxRoleChange(Request $request){
        // logger($request->all());
        User::where('id',$request->userId)->update([
            'role' => $request->role
        ]);
    }

    //admin  contact message
    public function contactMessagePage(){
        $contactMessage = Contact::orderBy('created_at','desc')->paginate('6');

        return view('admin.contact.contact',compact('contactMessage'));
    }
    //delete contact message
    public function messageDelete($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#contactMessage')->with(['DeleteSuccess'=>'Successfully Deleted']);
    }

    //delete all contact message
    public function deleteAllmessage(){
        $message = Contact::select();
        // dd($message->toArray());
        $message->delete();
        return redirect()->route('admin#contactMessage')->with(['DeleteSuccess'=>'Successfully All Message Deleted']);
    }

    //detail contact message
    public function messageDetail($id){
        $contact = Contact::where('id',$id)->first();
        return view('admin.contact.detail',compact('contact'));
    }

    //reply message
    public function replyMessage(Request $request){
        // dd($request->all());
        $this->replyValidationCheck($request);
        $replyData = $this->replyData($request);
        // dd($replyData);
        $status = User::where('email',$request->userEmail)->get();
        // dd($status->toArray());

        Reply::create($replyData);

        return redirect()->route('admin#contactMessageDetail',$request->userId)->with(['sendSuccess'=>'Successfully sent..']);
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



    //private request role
    private function requestUserData($request){
        return [
            'role' => $request->role,
            'created_at' => Carbon::now(),
        ];

    }
    //private user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ];
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required',
            'gender'=> 'required',
            'phone'=> 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address'=> 'required',
        ])->validate();
    }

    //private password Validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword'=> 'required|min:6',
            'confirmPassword'=> 'required|min:6|same:newPassword',
        ])->validate();
    }
}
