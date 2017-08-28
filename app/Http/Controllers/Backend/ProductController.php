<?php

namespace App\Http\Controllers\Backend;

use Config;
use Illuminate\Http\Request;
// use App\Http\Requests;
use App\Http\Requests\Backend\ProductRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;
use App\Product;
use App\Brand;
use App\Brands;
use App\Category;
use App\Log;
use Illuminate\Support\Facades\DB;

class ProductController extends BackendController {

    public function getIndex() {
        $product = Product::all();


        return backend_view('product.index', compact('product'));
    }

    public function edit(Product $product) {
        /* if ( !$user->isAdmin() )
          abort(404); */
        $category = Category::all();
		$brand    = Brands::all();
		
#		print_r($brand);die();

        return backend_view('product.edit', compact('product','brand','category'));
    }

    public function add() {
        $category = Category::all();
		$brand = Brands::all();
        return backend_view('product.add', compact('brand','category'));
    }

    public function create(ProductRequest $request, Product $product) {
        $postData = $request->all();
        

        if ($file = $request->hasFile('product_image')) {

            $file = $request->file('product_image');


            $fileName = \Illuminate\Support\Str::random(12) . '.' . $request->file('product_image')->getClientOriginalExtension();
            $destinationPath = public_path() . '/images/products/';
            $file->move($destinationPath, $fileName);
             $product->product_image = $fileName;
            #$postData['product_image'] = $fileName;
			$postData['product_image']= asset('public/' . Config::get('constants.front.dir.productPicPath') . ($fileName ?: Config::get('constants.front.default.productPic')));
            //die();
        }


        $product->create($postData);

        session()->flash('alert-success', 'Product has been created successfully!');
        return redirect('backend/product/add/' . $product->id);
    }

    public function update(ProductRequest $request, Product $product) {


        $postData = $request->all();

        if ($file = $request->hasFile('product_image')) {

            $file = $request->file('product_image');


            $fileName = \Illuminate\Support\Str::random(12) . '.' . $request->file('product_image')->getClientOriginalExtension();
             $destinationPath = public_path() . '/images/products/';
            $file->move($destinationPath, $fileName);
             $product->product_image = $fileName;
            $postData['product_image']= asset('public/' . Config::get('constants.front.dir.productPicPath') . ($fileName ?: Config::get('constants.front.default.productPic')));

            //die();
        }

        // dd($request);
        $product->update($postData);

        session()->flash('alert-success', 'Product has been updated successfully!');
        return redirect('backend/product/edit/' . $product->id);
    }

    public function destroy(Product $product) {


        $product->delete();

        session()->flash('alert-success', 'Product has been deleted successfully!');
        return redirect('backend/product');
    }

    public function profile($id) {
        $users = User::where(['role_id' => User::ROLE_MEMBER])->where(['id' => $id])->first()->toArray();
        $userLogs = Log::with(['user'])->where(['log_generator' => $id])->get()->toArray();

//dd($userLogs);
        return backend_view('users.profile', compact('users', 'userLogs'));
    }
	
	public function changeStatus(Request $request,$productId)
     {
		
        //$userId = $request->input('userId');
        header('Content-type: application/json');
	   $allNotificationsFromDB = DB::table('products')->where('id', $productId)->get();
		
       $allNotificationsFromDB	=	(array)$allNotificationsFromDB;
	   
	   $currentStatus	=	$allNotificationsFromDB[0]->status;	   
	   if($currentStatus==0)
	   {
	   		DB::table('products')->where('id', $productId)->update(['status' => 1]);
	   }
	   else
	   {	DB::table('products')->where('id', $productId)->update(['status' => 0]);	}
	   
		echo $currentStatus;
     }

}
