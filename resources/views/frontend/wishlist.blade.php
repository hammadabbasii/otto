@extends( 'frontend.layout' )
@section('title', '')
@section('CSSLibraries')
    <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet">
    @endsection
    @section('JSLibraries')

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


                                anchorHtml =' <a onclick="markUnmarkFavourite('+userId+','+productId+')" class="added_to_favourites" aria-hidden="true" style="font-size: 20px; cursor: pointer"><i class="fa fa-heart" >  </i></a>';

                            } else {


                                anchorHtml =' <a onclick="markUnmarkFavourite('+userId+','+productId+')" class="added_to_favourites" aria-hidden="true" style="font-size: 20px; cursor: pointer"><i class="fa fa-heart-o" >  </i></a>';

                            }

                            $('#wishlistBtn_'+productId).html(anchorHtml);

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

    <!------------------------ Content Area ------------------------------------>
    <section class="section accountpage">
        <div class="container">
            <div class="row">
                <div class="col-md-2 nopad leftsidebar"> <a href="{{frontend_url('signup')}}">MY ACCOUNT</a> <a href="{{frontend_url('orders')}}">MY ORDERS</a> <a href="{{frontend_url('wishlist')}}" class="active">MY WISHLIST</a> </div>
                <div class="col-md-10 nopad">
                    <div class="whtbg content-area-1 contactpage">

<!--                    --><?php //dd($product); ?>

                        <h2>MY WISHLIST</h2>







                        <div class="orderpage wishlist"><table width="100%">
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Unit Price</th>
                                    <th></th>

                                    {{--<th>Add to Cart</th>--}}
                                </tr>
                                <?php //dd($product); ?>
                                            @foreach($product as $record)
                                            <tr>

                                                        <?php
                                                        $record =   $record[0];
                                                        ?>
                                                <td><img src="{{$record->product_image}}" alt=""></td>
                                                <td>{{$record->product_name}}</td>
                                                <td>BHD {{$record->price}}</td>
                                                 <td>
                                                     <?php
                                                     $isFav= $record->is_in_wishlist;
                                                     $user = session()->get('user');
                                                     ?>
                                                     @if(isset($user))
                                                         <?php
                                                         $user = session()->get('user');
                                                         $userId = $user->id > 0 ? $user->id : 0;

                                                         $favourites = $isFav;
                                                         $anchorClass= "added_to_favourites";
                                                         $iconClass= "fa fa-heart-o";
                                                         $text = "Add to Favourites";
                                                         if($favourites) {
                                                             $anchorClass= "added_to_favourites";
                                                             $iconClass= "fa fa-heart";
                                                             $text = "Added to Favourites";
                                                         }
                                                         ?>

                                                         <span id="wishlistBtn_<?php echo  $record->id ?>">
                                <a onclick="markUnmarkFavourite('<?php echo $userId; ?>', '<?php echo  $record->id ?>' );"  class="<?= $anchorClass ?>" style="font-size: 20px; cursor: pointer;"><i class="<?= $iconClass ?>" aria-hidden="true" ></i></a>
                                    </span>
                                                         @endif
                                                 </td>
                                            </tr>
                                            @endforeach




                            </table></div>


                        <!--<input value="Save" type="submit">-->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!------------------------ Content Area Ends ------------------------------------>

@endsection