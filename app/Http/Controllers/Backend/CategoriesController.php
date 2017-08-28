<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\CategoryRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Auth;
//use Validator;

use App\Categories;

class CategoriesController extends BackendController
{
    public function getIndex()
    {
        if(Auth::user()->is_subadmin == 'admin' ) {
          $categories = Categories::with('EntityDetail')->where('entity_type','shopping')->get();
        }else{
            $checkEntity = $this->getEntity();
            //if($checkEntity->account_type ==  'shopping')
            //{
                $categories = Categories::where('parent_id',0)->get();
            //}
        }
        return backend_view( 'categories.index', compact('categories') );
    }

    public function getDinningIndex()
    {
        if(Auth::user()->is_subadmin == 'admin' ) {
            $categories = Categories::where('entity_type','dinning')->get();

        }else{
            $checkEntity = $this->getEntity();
            //if($checkEntity->account_type ==  'shopping')
            //{
                $categories = Categories::where('entity_id',$checkEntity->id)->where('entity_type','dinning')->get();
            //}

        }
        return backend_view( 'categories.dinning_index', compact('categories') );
    }

    public function edit(Categories $category)
    {
        return backend_view('categories.edit', compact('category'));
    }

    public function dinningEdit(Categories $category)
    {
        /*if ( !$user->isAdmin() )
            abort(404);*/
        return backend_view( 'categories.dinning_edit', compact('category') );
    }

    public function add()
    {
        $getEntities = UserEntities::where('account_type','shopping')->get();
        return backend_view('categories.add',compact('getEntities'));
    }

    public function dinningAdd()
    {
        return backend_view( 'categories.dinning_add' );
    }

    public function create(CategoryRequest $request)
    {
        $data = $request->all();

        if(Auth::user()->is_subadmin == 'subadmin'){
            $checkEntity = $this->getEntity();
            $data['entity_id'] = $checkEntity->id;
            $data['entity_type'] = $checkEntity->account_type;
        }else if(Auth::user()->is_subadmin == 'admin')
        {
            $data['entity_id'] = $request->get('entity_id');;
            $data['entity_type'] = 'shopping';
        }else{
            $data['entity_type'] = 'dinning';
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

        Categories::create( $data );

        session()->flash('alert-success', 'Category has been created successfully!');
        if($data['entity_type'] == 'dinning'){
            return redirect( 'backend/dinning/categories/add/');
        }else{
            return redirect( 'backend/categories/add/');
        }


    }

    public function update(CategoryRequest $request, Categories $category)
    {
        $data = $request->all();

        if(Auth::user()->is_subadmin == 'subadmin'){

            $checkEntity = $this->getEntity();
            $data['entity_id'] = $checkEntity->id;
            $data['entity_type'] =$checkEntity->account_type;

        }else if(Auth::user()->is_subadmin == 'admin')
        {
            $data['entity_id'] = $request->get('entity_id');;
            $data['entity_type'] = 'shopping';
        }else{
            $data['entity_type'] = 'dinning';
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


        $category->update( $data );

        session()->flash('alert-success', 'Category has been updated successfully!');
        if($data['entity_type'] == 'dinning'){
            return redirect( 'backend/dinning/categories/edit/' . $category->id );
        }else{
            return redirect( 'backend/categories/edit/' . $category->id );
        }

    }

    public function destroy(Categories $category)
    {
        $category->delete();

        session()->flash('alert-success', 'Category has been deleted successfully!');
        return redirect( 'backend/categories' );
    }

}
