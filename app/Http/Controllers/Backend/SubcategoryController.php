<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\SubcategoryRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\Subcategory;
use App\Log;

class SubcategoryController extends BackendController
{
    public function getIndex()
    {
        $category = Subcategory::all();
			
		return backend_view( 'subcategory.index', compact('category') );
    }

    public function edit(Subcategory $subcategory)
    {
        /*if ( !$user->isAdmin() )
            abort(404);*/
		#$category = Subcategory::all();
		$category = Subcategory::where('parent_id',0)->get();

        return backend_view( 'subcategory.edit', compact('subcategory'), compact('category') );
    } 

    public function add()
    {
			#$category = Subcategory::all();
			$category = Subcategory::where('parent_id',0)->get();
            return backend_view( 'subcategory.add', compact('category') );
    }

    public function create(SubcategoryRequest $request,Subcategory $subcategory)
    {
        $postData = $request->all();

		#print_r($postData);die();
        $subcategory->create( $postData );

        session()->flash('alert-success', 'Subcategory has been created successfully!');
        return redirect( 'backend/subcategory/add/' . $subcategory->id );

    }

    public function update(SubcategoryRequest $request, Subcategory $subcategory)
    {
       

        $postData = $request->all();

        

       // dd($request);
        $subcategory->update( $postData );

        session()->flash('alert-success', 'Subcategory has been updated successfully!');
        return redirect( 'backend/subcategory/edit/' . $subcategory->id );
    }

    public function destroy(Subcategory $subcategory)
    {
        

        $subcategory->delete();

        session()->flash('alert-success', 'Subcategory has been deleted successfully!');
        return redirect( 'backend/subcategory' );
    }

   
}
