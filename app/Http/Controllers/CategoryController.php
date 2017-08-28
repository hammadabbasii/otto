<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Hash;
use Config;
use Gregwar\Image\Image;
use JWTAuth;
use App\Setting;
use App\User;
use App\Category;
use App\Report;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;
use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

class CategoryController extends ApiBaseController {

    public function showData(Request $request) {
        echo "hellos";
    }

    public function getCategories(Request $request) {
        header('Content-type: application/json');
        $allCategoriesFromDB = Category::with('subcategories')->get();
		//$allCategoriesFromDB = DB::table('categories')->with('subcategories')->get();
        //$categories = Category::with('children')->get();
        $jsonArray = array();
        $responseArray = array();
        $allCategories = array();

        foreach ($allCategoriesFromDB as $Category) {
            $thisCategory = array();
			#$Category['image']	=	"http://sflanders.net/wp-content/uploads/2014/12/categories-icon.png";
            $thisCategory = $Category;
			$thisCategoryParentId = $Category['parent_id'];
			if($thisCategoryParentId<=0)
			{
				$allSubCatNames	=	array();
				foreach($thisCategory['subcategories'] as $eachSubCategory)
				{
					$eachSubCategory	  =	$eachSubCategory->toArray();
					$allSubCatNames[]     =	$eachSubCategory['category_name'];
				}
				$subtitleText	=	implode(', ',$allSubCatNames);
				/*$string = substr($subtitleText, 0, 30);
				$string = substr($string, 0, strrpos($string, ' ')) . " ...";*/
				
				$thisCategory['subtitle'] =	$subtitleText;
            	$allCategories[] = $thisCategory;
			}
        }

        $jsonArray['Categories'] = $allCategories;
        /*return RESTAPIHelper::Response($allCategories);

        $response = array("Response" => "Success", "Message" => '', "Result" => $jsonArray);
        echo json_encode($response);*/
		
		return RESTAPIHelper::response($jsonArray, 'Success', 'All Categories');
    }

    public function getCategory(Request $request, $categoryId) {
		$blankObject	=	(object)array();
        if (!isset($categoryId) || trim($categoryId) == '' || trim($categoryId) == 0) {
             return RESTAPIHelper::response($blankObject, 'Error', 'Please Enter Category Id');
        }
		
        $allCategoriesFromDB = Category::where(['id' => $categoryId])->get();
        $jsonArray = array();
        $responseArray = array();
        $allCategories = array();

        foreach ($allCategoriesFromDB as $Category) {
            $thisCategory = array();
            $thisCategory = $Category;

            $allCategories = $thisCategory;
        }

        $jsonArray['Category'] = $allCategories;

        $response = array("Response" => "Success", "Message" => '', "Result" => $jsonArray);
        echo json_encode($response);
        die();
    }

    public function getSubCategories(Request $request, $categoryId) {
		
		$blankObject	=	(object)array();
		
        if (!isset($categoryId) || trim($categoryId) == '' || trim($categoryId) == 0) {
            $response = array("Response" => "Error", "Message" => 'Please Enter Category Id', "Result" => array());
            return RESTAPIHelper::response($blankObject, 'Error', 'Please Enter Category Id');
        }
        //$allSubCategoriesFromDB = Subcategory::where(['id' => $categoryId])->get();

        $allSubCategoriesFromDB = DB::table('categories')->where('parent_id', $categoryId)->get();
        $jsonArray = array();
        $responseArray = array();
        $allCategories = array();

        foreach ($allSubCategoriesFromDB as $Category) {
            $thisCategory = array();
            $thisCategory = $Category;

            $allCategories[] = $thisCategory;
        }

        $jsonArray['SubCategories'] = $allCategories;

        return RESTAPIHelper::response($jsonArray, 'Success', 'All Sub Categories');
    }

}
