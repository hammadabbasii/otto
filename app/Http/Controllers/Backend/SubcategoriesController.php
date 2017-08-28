<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;


use App\Http\Requests\Backend\SubcategoryRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Illuminate\Support\Facades\Auth;
//use Validator;

use App\Categories;
use App\UserEntities;


class SubcategoriesController extends BackendController
{
    public function getIndex()
    {
        if(Auth::user()->is_subadmin == 'admin' ) {
            $categories = Categories::where('parent_id', 0)->get();
            $subcategories = Categories::with('EntityDetail')->where('parent_id', '<>', 0)->get();
        }else {
            $checkEntity = $this->getEntity();
            $categories = Categories::where('entity_id', $checkEntity->id)->where('parent_id', 0)->get();
            $subcategories = Categories::where('entity_id', $checkEntity->id)->where('parent_id', '<>', 0)->get();
        }
		return backend_view( 'subcategories.index', compact('subcategories'),compact('categories') );
    }

    public function edit(Categories $subcategory)
    {
        if(Auth::user()->is_subadmin == 'admin' ) {
            $getEntities = UserEntities::where('account_type','shopping')->get();
            $category = Categories::where('entity_type','shopping')->where('parent_id',0)->get();
        }else{
            $checkEntity = $this->getEntity();
            $category = Categories::where('entity_id',$checkEntity->id)->where('parent_id',0)->get();
        }

        return backend_view( 'subcategories.edit', compact('subcategory'), compact('category','getEntities'));
    } 

    public function add()
    {
        if(Auth::user()->is_subadmin == 'admin' ) {
            $getEntities = UserEntities::where('account_type','shopping')->get();
            $category = Categories::where('entity_type','shopping')->where('parent_id',0)->get();
        }else{
            $checkEntity = $this->getEntity();
            $category = Categories::where('entity_id',$checkEntity->id)->where('parent_id',0)->get();
        }

        return backend_view( 'subcategories.add', compact('category','getEntities') );
    }

    public function create(SubcategoryRequest $request,Categories $subcategory)
    {
        $data = $request->all();

        if(Auth::user()->is_subadmin != 'admin'){
            $checkEntity = $this->getEntity();
            $data['entity_id'] = $checkEntity->id;
            $data['entity_type'] =$checkEntity->account_type;
        }else{
            $data['entity_type'] = 'shopping';
        }

        if(isset($_FILES['image']['name'])){

            if(!empty($_FILES['image']['name'])) {
                $file 			= $request->file('image');
                $ext		 	=	substr(strrchr($_FILES['image']['name'],'.'),1);
                $file_name	 	=	uniqid().'.'.$ext;
                $fileName 		= \Illuminate\Support\Str::random(12) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/images/categories/';
                $file->move($destinationPath, $fileName);

                $data['image']	= $fileName;
            }
        }

        $subcategory->create( $data );

        session()->flash('alert-success', 'Subcategory has been created successfully!');
        return redirect( 'backend/subcategories/add/' . $subcategory->id );

    }

    public function update(SubcategoryRequest $request, Categories $subcategory)
    {
        $data = $request->all();

        if(Auth::user()->is_subadmin != 'admin'){
            $checkEntity = $this->getEntity();
            $data['entity_id'] = $checkEntity->id;
            $data['entity_type'] =$checkEntity->account_type;
        }else{
            $data['entity_type'] = 'shopping';
        }

        if(isset($_FILES['image']['name'])){

            if(!empty($_FILES['image']['name'])) {
                $file 			= $request->file('image');
                $ext		 	=	substr(strrchr($_FILES['image']['name'],'.'),1);
                $file_name	 	=	uniqid().'.'.$ext;
                $fileName 		= \Illuminate\Support\Str::random(12) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/images/categories/';
                $file->move($destinationPath, $fileName);

                $data['image']	= $fileName;
            }
        }

        // dd($request);
        $subcategory->update( $data );

        session()->flash('alert-success', 'Subcategory has been updated successfully!');
        return redirect( 'backend/subcategories/edit/' . $subcategory->id );
    }

    public function destroy(Categories $subcategory)
    {
        $subcategory->delete();

        session()->flash('alert-success', 'Subcategory has been deleted successfully!');
        return redirect( 'backend/subcategories' );
    }

   
}
