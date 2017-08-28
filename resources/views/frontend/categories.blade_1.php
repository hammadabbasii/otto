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
<!------------------------ Header Ends ------------------------------------>

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
<?php
//            dd($Category);
?>
<section class="inner-banner banner-categories">
    <h1>{{$Category->category_name}}</h1>
    <span>Smarter Shopping,Better Living!</span>
    @foreach( $Category->subcategories as $subcategory)
    <?php $count = count($subcategory->getProductsByBrand); ?>
    @endforeach
    <div class="items_view_all">( <?php echo $count; ?> Items) <a href="#">view all</a></div>


</section>
<section class="container">
    <div class="row">
        <div class="breadcrumbs">
            <a href="{{frontend_url('index') }}"> Home</a>
            <a href="{{ frontend_url('categories') }}">All Categories </a> {{$Category->category_name}}</div>
    </div>
</section>

<!------------------------ Content Area ------------------------------------>

<section class="container bx nopad">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 sub-categories-manu  ">
        <h1>categories</h1>
        <ul>
            {{--<li class="first"><a href="javascript:;">Mini PCs</a></li>--}}
                @foreach( $allCategoriesFromDB as $category )
                <li><a href="{{ frontend_url('category/'.str_slug($category->id)) }}">{{$category->category_name}}</a></li>
                @endforeach
                {{--<li><a href="javascript:;">Desktops &amp; Servers</a></li>--}}
                {{--<li><a href="javascript:;">Software</a></li>--}}
                {{--<li><a href="javascript:;">Tablet Accessories</a></li>--}}
                {{--<li><a href="javascript:;">Other Computer Products</a></li>--}}
                {{--<li class="last"><a href="javascript:;">Demo Board</a></li>--}}
            </ul>
            <div class="nav"><a href="javascript:;" class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></a> <a href="javascript:;" class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></a></div>
</div>
<div class="col-lg-9 col-md-9 col-sm-8 col-xs-6 nopad-right mtop25px-lg no-pad-xs">
    @foreach( $Category->subcategories as $subcategory )
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 categories-box">
        <h2>{{$subcategory->category_name}}</h2>
        <img class="lazy" src="{{$Category->image}}" alt="">
        <ul>
            @foreach($subcategory->getProductsByBrand()->limit(3)->get() as $product)
            <li><a href="{{ frontend_url('productdetails/'.$Category->id.'/'.$product->id)}}">{{$product->product_name}}</a></li>
            @endforeach
            <li class="last"><a class="view-all" href="{{ frontend_url('productlist/'.$subcategory->id)}}">Shop All</a></li>
        </ul>
    </div>
    {{--<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 categories-box">--}}
    {{--<h2>Networking</h2>--}}
    {{--<img class="lazy" src="images/categories-img-02.jpg" alt="">--}}
    {{--<ul>--}}
    {{--<li class="first"><a href="javascript:;">Wireless Routers</a></li>--}}
    {{--<li><a href="javascript:;">Wired Routers</a></li>--}}
    {{--<li><a href="javascript:;">Moern-Router</a></li>--}}
    {{--<li class="last"><a class="view-all" href="javascript:;">Shop All</a></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs categories-box">--}}
    {{--<h2>Laptops</h2>--}}
    {{--<img class="lazy" src="images/categories-img-03.jpg" alt="">--}}
    {{--<ul>--}}
    {{--<li class="first"><a href="javascript:;">Wifi</a></li>--}}
    {{--<li><a href="javascript:;">HDMI</a></li>--}}
    {{--<li><a href="javascript:;">Camera</a></li>--}}
    {{--<li class="last"><a class="view-all" href="javascript:;">Shop All</a></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs categories-box">--}}
    {{--<h2>Laptops</h2>--}}
    {{--<img class="lazy" src="images/categories-img-03.jpg" alt="">--}}
    {{--<ul>--}}
    {{--<li class="first"><a href="javascript:;">Wifi</a></li>--}}
    {{--<li><a href="javascript:;">HDMI</a></li>--}}
    {{--<li><a href="javascript:;">Camera</a></li>--}}
    {{--<li class="last"><a class="view-all" href="javascript:;">Shop All</a></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs categories-box">--}}
    {{--<h2>Computer Components</h2>--}}
    {{--<img class="lazy" src="images/categories-img-04.jpg" alt="">--}}
    {{--<ul>--}}
    {{--<li class="first"><a href="javascript:;">Processors</a></li>--}}
    {{--<li><a href="javascript:;">Motherboards</a></li>--}}
    {{--<li><a href="javascript:;">Graphics Cards</a></li>--}}
    {{--<li class="last"><a class="view-all" href="javascript:;">Shop All</a></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 categories-box">--}}
    {{--<h2>Tablet PCs</h2>--}}
    {{--<img class="lazy" src="images/categories-img-01.jpg" alt="">--}}
    {{--<ul>--}}
    {{--<li class="first"><a href="javascript:;">Processors</a></li>--}}
    {{--<li><a href="javascript:;">Motherboards</a></li>--}}
    {{--<li><a href="javascript:;">Graphics Cards</a></li>--}}
    {{--<li class="last"><a class="view-all" href="javascript:;">Shop All</a></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    @endforeach
</div>
</section>

<!------------------------ Content Area Ends ------------------------------------>

<!------------------------ Shop By Brands ------------------------------------>

<section class="bx">
    <div class="container nopad">
        <div class="cat_large_box whtbg">
            <div class="toparea">
                <h4>Shop By Brands </h4>
                <div class="clear"></div>
            </div>
            <div class="cat_mid_area categories-logo-all">
                <div class="col-md-12">
                    <div class="animated fadeInUp wow  animated" style="visibility: visible; animation-name: fadeInUp;">
                        @foreach($Category->subcategories as $subcategory)
                        @foreach($subcategory->brands as $brand)
                        <div class="categories-logo"><img style="width:115px ;height: 35px;" src="{{$brand->image}}" alt="" class="lazy" width="115" height="35"></div>
                        @endforeach
                        @endforeach
                        {{--<div class="categories-logo"><img src="images/categories-logo-02.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-03.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-04.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-05.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-06.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-07.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-08.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-04.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-07.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-08.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-02.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-05.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-06.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-02.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-08.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-05.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-01.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-03.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-05.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-08.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-08.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-04.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-06.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-01.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-04.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-06.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-08.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-02.png" alt="" class="lazy" width="115" height="35"></div>--}}
                        {{--<div class="categories-logo"><img src="images/categories-logo-03.png" alt="" class="lazy" width="115" height="35"></div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!------------------------ Shop By Brands ------------------------------------>






<!------------------------ Groceries Categories ------------------------------------>



<!------------------------ Groceries Categories------------------------------------>
@endsection