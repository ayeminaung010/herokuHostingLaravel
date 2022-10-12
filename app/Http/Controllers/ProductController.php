<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //product list
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
                    ->when('key',function($query){
                    $query->where('products.name','like','%'.request('key').'%');
                    })
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('products.created_at','desc')->paginate(4);
        // dd($pizzas->toArray());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //product createPage
    public function createPage(){
        $categories = Category::select('id','name')->get();

        return view('admin.product.create',compact('categories'));
    }

    //product create
    public function create(Request $request){
        // dd($request->all());
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);
        // dd($data);

        $fileName = uniqid().'_'.$request->file('pizzaImage')->getClientOriginalName();
        // dd($fileName);
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] =$fileName;

        Product::create($data);
        return redirect()->route('products#list')->with(['createSuccess'=>'Pizza successfully created!']);
    }

     //update product
    public function update(Request $request){
        // dd($request->all());
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductInfo($request);
        // dd($data);
        if($request->hasFile('pizzaImage')){
            $dbImage = Product::where('id',$request->pizzaId)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }{
                $fileName = uniqid() . '_' . $request->file('pizzaImage')->getClientOriginalName();
                // dd($fileName);
                $request->file('pizzaImage')->storeAs('public',$fileName);
                $data['image'] =$fileName;
            }

        }
        // dd($data);
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('products#list')->with(['updateSuccess'=>'Profile updated']);
    }

    //product delete
    public function delete($id){
        // dd($id);
        Product::where('id',$id)->delete();
        return redirect()->route('products#list')->with(['deleteSuccess'=>'Pizza successfully deleted!']);
    }

    //edit product
    public function edit($id){
        $pizzas =Product::select('products.*','categories.name as category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->where('products.id',$id)->first();
        // dd($pizzas->toArray());
        return view('admin.product.edit',compact('pizzas'));
    }

    //updatePage product
    public function updatePage($id){
        $categories = Category::get();
        $pizzas =Product::where('id',$id)->first();
        // dd($categories->toArray(),$pizzas->toArray());
        return view('admin.product.update',compact('pizzas','categories'));
    }



    //product validation
    private function productValidationCheck($request,$action){
        $validationRules =[
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime'  => 'required',
        ];
        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';
        // dd($validationRules);
        Validator::make($request->all(),$validationRules)->validate();

    }

    //product data
    private function requestProductInfo($request){
        return [
            'name' => $request->pizzaName,
            'category_id' => $request->pizzaCategory,
            'description' => $request->pizzaDescription,
            // 'image' => $request->pizzaImage,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }
}
