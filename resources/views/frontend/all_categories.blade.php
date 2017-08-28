@extends( 'frontend.layout' )
@section('title', '')
@section('CSSLibraries')
    <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet">
    @endsection
    @section('JSLibraries')
    @endsection
    @section('inlineJS')
    @endsection
    @section('content')

            <!------------------------ Tagline ------------------------------------>
    <section class="major-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6  col-sm-6"> </div>
                <div class="col-lg-5 col-md-5 hidden-sm hidden-xs nopad"> <span class="hours24" href="javascript:;" title="">Deliver  within 24 Hours </span> <span class="hours24 num" href="javascript:;" title="">800-33257 (deals) </span> </div>
            </div>
        </div>
    </section>
    <!------------------------ Tagline Ends------------------------------------>

    <section class="inner-banner banner-all-categories">
        <h1>ALL CATEGORIES</h1>
        <span>Smarter Shopping,Better Living!</span> </section>
    <section class="container">
        <div class="row">
            <div class="breadcrumbs"><a href="{{frontend_url('index') }}"> Home</a> All Categories </div>
        </div>
    </section>

    <!------------------------ Content Area ------------------------------------>

    <section class="bx all_cat">
        <div id="groceries_cat" class="container nopad">
            @foreach( $allCategoriesFromDB as $category )
            <div class="cat_large_box whtbg">
                <div class="toparea">

                    <h4>{{$category->category_name}}</h4>
                    <div class="clear"></div>
                </div>
                <div class="cat_mid_area">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">
                                <ul>
                                    @foreach( $category->subcategories as $subcategory )
                                    <li><a href="{{ frontend_url('category/'.str_slug($category->id)) }}">{{$subcategory->category_name}}</a></li>
                                    @endforeach
                                </ul>
                                {{--<div class="col-md-4 nopad"> <img  src="" alt="" class="lazy" width="554" height="202"> </div>--}}
                            </div>
                        </div>
                        <div class="col-md-5"><img style="width:467px ;height:170px ;" src="{{$category->image}}" alt="categoryimage"></div>
                    </div>
                </div>
            </div>
            @endforeach
            {{--<div class="cat_large_box whtbg">--}}
                {{--<div class="toparea">--}}
                    {{--<h4>Houehold & pets</h4>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
                {{--<div class="cat_mid_area">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-7">--}}
                            {{--<div class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">--}}
                                {{--<ul>--}}
                                    {{--<li><a href="javascript::">General Household</a></li>--}}
                                    {{--<li><a href="javascript::">Cleaner & Polish</a></li>--}}
                                    {{--<li><a href="javascript::">Kitchen Appliances</a></li>--}}
                                    {{--<li><a href="javascript::">Laundry</a></li>--}}
                                    {{--<li><a href="javascript::">Pets</a></li>--}}
                                    {{--<li><a href="javascript::">Shoe Care</a></li>--}}
                                    {{--<li><a href="javascript::">Tissue & Toilet Rolls</a></li>--}}
                                    {{--<li><a href="javascript::">General Household</a></li>--}}
                                    {{--<li><a href="javascript::">Cleaner & Polish</a></li>--}}
                                    {{--<li><a href="javascript::">Kitchen Appliances</a></li>--}}
                                    {{--<li><a href="javascript::">Laundry</a></li>--}}
                                    {{--<li><a href="javascript::">Pets</a></li>--}}
                                    {{--<li><a href="javascript::">Shoe Care</a></li>--}}
                                    {{--<li><a href="javascript::">Tissue & Toilet Rolls</a></li>--}}
                                    {{--<li><a href="javascript::">General Household</a></li>--}}
                                    {{--<li><a href="javascript::">Cleaner & Polish</a></li>--}}
                                    {{--<li><a href="javascript::">Kitchen Appliances</a></li>--}}
                                    {{--<li><a href="javascript::">Laundry</a></li>--}}
                                    {{--<li><a href="javascript::">Pets</a></li>--}}
                                    {{--<li><a href="javascript::">Shoe Care</a></li>--}}
                                    {{--<li><a href="javascript::">Tissue & Toilet Rolls</a></li>--}}
                                {{--</ul>--}}
                                {{--<div class="col-md-4 nopad"> <img src="assets/images/banner/all-categories-pic-01.jpg" alt="" class="lazy" width="554" height="202"> </div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-5"><img src="images/cat-image2.jpg" alt="categoryimage"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="cat_large_box whtbg">--}}
                {{--<div class="toparea">--}}
                    {{--<h4>Health</h4>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
                {{--<div class="cat_mid_area">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-7">--}}
                            {{--<div class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">--}}
                                {{--<ul>--}}
                                    {{--<li><a href="javascript::">Bath</a></li>--}}
                                    {{--<li><a href="javascript::">Shower</a></li>--}}
                                    {{--<li><a href="javascript::">Soap</a></li>--}}
                                    {{--<li><a href="javascript::">Deodrants</a></li>--}}
                                    {{--<li><a href="javascript::">Hair Styling</a></li>--}}
                                    {{--<li><a href="javascript::">Dental</a></li>--}}
                                    {{--<li><a href="javascript::">Medicines</a></li>--}}
                                    {{--<li><a href="javascript::">Medicines</a></li>--}}
                                    {{--<li><a href="javascript::">Wellbeing</a></li>--}}
                                    {{--<li><a href="javascript::">Vitamins</a></li>--}}
                                    {{--<li><a href="javascript::">Shaving</a></li>--}}
                                    {{--<li><a href="javascript::">Accessories</a></li>--}}
                                    {{--<li><a href="javascript::">Feminine Care</a></li>--}}
                                    {{--<li><a href="javascript::">Skin Care</a></li>--}}
                                    {{--<li><a href="javascript::">Eye Care</a></li>--}}
                                    {{--<li><a href="javascript::">Footcare</a></li>--}}
                                    {{--<li><a href="javascript::">Seasonal</a></li>--}}
                                {{--</ul>--}}
                                {{--<div class="col-md-4 nopad"> <img src="assets/images/banner/all-categories-pic-01.jpg" alt="" class="lazy" width="554" height="202"> </div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-5"><img src="images/cat-image3.jpg" alt="categoryimage"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="cat_large_box whtbg">--}}
                {{--<div class="toparea">--}}
                    {{--<h4>Toiletries</h4>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
                {{--<div class="cat_mid_area">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-7">--}}
                            {{--<div class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">--}}
                                {{--<ul>--}}
                                    {{--<li><a href="javascript::">Eye Care</a></li>--}}
                                    {{--<li><a href="javascript::">Footcare</a></li>--}}
                                    {{--<li><a href="javascript::">Seasonal</a></li>--}}
                                    {{--<li><a href="javascript::">Soap</a></li>--}}
                                    {{--<li><a href="javascript::">Deodrants</a></li>--}}
                                    {{--<li><a href="javascript::">Hair Styling</a></li>--}}
                                    {{--<li><a href="javascript::">Dental</a></li>--}}
                                    {{--<li><a href="javascript::">Bath</a></li>--}}
                                    {{--<li><a href="javascript::">Shower</a></li>--}}
                                    {{--<li><a href="javascript::">Soap</a></li>--}}
                                    {{--<li><a href="javascript::">Deodrants</a></li>--}}
                                    {{--<li><a href="javascript::">Hair Styling</a></li>--}}
                                    {{--<li><a href="javascript::">Dental</a></li>--}}
                                    {{--<li><a href="javascript::">Medicines</a></li>--}}
                                    {{--<li><a href="javascript::">Shaving</a></li>--}}
                                    {{--<li><a href="javascript::">Accessories</a></li>--}}
                                    {{--<li><a href="javascript::">Feminine Care</a></li>--}}
                                    {{--<li><a href="javascript::">Skin Care</a></li>--}}
                                {{--</ul>--}}
                                {{--<div class="col-md-4 nopad"> <img src="assets/images/banner/all-categories-pic-01.jpg" alt="" class="lazy" width="554" height="202"> </div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-5"><img src="images/cat-image4.jpg" alt="categoryimage"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="cat_large_box whtbg">--}}
                {{--<div class="toparea">--}}
                    {{--<h4>snacks</h4>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
                {{--<div class="cat_mid_area">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-7">--}}
                            {{--<div class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">--}}
                                {{--<ul>--}}
                                    {{--<li><a href="javascript::">Audio Amplifier</a></li>--}}
                                    {{--<li><a href="javascript::">Bang & Olufsen</a></li>--}}
                                    {{--<li><a href="javascript::">Bose Corporation</a></li>--}}
                                    {{--<li><a href="javascript::">Compact Disc Player</a></li>--}}
                                    {{--<li><a href="javascript::">Headphones</a></li>--}}
                                    {{--<li><a href="javascript::">Microphone</a></li>--}}
                                    {{--<li><a href="javascript::">Music Equipment</a></li>--}}
                                    {{--<li><a href="javascript::">Baby monitor</a></li>--}}
                                    {{--<li><a href="javascript::">BeoCom</a></li>--}}
                                    {{--<li><a href="javascript::">Blu-ray</a></li>--}}
                                    {{--<li><a href="javascript::">List of Blu-ray player</a></li>--}}
                                    {{--<li><a href="javascript::">Blu-ray Disc recordable</a></li>--}}
                                    {{--<li><a href="javascript::">Bug zapper</a></li>--}}
                                    {{--<li><a href="javascript::">Home audio</a></li>--}}
                                    {{--<li><a href="javascript::">Audio Amplifier</a></li>--}}
                                    {{--<li><a href="javascript::">Bang & Olufsen</a></li>--}}
                                    {{--<li><a href="javascript::">Bose Corporation</a></li>--}}
                                    {{--<li><a href="javascript::">Compact Disc Player</a></li>--}}
                                    {{--<li><a href="javascript::">Headphones</a></li>--}}
                                    {{--<li><a href="javascript::">Microphone</a></li>--}}
                                    {{--<li><a href="javascript::">Music Equipment</a></li>--}}
                                {{--</ul>--}}
                                {{--<div class="col-md-4 nopad"> <img src="assets/images/banner/all-categories-pic-01.jpg" alt="" class="lazy" width="554" height="202"> </div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-5"><img src="images/cat-image5.jpg" alt="categoryimage"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="cat_large_box whtbg">--}}
                {{--<div class="toparea">--}}
                    {{--<h4>baby & Child</h4>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
                {{--<div class="cat_mid_area">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-7">--}}
                            {{--<div class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">--}}
                                {{--<ul>--}}
                                    {{--<li><a href="javascript::">Baby Food</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Milk</a></li>--}}
                                    {{--<li><a href="javascript::">Nappies & Wipes</a></li>--}}
                                    {{--<li><a href="javascript::">Skin Care</a></li>--}}
                                    {{--<li><a href="javascript::">Eye Care</a></li>--}}
                                    {{--<li><a href="javascript::">Bath</a></li>--}}
                                    {{--<li><a href="javascript::">Shower</a></li>--}}
                                    {{--<li><a href="javascript::">Soap</a></li>--}}
                                    {{--<li><a href="javascript::">Bottles</a></li>--}}
                                    {{--<li><a href="javascript::">Teats</a></li>--}}
                                    {{--<li><a href="javascript::">Feeding Aids</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Gear</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Care</a></li>--}}
                                    {{--<li><a href="javascript::">Room Decor</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Cream</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Lotion</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Oil</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Powder</a></li>--}}
                                {{--</ul>--}}
                                {{--<div class="col-md-4 nopad"> <img src="assets/images/banner/all-categories-pic-01.jpg" alt="" class="lazy" width="554" height="202"> </div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-5"><img src="images/cat-image6.jpg" alt="categoryimage"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="cat_large_box whtbg">--}}
                {{--<div class="toparea">--}}
                    {{--<h4>toys</h4>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
                {{--<div class="cat_mid_area">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-7">--}}
                            {{--<div class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">--}}
                                {{--<ul>--}}
                                    {{--<li><a href="javascript::">Arts & Craft Supplies</a></li>--}}
                                    {{--<li><a href="javascript::">Baby Toys</a></li>--}}
                                    {{--<li><a href="javascript::">Bikes</a></li>--}}
                                    {{--<li><a href="javascript::">Scooters</a></li>--}}
                                    {{--<li><a href="javascript::">Ride-ons</a></li>--}}
                                    {{--<li><a href="javascript::">Building Sets & Blocks</a></li>--}}
                                    {{--<li><a href="javascript::">Collectibles</a></li>--}}
                                    {{--<li><a href="javascript::">Creative Toys</a></li>--}}
                                    {{--<li><a href="javascript::">Discovery Toys</a></li>--}}
                                    {{--<li><a href="javascript::">Dolls & Stuffed Animals</a></li>--}}
                                    {{--<li><a href="javascript::">Games & Puzzles</a></li>--}}
                                    {{--<li><a href="javascript::">Musical Instruments</a></li>--}}
                                    {{--<li><a href="javascript::">Outdoor Play</a></li>--}}
                                    {{--<li><a href="javascript::">Pretend Play</a></li>--}}
                                    {{--<li><a href="javascript::">Speciality Toys</a></li>--}}
                                    {{--<li><a href="javascript::">Toddler & Kids</a></li>--}}
                                    {{--<li><a href="javascript::">Vehicale</a></li>--}}
                                    {{--<li><a href="javascript::">Race Tracks</a></li>--}}
                                {{--</ul>--}}
                                {{--<div class="col-md-4 nopad"> <img src="assets/images/banner/all-categories-pic-01.jpg" alt="" class="lazy" width="554" height="202"> </div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-5"><img src="images/cat-image7.jpg" alt="categoryimage"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </section>
@endsection