@extends( 'frontend.layout' )
@section('title', '')
@section('CSSLibraries')
    <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet">
    @endsection
    @section('JSLibraries')
    <!------------------------ Jquery CDN ------------------------------------>
    <!------------------------ Javascript ------------------------------------>
    <script src="{{ frontend_asset('js/library.js')}}" type="text/javascript" ></script>
    <script src="{{ frontend_asset('js/main.js')}}" type="text/javascript"></script>
    <!------------------------ WOW Animation CDN------------------------------------>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
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
    <section class="container">
        <div class="row">
            <div class="breadcrumbs">
                <a href="{{frontend_url('index')}}"> Home</a>
                <a href="{{frontend_url('categories')}}">All Categories</a>
                <a href="{{frontend_url('category/'.str_slug($allCategoriesFromDB->id))}}">{{$allCategoriesFromDB->category_name}}</a>Products
            </div>
       </div>
    </section>

    <!------------------------ breadcrum Ends ------------------------------------>


    <!------------------------ Tablet PCs Categories ------------------------------------>

    <section class="bx">
       <div class="container nopad">
        <div class="cat_large_box whtbg">
        <div class="toparea">
    <h4>{{$allCategoriesFromDB->category_name}}</h4>
    <div class="clear"></div>
    </div>
    <div class="cat_mid_area">

    <!-- prev/next links -->
    <div class="slideshow-nav"> <span class="prev" id="prev">&nbsp;</span> <span class="next" id="next">&nbsp;</span> </div>
    <!-- slideshow -->
    <div>


    <div class="categories">
        @foreach($Category->getProductsByBrand as $product)
    <div class=" col-md-3 col-sm-3 col-xs-6">
    <div class="sub-categories-box">
        <a href="{{ frontend_url('productdetails/'.$Category->id.'/'.$product->id)}}"><img style="width:211px ;height:155px ;" src="{{$product->product_image}}" alt="" class="lazy" width="211" height="155"></a>
    <h2><a href="{{ frontend_url('productdetails/'.$Category->id.'/'.$product->id)}}">{{$product->product_name}}</a></h2>
    <span>{{$product->price}} BHD</span> </div>
    </div>
        @endforeach
    </div>




    </div>
    <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    </section>

    {{--<!------------------------ Tablet PCs Categories------------------------------------>--}}
@endsection


