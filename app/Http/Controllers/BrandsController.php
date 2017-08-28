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
use App\Brands;
use App\Report;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;
use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

class BrandsController extends ApiBaseController {

    public function showData(Request $request) {
        echo "hellos";
    }

    public function getBrands(Request $request, $categoryId) {
        header('Content-type: application/json');
        $allBrandsFromDB = Brands::where('category_id', $categoryId)->get();

        #print_r($allBrandsFromDB);die();


        $jsonArray = array();
        $allBrands = array();

        foreach ($allBrandsFromDB as $Brand) {

            $allBrands[] = $Brand;
        }

        $jsonArray['Brands'] = $allBrands;

        return RESTAPIHelper::response($jsonArray, 'Success', 'All Brands');
    }

    public function addData() {
        $categoryImagesAray = array("http://cdn-image.foodandwine.com/sites/default/files/original-201301-HD-best-chocolate-frans-chocolates.jpg", "http://chirofirst.ca/wp-content/uploads/2016/01/groceries.jpg", "http://www.auroville.org/system/image_attachments/images/000/008/131/original/Bakery.jpg?1407370708", "https://az616578.vo.msecnd.net/files/2016/01/09/6358790824611247091126848052_Cosmetics_2.jpg", "http://www.ingredientsnetwork.com/47/pdcnewsitem/03/97/11/most-ideal-mexican-drinks-non-alcoholic.jpg", "http://lipstickandbeyond.com/wp-content/uploads/2013/08/cleaningsupplies.jpg", "http://cdn-image.foodandwine.com/sites/default/files/original-201301-HD-best-chocolate-frans-chocolates.jpg", "http://chirofirst.ca/wp-content/uploads/2016/01/groceries.jpg", "http://www.auroville.org/system/image_attachments/images/000/008/131/original/Bakery.jpg?1407370708", "https://az616578.vo.msecnd.net/files/2016/01/09/6358790824611247091126848052_Cosmetics_2.jpg", "http://www.ingredientsnetwork.com/47/pdcnewsitem/03/97/11/most-ideal-mexican-drinks-non-alcoholic.jpg", "http://lipstickandbeyond.com/wp-content/uploads/2013/08/cleaningsupplies.jpg");

        $productsImagesAray = array(
            "http://www.underconsideration.com/brandnew/archives/ruffles_packaging_sourcream.jpg", "http://www.designbolts.com/wp-content/uploads/2013/10/Trillitos-Chips-Packaging.jpg", "http://media.womanista.com/2016/06/doritos-27643-1280x0.jpg", "http://i.static.designgroupitalia.com/blobs/variants/0/4/4/9/044951d3-76ba-47c2-9cc0-1ddb41d95637_xl_p.jpg?_635950252708814396", "http://3.bp.blogspot.com/-nn-8WfJj-OU/UkCPFOZ0q2I/AAAAAAAAAIM/i7J5uvW-WNg/s1600/Lays+Rasa+Rumput+Laut.png", "http://media.womanista.com/2016/06/doritos-27643-1280x0.jpg", "http://www.underconsideration.com/brandnew/archives/ruffles_packaging_sourcream.jpg", "http://www.designbolts.com/wp-content/uploads/2013/10/Trillitos-Chips-Packaging.jpg", "http://media.womanista.com/2016/06/doritos-27643-1280x0.jpg", "http://i.static.designgroupitalia.com/blobs/variants/0/4/4/9/044951d3-76ba-47c2-9cc0-1ddb41d95637_xl_p.jpg?_635950252708814396", "http://3.bp.blogspot.com/-nn-8WfJj-OU/UkCPFOZ0q2I/AAAAAAAAAIM/i7J5uvW-WNg/s1600/Lays+Rasa+Rumput+Laut.png", "http://media.womanista.com/2016/06/doritos-27643-1280x0.jpg", "http://www.underconsideration.com/brandnew/archives/ruffles_packaging_sourcream.jpg", "http://www.designbolts.com/wp-content/uploads/2013/10/Trillitos-Chips-Packaging.jpg", "http://media.womanista.com/2016/06/doritos-27643-1280x0.jpg", "http://i.static.designgroupitalia.com/blobs/variants/0/4/4/9/044951d3-76ba-47c2-9cc0-1ddb41d95637_xl_p.jpg?_635950252708814396", "http://3.bp.blogspot.com/-nn-8WfJj-OU/UkCPFOZ0q2I/AAAAAAAAAIM/i7J5uvW-WNg/s1600/Lays+Rasa+Rumput+Laut.png", "http://media.womanista.com/2016/06/doritos-27643-1280x0.jpg");

        echo count($productsImagesAray);
        die();

        for ($categoryCounter = 1; $categoryCounter <= 10; $categoryCounter++) {
            $categoryArray = array();
            $categoryArray['category_name'] = "Category $categoryCounter";
            $categoryArray['image'] = $categoryImagesAray[$categoryCounter];
            $categoryArray['paent_id'] = 0;

            echo "<br> Category: " . $categoryCounter;
            for ($subCategoryCounter = 1; $subCategoryCounter <= 5; $subCategoryCounter++) {
                echo "<br> Sub-Category: " . $subCategoryCounter;
                for ($brandCounter = 1; $brandCounter <= 5; $brandCounter++) {
                    echo "<br> Brand: " . $brandCounter;
                    for ($productsCounter = 1; $productsCounter <= 10; $productsCounter++) {
                        echo "<br> Product: " . $productsCounter;
                    }
                }
            }
            echo "<br><br>";
        }

        return RESTAPIHelper::response(array(), 'Success', 'All Brands');
    }

}
