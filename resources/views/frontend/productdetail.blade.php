@extends( 'frontend.layout' )
@section('title', '')
@section('CSSLibraries')
    <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet">
    @endsection
    @section('JSLibraries')
        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
        {{--<!------------------------ Jquery CDN ------------------------------------>--}}
        {{--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>--}}
        <!------------------------ Javascript ------------------------------------>
        <script src="{{ frontend_asset('js/library.js')}}" type="text/javascript" ></script>
        <script src="{{ frontend_asset('js/main.js')}}" type="text/javascript"></script>
        <!------------------------ WOW Animation CDN------------------------------------>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    @endsection
    @section('inlineJS')

            <script>

                function markUnmarkFavourite(userId,productId)
                {
                    anchorHtml = '';
                    //Ajax Call to activate function
                    $.ajax({
                        type: "POST",
                        url: '<?php echo URL::to('/');?>/api/product/wishlist',
                        data: {
                            user_id:userId,
                            product_id:productId
                        },
                        success: function(data)
                        {
                            if(data.Response=='Success' )
                            {


                                if(data.Result.status== 1) {


                               anchorHtml =' <a onclick="markUnmarkFavourite('+userId+','+productId+')" class="add_to_favourites" aria-hidden="true" style="font-size: 20px; margin-right: 10px;cursor: pointer"><i class="fa fa-heart" >  </i> Added to Favourites</a>';

                                } else {


                                    anchorHtml =' <a onclick="markUnmarkFavourite('+userId+','+productId+')" class="add_to_favourites" aria-hidden="true" style="font-size: 20px; margin-right: 10px; cursor: pointer"><i class="fa fa-heart-o" >  </i> Add to Favourites</a>';

                                }

                                $('#wishlistBtn').html(anchorHtml);

                            }

                        }
                    });

                    $('#CloseButton').trigger('click');

                }


            </script>
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
            <div class="breadcrumbs"> <a href="{{frontend_url('index')}}"> Home</a> <a href="{{frontend_url('categories')}}">All Categories</a> {{$product->product_name}}</div>
        </div>
    </section>

    <!------------------------ breadcrum Ends ------------------------------------>

    <!------------------------ Content Area ------------------------------------>
    <section class="section_bottom product_detail">
        <div class="container">
            <div class="row">
                <div class="col-md-6 padleft productimage"><img style="height:407px;width: 540px" src="{{$product->product_image}}" alt="product-title"></div>
                <div class="col-md-6">
                    <h2>{{$product->product_name}}</h2>
                    {{--<h2 class="weight">{{$product->product_description}}</h2>--}}
                    <br>
                    <div class="product_price">{{$product->price}} BHD</div>
                    <br>
                    {{--<div class="price_per_weight"></div>--}}
                    <?php
                    $isFav= $product->is_in_wishlist;
                    $user = session()->get('user');
                    ?>
                    @if(isset($user))
                    <?php
                    $user = session()->get('user');
                    $userId = $user->id;

                    $favourites = $isFav;
                    $anchorClass= "add_to_favourites";
                    $iconClass= "fa fa-heart-o";
                    $text = "Add to Favourites";
                    if($favourites) {
                        $anchorClass= "added_to_favourites";
                        $iconClass= "fa fa-heart";
                        $text = "Added to Favourites";
                    }
                    ?>

                    <span id="wishlistBtn">
                    <a onclick="markUnmarkFavourite('<?php echo $userId; ?>', '<?php echo  $product->id ?>' );"  class="<?= $anchorClass ?>" style="font-size: 20px; margin-right: 10px;"><i class="<?= $iconClass ?>" aria-hidden="true" ></i><?= $text ?></a>
                        </span>
                    @endif
                    <div class="qtybuttons">
                        <?php $user = session()->get('user');  ?>
                            @if(isset($user))
                        <form name="order" action="{{frontend_url("productdetails/".$category->id."/".$product->id)}}" method="post" id="order">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn-number " disabled="disabled" data-type="minus" data-field="quant[1]"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                        <button type="button" class="btn-number" data-type="plus" data-field="quant[1]"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                        <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                        <button type="submit" class="" > ADD </button>
                        </form>
                                @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!------------------------ Content Area Ends ------------------------------------>
@endsection