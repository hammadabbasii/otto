<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\BrandRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\Brand;
use App\Subcategory;
use App\Log;
use Illuminate\Support\Facades\DB;
class BrandController extends BackendController
{
    public function getIndex()
    {
        $brand = Brand::all();
		$category = Subcategory::where('parent_id','>',0)->get();

        return backend_view( 'brand.index', compact('brand'), compact('category') );
    }

    public function edit(Brand $brand)
    {
        /*if ( !$user->isAdmin() )
            abort(404);*/
		$category = Subcategory::where('parent_id','>',0)->get();
        return backend_view( 'brand.edit', compact('brand'), compact('category') );
    } 

    public function add()
    {
		$category = Subcategory::where('parent_id','>',0)->get();
        return backend_view( 'brand.add', compact('category') );
    }

    public function create(BrandRequest $request,Brand $brand)
    {
        $postData = $request->all();
		
		
		#Profile Picture Upload
		if ($request->hasFile('image')) {
            $imageName = \Illuminate\Support\Str::random(12) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.brandPicPath'));
            $request->file('image')->move($path, $imageName);
			
			$postData['image']= asset('public/' . Config::get('constants.front.dir.brandPicPath') . ($imageName ?: Config::get('constants.front.default.brandPic')));
           
        }
		#print_r($postData['image']);die();
        $brand->create( $postData );

        session()->flash('alert-success', 'Brand has been created successfully!');
        return redirect( 'backend/brand/add/' . $brand->id );

    }

    public function update(BrandRequest $request, Brand $brand)
    {
       

        $postData = $request->all();
		
		#Profile Picture Upload
		if ($request->hasFile('image')) {
            $imageName = \Illuminate\Support\Str::random(12) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.brandPicPath'));
            $request->file('image')->move($path, $imageName);
			
			$postData['image']= asset('public/' . Config::get('constants.front.dir.brandPicPath') . ($imageName ?: Config::get('constants.front.default.brandPic')));
           
        }

        

       // dd($request);
        $brand->update( $postData );

        session()->flash('alert-success', 'Brand has been updated successfully!');
        return redirect( 'backend/brand/edit/' . $brand->id );
    }

    public function destroy(Brand $brand)
    {
        

        $brand->delete();

        session()->flash('alert-success', 'Brand has been deleted successfully!');
        return redirect( 'backend/brand' );
    }

    public function profile($id)
    {
        $users        = User::where(['role_id' => User::ROLE_MEMBER])->where(['id' => $id])->first()->toArray();
        $userLogs     = Log::with(['user'])->where(['log_generator' => $id])->get()->toArray();

//dd($userLogs);
        return backend_view( 'users.profile', compact('users' ,'userLogs') );
    }
	
	public function changeStatus(Request $request,$brandId)
     {
		
        //$userId = $request->input('userId');
        header('Content-type: application/json');
	   $allNotificationsFromDB = DB::table('categories')->where('id', $brandId)->get();
		
       $allNotificationsFromDB	=	(array)$allNotificationsFromDB;
	   
	   $currentStatus	=	$allNotificationsFromDB[0]->BrandStatus;	   
	   if($currentStatus=='inactive')
	   {
	   		DB::table('categories')->where('id', $brandId)->update(['BrandStatus' => 'active']);
			echo "0";
			
	   }
	   else
	   {	
	   	DB::table('categories')->where('id', $brandId)->update(['BrandStatus' => 'inactive']);	
		echo "1";
		}
	   
		
     }
}
