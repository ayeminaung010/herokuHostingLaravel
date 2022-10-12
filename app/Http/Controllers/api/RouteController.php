<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //productLists
    public function productLists(){
        $data = Product::get();
        return response()->json($data, 200);
    }
    //categoryLists
    public function categoryLists(){
        $data = Category::get();
        return response()->json($data, 200);
    }
    //contactLists
    public function contactLists(){
        $data = Contact::get();
        return response()->json($data, 200);
    }
    //orderApi
    public function orderApi(){
        $data = Order::get();
        return response()->json($data, 200);
    }
    //orderLists
    public function orderLists(){
        $data = OrderList::get();
        return response()->json($data, 200);
    }
    //userLists
    public function userLists(){
        $data = User::get();
        return response()->json($data, 200);
    }

    //productUserLists
    public function productUserLists(){
        $user = User::get();
        $product = Product::get();

        $data = [
            'user' => $user,
            'product' => $product
        ];
        return response()->json($data, 200);
    }

    //categoryCreate
    public function categoryCreate(Request $request){
        $responseData = $this->getCreateData($request);
        Category::create($responseData);
        $data = Category::orderBy('created_at','desc')->get();
        return response()->json($data, 200);
    }

    // createCategoryData
    private function getCreateData($request){
        return [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' =>Carbon::now()
        ];
    }

     //contactCreate
     public function contactCreate(Request $request){
        $responseData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' =>Carbon::now()
        ];

        Contact::create($responseData);
        $data = Contact::orderBy('created_at','desc')->get();
        return response()->json($data, 200);
    }

    //delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            Category::where('id',$request->id)->delete();
            return response()->json(['status'=> true , 'message' => ' successfully deleted'], 200);
        }
        return response()->json(['status'=> false , 'message' => 'your id not found'], 500);
    }

    //detail category
    public function detailCategory($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['status' => true,'category' => $data], 200);
        }
        return response()->json(['status'=> false , 'message' => 'your id not found'], 500);
    }

    //update category
    public function updateCategory(Request $request){
        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            $updateData = $this->getCategoryData($request);
             $data->update($updateData);
             $finalData = Category::where('id',$request->id)->first();
            return response()->json(['status' => true,'category' => $finalData], 200);
        }
        return response()->json(['status'=> false , 'message' => 'your id not found'], 500);
    }

    //get category Data
    private function getCategoryData($request){
        return [
            'name' => $request->name,
            'updated_at'=> Carbon::now(),
        ];
    }
}
