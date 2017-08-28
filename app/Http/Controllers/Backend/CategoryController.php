<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\CategoryRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\Category;
use App\Log;
use Illuminate\Support\Facades\DB;
class CategoryController extends BackendController
{
    public function getIndex()
    {
        $category = Category::all();
		

        return backend_view( 'category.index', compact('category') );
    }

    public function edit(Category $category)
    {
        /*if ( !$user->isAdmin() )
            abort(404);*/

        return backend_view( 'category.edit', compact('category') );
    } 

    public function add()
    {
            return backend_view( 'category.add' );
    }

    public function create(CategoryRequest $request,Category $category)
    {
        $postData = $request->all();
		$postData['parent_id']	=	0;
		
		#Profile Picture Upload
		if ($request->hasFile('image')) {
            $imageName = \Illuminate\Support\Str::random(12) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.categoryPicPath'));
            $request->file('image')->move($path, $imageName);
			
			$postData['image']= asset('public/' . Config::get('constants.front.dir.categoryPicPath') . ($imageName ?: Config::get('constants.front.default.categoryPic')));
           
        }

        $category->create( $postData );

        session()->flash('alert-success', 'Category has been created successfully!');
        return redirect( 'backend/category/add/' . $category->id );

    }

    public function update(CategoryRequest $request, Category $category)
    {
       

        $postData = $request->all();

        

       // dd($request);
        $category->update( $postData );

        session()->flash('alert-success', 'Category has been updated successfully!');
        return redirect( 'backend/category/edit/' . $category->id );
    }

    public function destroy(Category $category)
    {
        

        $category->delete();

        session()->flash('alert-success', 'Category has been deleted successfully!');
        return redirect( 'backend/category' );
    }

    public function profile($id)
    {
        $users        = User::where(['role_id' => User::ROLE_MEMBER])->where(['id' => $id])->first()->toArray();
        $userLogs     = Log::with(['user'])->where(['log_generator' => $id])->get()->toArray();

//dd($userLogs);
        return backend_view( 'users.profile', compact('users' ,'userLogs') );
    }
	
	public function changeStatus(Request $request,$categoryId)
     {
		
        //$userId = $request->input('userId');
        header('Content-type: application/json');
	   $allNotificationsFromDB = DB::table('categories')->where('id', $categoryId)->get();
		
       $allNotificationsFromDB	=	(array)$allNotificationsFromDB;
	   
	   $currentStatus	=	$allNotificationsFromDB[0]->CategoryStatus;	   
	   if($currentStatus=='inactive')
	   {
	   		DB::table('categories')->where('id', $categoryId)->update(['CategoryStatus' => 'active']);
			echo "0";
			
	   }
	   else
	   {	
	   	DB::table('categories')->where('id', $categoryId)->update(['CategoryStatus' => 'inactive']);	
		echo "1";
		}
	   
		
     }
}
