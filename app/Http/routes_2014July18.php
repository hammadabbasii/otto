<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return redirect( 'index' );
});
Route::get('/home', function () {
    dd(Auth::user());
});

/* Route::group(['middleware' => ['api'], 'prefix' => 'api'], function () {

  Route::post('register', 'ApiController@register');
  Route::post('login', 'ApiController@login');
  Route::post('reset-password', 'ApiController@resetPassword');
  Route::get('init', 'ApiController@init');
  Route::post('vr', 'ApiController@valuationReport');
  Route::post('in_app', 'ApiController@inAppPurchased');

  Route::group(['middleware' => 'jwt-auth'], function () {
  Route::post('logout', 'ApiController@logout');
  Route::post('get-guide-book', 'ApiController@getGuideBook');

  Route::group(['prefix' => 'profile'], function() {
  Route::post('me', 'ApiController@viewMyProfile');
  Route::post('update', 'ApiController@updateMyProfile');
  });
  });
  }); */


Route::group(['middleware' => ['api'], 'prefix' => 'api'], function () {
	Route::post('order/changeOrderStatus', 'UserorderController@changeOrderStatus');
Route::match(['GET', 'POST'], '/cms', 'CmsController@getCmsPage');	
Route::post('addData', 'BrandsController@addData');
Route::post('feedback/post', 'UsernotificationController@postFeedback');
Route::post('ContactDetails', 'UsernotificationController@ContactDetails');
Route::post('notifications/get', 'UsernotificationController@getUserNotifications');
Route::post('notifications/clear', 'UsernotificationController@clearUserNotifications');
Route::post('notifications/unclear', 'UsernotificationController@unclearUserNotifications');
Route::post('address/add', 'UserController@addAddress');
Route::post('address/edit', 'UserController@editAddress');
Route::post('address/delete', 'UserController@deleteAddress');

Route::post('address', 'UserController@getAddresses');
Route::post('address/selected', 'UserController@getSelectedAddresses');
Route::post('address/select', 'UserController@selectAddress');

Route::get('countries', 'CountryController@getCountries');
Route::get('sendPush', 'UserorderController@sendPush');
Route::get('cities/{countryID}', 'CountryController@getCities');

Route::post('Products/Brand', 'ProductController@getProductByBrand');
Route::post('Products/Liked', 'ProductController@getFavoriteProduct');
Route::post('Products/Search', 'ProductController@searchProducts');
Route::get('Brands/{categoryId}', 'BrandsController@getBrands');

Route::post('forgotpassword', 'ApiController@forgotPassword');

//Mark Notis read
    Route::post('Notification/send', 'NotificationController@sendNotifications');
    #Get All interests	

	//Enlist all products
	Route::get('Products', 'ProductController@getAllProducts');

	//Enlist single products
	Route::get('Products/{productId}', 'ProductController@getProduct');
	
	Route::get('stats/user', 'StatisticsController@getRegisterationStats');
		
	Route::post('user/update', 'UserController@updateUser');
	Route::post('user/updatepassword', 'UserController@updatePassword');
    Route::post('userregister', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('sociallogin', 'ApiController@socialLogin');
    Route::post('reset-password', 'ApiController@resetPassword');
    Route::get('init', 'ApiController@init');
    Route::post('vr', 'ApiController@valuationReport');
    Route::post('in_app', 'ApiController@inAppPurchased');
    Route::get('users', 'ApiController@getUsers');
	
	
	#Fav unfav 
	Route::post('Product/favorite', 'ProductController@markFavorite');
    Route::post('product/wishlist', 'ProductController@markFavoriteWeb');
	Route::post('Product/unmarkfavorite', 'ProductController@unmarkFavorite');
	Route::get('getUserFavorittedIds', 'ProductController@getUserFavorittedIds');


		#Add Item To cart
        Route::post('addToCart', 'UsercartController@addToCart');
		Route::post('addToCartArray', 'UsercartController@addToCartArray');
		
		//Get User Cart Items!
        Route::post('getUserCart', 'UsercartController@getUserCart');
		
		//Clear All my Cart Items!
        Route::post('clearMyCart', 'UsercartController@clearMyCart');
		
		//Place New Order!
        Route::post('addOrder', 'UserorderController@addOrder'); 
		
		//Update Device Toke!
        Route::post('updateToken', 'UserorderController@updateToken'); 
		
		//Add New Promotion!
        Route::post('addPromotion', 'PromotionController@addPromotion'); 
		
		//Get All pending orders!
        Route::post('pendingorders', 'UserorderController@getUserPendingOrders'); 
		Route::post('completeorders', 'UserorderController@getUserCompletedOrders'); 
		
		
Route::get('Category', 'CategoryController@getCategories'); Route::get('user/{user_id}', 'ApiController@getProfile');

    Route::group(['middleware' => 'jwt-auth', 'jwt-refresh'], function () {
        Route::post('user/follow', 'ApiController@follow');
       
        Route::post('user/unfollow', 'ApiController@unfollow');
        Route::get('followers/{user_id}', 'ApiController@getfollowers');
        Route::get('followings/{user_id}', 'ApiController@getfollowings');

		
		
		
        


        //Category Working
        
        Route::get('Category/{categoryId}', 'CategoryController@getCategory');
        Route::get('SubCategories/Category/{categoryId}', 'CategoryController@getSubCategories');


       

        


        


        //Enlist all products of specific category
        Route::get('Products/Category/{categoryId}', 'ProductController@getProductByCategory');
		
		

        Route::group(['prefix' => 'profile'], function() {
            Route::post('me', 'ApiController@viewMyProfile');
            Route::post('update', 'ApiController@updateMyProfile');
        });
    });
});


Route::group(['middleware' => 'web', 'prefix' => 'backend', 'namespace' => 'Backend'], function () {

    Route::match(['GET', 'POST'], 'login', 'Auth\AuthController@adminLogin');
    Route::match(['GET', 'POST'], 'reset-password/{token?}', 'Auth\PasswordController@resetPasswordAction');
    Route::post('reset-password-finally', 'Auth\PasswordController@reset');

    Route::group(['middleware' => ['admin']], function () {

       #Brand 
		Route::get('brand/changeStatus/{brandId}', 'BrandController@changeStatus');
		Route::get('brand', 'BrandController@getIndex');
		Route::get('brand/add', 'BrandController@add');
		Route::post('brand/create', 'BrandController@create');
		Route::get('brand/edit/{brand}', 'BrandController@edit');
		Route::put('brand/{brand}', 'BrandController@update');
		Route::delete('brand/{brand}', 'BrandController@destroy');
       
	   Route::get('categories', 'CategoriesController@getIndex');
        Route::get('categories/add', 'CategoriesController@add');
        Route::post('categories/create', 'CategoriesController@create');
        Route::get('categories/edit/{category}', 'CategoriesController@edit');
        Route::put('categories/{category}', 'CategoriesController@update');
        Route::delete('categories/{category}', 'CategoriesController@destroy');

        ### Sub Categories ###
        Route::get('subcategories', 'SubcategoriesController@getIndex');
        Route::get('subcategories/add', 'SubcategoriesController@add');
        Route::post('subcategories/create', 'SubcategoriesController@create');
        Route::get('subcategories/edit/{subcategory}', 'SubcategoriesController@edit');
        Route::put('subcategories/{subcategory}', 'SubcategoriesController@update');
        Route::delete('subcategories/{subcategory}', 'SubcategoriesController@destroy');
        //Route::get('subcategories/{id}', 'SubcategoriesController@getSubCategories');


        Route::get('user/changeStatus/{userId}', 'UserController@changeStatus');
        Route::get('product/changeStatus/{productId}', 'ProductController@changeStatus');
        Route::get('category/changeStatus/{categoryId}', 'CategoryController@changeStatus');
        Route::get('interest/changeStatus/{interestId}', 'InterestController@changeStatus');
        Route::get('itinerary/changeStatus/{itineraryId}', 'ItineraryController@changeStatus');

        #Hammad Abbasi start
        Route::get('product', 'ProductController@getIndex');
        Route::delete('product/{product}', 'ProductController@destroy');
        Route::get('product/edit/{product}', 'ProductController@edit');
        Route::put('product/{product}', 'ProductController@update');
        Route::get('product/add', 'ProductController@add');
        Route::post('product/create', 'ProductController@create');
        #Hammad Abbasi end



        Route::get('category', 'CategoryController@getIndex');
        Route::get('category/add', 'CategoryController@add');
        Route::post('category/create', 'CategoryController@create');
        Route::get('category/edit/{category}', 'CategoryController@edit');
        Route::put('category/{category}', 'CategoryController@update');
        Route::delete('category/{category}', 'CategoryController@destroy');


        Route::get('subcategory', 'SubcategoryController@getIndex');
        Route::get('subcategory/add', 'SubcategoryController@add');
        Route::post('subcategory/create', 'SubcategoryController@create');
        Route::get('subcategory/edit/{subcategory}', 'SubcategoryController@edit');
        Route::put('subcategory/{subcategory}', 'SubcategoryController@update');
        Route::delete('subcategory/{subcategory}', 'SubcategoryController@destroy');



        Route::get('admin', 'AdminController@getIndex');
        Route::delete('admin/{admin}', 'AdminController@destroy');
        Route::get('admin/edit/{admin}', 'AdminController@edit');
        Route::put('admin/{admin}', 'AdminController@update');
        Route::get('admin/add', 'AdminController@add');
        Route::post('admin/create', 'AdminController@create');
        Route::delete('admin/{admin}', 'AdminController@destroy');



        Route::get('product', 'ProductController@getIndex');

        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('dashboard', 'DashboardController@getIndex');
        Route::get('setting/profile', 'SettingController@getProfileSetting');
        Route::post('setting/profile', 'SettingController@postProfileSetting');
        Route::match(['GET', 'POST'], 'setting/setting', 'SettingController@processSetting');

        Route::get('user', 'UserController@getIndex');
        Route::delete('user/{user}', 'UserController@destroy');
        Route::get('user/edit/{user}', 'UserController@edit');
        Route::put('user/{user}', 'UserController@update');
        Route::get('user/add', 'UserController@add');
        Route::post('user/create', 'UserController@create');
        Route::get('user/profile/{id}', 'UserController@profile');

        // CMS PAges Controller ......
        Route::get('cms', 'CmsController@getIndex');
        Route::delete('cms/{page_id}', 'CmsController@destroy');
        Route::get('cms/edit/{page_id}', 'CmsController@edit');
        Route::put('cms/{page_id}', 'CmsController@update');
        Route::get('cms/add', 'CmsController@add');
        Route::post('cms/create', 'CmsController@create');

        // Slider Pages Controller ......
        Route::get('slider', 'SliderController@getIndex');
        Route::delete('slider/{page_id}', 'SliderController@destroy');
        Route::get('slider/edit/{page_id}', 'SliderController@edit');
        Route::put('slider/{page_id}', 'SliderController@update');
        Route::get('slider/add', 'SliderController@add');
        Route::post('slider/create', 'SliderController@create');

        // Advertisement Pages Controller ......
        Route::get('advertisement', 'SliderController@getadvertisement');
//        Route::delete('advertisement/{page_id}', 'SliderController@destroy');
        Route::get('advertisement/edit/{page_id}', 'SliderController@advedit');
        Route::put('advertisement/{page_id}', 'SliderController@advupdate');
//        Route::get('advertisement/add', 'SliderController@advadd');
//        Route::post('advertisement/create', 'SliderController@advcreate');
		
		#Feedbacks Admin 
		Route::get('feedback', 'FeedbackController@getIndex');
        Route::delete('feedback/{feedback}', 'FeedbackController@destroy');
        
		
		
		#Orders Section 
		Route::get('orders', 'UserorderController@getIndex');
		Route::get('userorder/details/{id}', 'UserorderController@orderDetails');
		Route::delete('userorder/{userorder}', 'UserorderController@destroy');

        // Push Notification PAges Controller ......

        Route::get('push/send', 'PushNotificationController@add');


        //Route::match(['GET', 'POST'], 'user/add', 'UserController@add');

        Route::get('report/{index?}', 'ReportController@getIndex');
        Route::delete('report/{report}', 'ReportController@destroy');

		/*
        Route::get('user/changeStatus/{userId}', 'UserController@changeStatus');
        Route::get('product/changeStatus/{productId}', 'ProductController@changeStatus');
        Route::get('category/changeStatus/{categoryId}', 'CategoryController@changeStatus');
        Route::get('interest/changeStatus/{interestId}', 'InterestController@changeStatus');
        Route::get('itinerary/changeStatus/{itineraryId}', 'ItineraryController@changeStatus');

        #Hammad Abbasi start
        Route::get('product', 'ProductController@getIndex');
        Route::delete('product/{product}', 'ProductController@destroy');
        Route::get('product/edit/{product}', 'ProductController@edit');
        Route::put('product/{product}', 'ProductController@update');
        Route::get('product/add', 'ProductController@add');
        Route::post('product/create', 'ProductController@create');
        #Hammad Abbasi end



        Route::get('category', 'CategoryController@getIndex');
        Route::get('category/add', 'CategoryController@add');
        Route::post('category/create', 'CategoryController@create');
        Route::get('category/edit/{category}', 'CategoryController@edit');
        Route::put('category/{category}', 'CategoryController@update');
        Route::delete('category/{category}', 'CategoryController@destroy');


        Route::get('subcategory', 'SubcategoryController@getIndex');
        Route::get('subcategory/add', 'SubcategoryController@add');
        Route::post('subcategory/create', 'SubcategoryController@create');
        Route::get('subcategory/edit/{subcategory}', 'SubcategoryController@edit');
        Route::put('subcategory/{subcategory}', 'SubcategoryController@update');
        Route::delete('subcategory/{subcategory}', 'SubcategoryController@destroy');



        Route::get('admin', 'AdminController@getIndex');
        Route::delete('admin/{admin}', 'AdminController@destroy');
        Route::get('admin/edit/{admin}', 'AdminController@edit');
        Route::put('admin/{admin}', 'AdminController@update');
        Route::get('admin/add', 'AdminController@add');
        Route::post('admin/create', 'AdminController@create');
        Route::delete('admin/{admin}', 'AdminController@destroy');



        Route::get('product', 'ProductController@getIndex');

        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('dashboard', 'DashboardController@getIndex');
        Route::get('setting/profile', 'SettingController@getProfileSetting');
        Route::post('setting/profile', 'SettingController@postProfileSetting');
        Route::match(['GET', 'POST'], 'setting/setting', 'SettingController@processSetting');

        Route::get('user', 'UserController@getIndex');
        Route::delete('user/{user}', 'UserController@destroy');
        Route::get('user/edit/{user}', 'UserController@edit');
        Route::put('user/{user}', 'UserController@update');
        Route::get('user/add', 'UserController@add');
        Route::post('user/create', 'UserController@create');
        Route::get('user/profile/{id}', 'UserController@profile');

        // CMS PAges Controller ......
        Route::get('cms', 'CmsController@getIndex');
        Route::delete('cms/{page_id}', 'CmsController@destroy');
        Route::get('cms/edit/{page_id}', 'CmsController@edit');
        Route::put('cms/{page_id}', 'CmsController@update');
        Route::get('cms/add', 'CmsController@add');
        Route::post('cms/create', 'CmsController@create');

		#Orders Section 
		Route::get('orders', 'UserorderController@getIndex');
		Route::get('userorder/details/{id}', 'UserorderController@orderDetails');

        // Push Notification PAges Controller ......

        Route::get('push/send', 'PushNotificationController@add');


        //Route::match(['GET', 'POST'], 'user/add', 'UserController@add');

        Route::get('report/{index?}', 'ReportController@getIndex');
        Route::delete('report/{report}', 'ReportController@destroy');
		*/
    });
});

Route::group(['middleware' => ['web']], function () {
    //Route::auth();

    Route::get('index', 'HomeController@getIndex');
    Route::get('login', 'HomeController@getlogin');
    Route::post('login/authentication', 'WebController@login');
    Route::get('forgotpassword', 'HomeController@forgotpwd');
    Route::post('sendemail','WebController@sendemail');
    Route::post('newsmail','WebController@newsmail');
    Route::get('signup', 'HomeController@signup');
    Route::post('signup/add', 'WebController@add');
    Route::get('category/{category}', 'HomeController@category');
    Route::get('contactus', 'HomeController@contactus');
    Route::post('contactus/add', 'WebController@contactadd');
    Route::get('terms', 'HomeController@termsandconditions');
    Route::get('aboutus', 'HomeController@aboutus');
    Route::get('sitemap', 'HomeController@sitemap');
    Route::get('privacy', 'HomeController@privacy');
    Route::get('help', 'HomeController@help');
    Route::get('orders', 'HomeController@orders');
    Route::get('wishlist', 'HomeController@wishlist');
    Route::get('shipping', 'HomeController@shipping');
    Route::get('pricing/policy', 'HomeController@pricingpolicy');
    Route::get('satisfaction', 'HomeController@satisfaction');
    Route::get('shipping/policy', 'HomeController@shippingpolicy');
    Route::get('categories', 'HomeController@categories');
    Route::get('orderandreturn', 'HomeController@orderandreturn');
    Route::get('shippingoption', 'HomeController@shippingoption');
    Route::get('needhelp', 'HomeController@needhelp');
    Route::get('customersupport', 'HomeController@customersupport');
    Route::get('siteinformation', 'HomeController@siteinformation');
    Route::get('productdetails/{category}/{product}', 'HomeController@productdetail');
    Route::post('productdetails/{category}/{product}', 'HomeController@productdetailaddcart');
    Route::get('productlist/{product}', 'HomeController@productlist');
    Route::get('logout', 'HomeController@logout');
    Route::get('checkout', 'HomeController@checkOut');
    Route::get('addAddress', 'HomeController@addAddress');
    Route::post('address/add', 'WebController@addAddress');
    Route::post('order/add', 'WebController@addOrder');
    Route::get('cartDelete/{product}', 'HomeController@deleteCart');
    Route::get('add-to-favorite/{product}', 'HomeController@addToFavorite');
    Route::post('addtocart','WebController@addtocart');
    Route::post('search/','WebController@search');
//    Route::get('index', function () {
//        return frontend_view("index");
//    });
});

Route::get('/test', function() {
    $userCreated = App\User::find(1);
    $emailBody = 'test';
    \Mail::raw($emailBody, function($m) use($userCreated) {
        $m->to($userCreated->email)->from(env('MAIL_USERNAME'))->subject('Welcome on Board - ValuationApp');
    });
});

Route::get('/api/examples', function() {
    $status = false;
    $noData = false;

    $response = [
        'status' => $status
    ];

    if (!$status) {
        $response['error_code'] = 'token_expired';
        $response['message'] = 'Your token has been expired, please log-in again.';
    } else {
        $dummyData = [
            [
                'user_id' => 1,
                'name' => 'John Doe',
            ],
            [
                'user_id' => 2,
                'name' => 'Rasmus Lerdorf',
            ]
        ];

        $response['body'] = $noData ? [] : $dummyData;
    }

    return $response;
});
