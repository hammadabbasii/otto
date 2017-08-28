@extends( 'frontend.layout' )
@section('title', '')
@section('CSSLibraries')
    <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet">
    @endsection
    @section('JSLibraries')
        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
        {{--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>--}}
        <<script src="{{ frontend_asset('js/library.js')}}" type="text/javascript" ></script>
        <script src="{{ frontend_asset('js/main.js')}}" type="text/javascript"></script>
        {{--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>--}}
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

    <!------------------------ Content Area ------------------------------------>
    <section class="section accountpage">
        <div class="container">
            <div class="row">
                <div class="col-md-2 nopad leftsidebar"> <a href="{{frontend_url('signup')}}">MY ACCOUNT</a> <a href="{{frontend_url('orders')}}" class="active">MY ORDERS</a> <a href="{{frontend_url('wishlist')}}">MY WISHLIST</a> </div>
                <div class="col-md-10 nopad">
                    <div class="whtbg content-area-1 contactpage">
                        <table border="0" width="100%;" class="sorted">
                            <tr>
                                <td><h2>MY ORDERS</h2></td>
                                <td></td>
                                <td>


                                   <?php  $user=session()->get('user');

                                    $checkcart=\App\Usercart::where('user_id',$user->id)->first();

                                    ?>
                                    @if(isset($checkcart))
                                    <a href="{{frontend_url('checkout')}}"><input value="CHECKOUT" type="submit"></a>
                                    @endif

                                </td>
                                {{--<td>--}}
                                    {{--<select>--}}
                                        {{--<option>Last 30 days</option>--}}
                                        {{--<option>Last 20 days</option>--}}
                                    {{--</select>--}}
                                {{--</td>--}}
                                {{--<td><input value="Go" type="submit"></td>--}}
                            </tr>
                        </table>
                        <div class="orderpage">
                            <table width="100%">
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Remove Cart</th>

                                </tr>
                                @foreach($usercart as $cartItem)
                                    <?php $record =  $cartItem->product; ?>
                                <tr>
                                    <?php //dd($record) ?>
                                    <td><img src="{{$record->product_image}}" alt=""></td>
                                    <td>{{$record->product_name}}</td>
                                    <td>{{$record->price}}</td>
                                    <td>{{$cartItem->quantity}}</td>
                                        <td><a href="{{frontend_url('cartDelete/'.$record->id)}}" ><i class="fa fa-trash-o" aria-hidden="true" style="font-size:50px"></i></a></td>

                                </tr>
                                    @endforeach
                            </table>
                        </div>

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