<?php

namespace App\Http\Controllers\Backend;

use Config;
use Hash;
use Gregwar\Image\Image;
use JWTAuth;
use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\UserRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;
use App\Setting;
use App\Slider;
use App\Advertisementimage;

use Illuminate\Support\Facades\DB;

class SliderController extends BackendController
{
    public function getIndex()
    {
        $slider = Slider::all();
//        dd($slider);
        return backend_view( 'slider.index', compact('slider') );
    }

    public function edit($page_id)
    {
        $slider = Slider::find($page_id);
        return backend_view( 'slider.edit', compact('slider') );
    }

    public function add()
    {
        return backend_view( 'slider.add' );
    }

    public function create(Request $request)
    {
        $postData = $request->all();

        if ($request->hasFile('slider_images')) {

            $imageName =  \Illuminate\Support\Str::random(12) . '.' . $request->file('slider_images')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.sliderPicPath'));
            $request->file('slider_images')->move($path, $imageName);

            //if (Image::open($path . '/' . $imageName)->scaleResize(200, 200)->save($path . '/' . $imageName)) {
            $postData['slider_images'] = $imageName;
            // }
        }
        else
        {
            $imageName="default.png";
            $postData['slider_images'] = $imageName;
            $request->slider_images = $imageName;
        }
        Slider::create( $postData );

        session()->flash('alert-success', 'Slider image has been created successfully!');
        return redirect( 'backend/slider/');

    }

    public function update(Request $request ,$page_id )
    {

        $slider = Slider::find($page_id);
        $postData = $request->all();
        if ($request->hasFile('slider_images')) {

            $imageName =  \Illuminate\Support\Str::random(12) . '.' . $request->file('slider_images')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.sliderPicPath'));
            $request->file('slider_images')->move($path, $imageName);

            //if (Image::open($path . '/' . $imageName)->scaleResize(200, 200)->save($path . '/' . $imageName)) {
            $postData['slider_images'] = $imageName;
            // }
        }
        else
        {
            $imageName="default.png";
            $postData['slider_images'] = $imageName;
            $request->slider_images = $imageName;
        }

        $slider->update( $postData );

        session()->flash('alert-success', 'Slider Image has been updated successfully!');
        return redirect( 'backend/slider/');
    }

    public function destroy($page_id)
    {
        Slider::destroy($page_id);
        session()->flash('alert-success', 'Slider Image has been deleted successfully!');
        return redirect( 'backend/slider' );
    }

    public function getadvertisement()
    {
        $advertisement = Advertisementimage::all();
//        dd($advertisement);
        return backend_view( 'advertisement.index', compact('advertisement') );
    }

    public function advedit($page_id)
    {
        $advertisement = Advertisementimage::find($page_id);
        return backend_view( 'advertisement.edit', compact('advertisement') );
    }
    public function advupdate(Request $request ,$page_id )
    {

        $advertisement = Advertisementimage::find($page_id);
        $postData = $request->all();
        if ($request->hasFile('image1')) {

            $imageName =  \Illuminate\Support\Str::random(12) . '.' . $request->file('image1')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.advPicPath'));
            $request->file('image1')->move($path, $imageName);

            //if (Image::open($path . '/' . $imageName)->scaleResize(200, 200)->save($path . '/' . $imageName)) {
            $postData['image1'] = $imageName;
            // }
        }
        else
        {
            $imageName="default.png";
            $postData['image1'] = $imageName;
            $request->image1 = $imageName;
        }
        if ($request->hasFile('image2')) {

            $imageName =  \Illuminate\Support\Str::random(12) . '.' . $request->file('image2')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.advPicPath'));
            $request->file('image2')->move($path, $imageName);

            //if (Image::open($path . '/' . $imageName)->scaleResize(200, 200)->save($path . '/' . $imageName)) {
            $postData['image2'] = $imageName;
            // }
        }
        else
        {
            $imageName="default.png";
            $postData['image2'] = $imageName;
            $request->image2 = $imageName;
        }

        $advertisement->update( $postData );

        session()->flash('alert-success', 'Advertisement Images has been updated successfully!');
        return redirect( 'backend/advertisement/');
    }

}
