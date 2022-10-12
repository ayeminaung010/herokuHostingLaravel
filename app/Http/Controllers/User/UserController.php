<?php

namespace App\Http\Controllers\User;
use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // home page
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','category','carts','history'));
    }

    //password change page
    public function changePage(){
        return view('user.password.change');
    }

    //user change password
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

    //account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id,Request $request){
        // dd($id,$request->all());
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
        return redirect()->route('user#accountChangePage')->with(['updateSuccess'=>'Profile updated']);
    }

    //filter category user
    public function filter($categoryId){
        $pizzas = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','category','carts','history'));
    }

    //user pizza details
    public function pizzaDetails($pizzaId){
        $pizzas = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizzas','pizzaList'));
    }

    //user history  cart
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.cart.history',compact('order'));
    }

    //user list
    public function userList(){
        $user = User::when( request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                ->orWhere('email','like','%'.request('key').'%')
                ->orWhere('address','like','%'.request('key').'%')
                ->orWhere('gender','like','%'.request('key').'%')
                ->orWhere('phone','like','%'.request('key').'%');
            })
            ->where('role','user')->paginate(5);
        return view('admin.user.list',compact('user'));
    }

    //user delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList');
    }

    //user edit
    public function userEdit($id){
        $user = User::where('id',$id)->first();
        return view('admin.user.edit',compact('user'));
    }

    //user updat profile
    public function userUpdate($id,Request $request){
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
        return redirect()->route('admin#userList')->with(['updateSuccess'=>'Profile updated']);
    }

    //private user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'role'=> $request->role,
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
