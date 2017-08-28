@extends( 'frontend.layout' )
@section('title', '')
@section('CSSLibraries')
    <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet">
    <link href="{{ frontend_asset('css/daterangepicker.css') }}" rel="stylesheet">
@endsection
@section('JSLibraries')
    <<script src="{{ frontend_asset('js/library.js')}}" type="text/javascript" ></script>
    <script src="{{ frontend_asset('js/main.js')}}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="{{ frontend_asset('js/moment.min.js')}}"></script>
    <script src="{{ frontend_asset('js/daterangepicker.js')}}" type="text/javascript"></script>
    <!-- Custom Theme Style -->
    <script>new WOW().init();</script>
    <!------------------------ WOW Animation CDN------------------------------------>
    @endsection
    @section('inlineJS')
            <!-- bootstrap-daterangepicker -->




    <script>
        $(document).ready(function() {
//            $('#reservation').daterangepicker(null, function(start, end, label) {
//                console.log(start.toISOString(), end.toISOString(), label);
//            });

            var end = moment();
            $('#reservation-time').daterangepicker({
                timePicker: true,
                timePickerIncrement: 10,
                singleDatePicker: true,
                minDate: end,
                locale: {
                    format: 'YYYY-MM-DD h:mm:ss'
                }
            });

            $('.dropdown-menu').hide();


//            $('#reservation-time2').daterangepicker({
//                timePicker: true,
//                singleDatePicker: true,
//                timePickerIncrement: 30,
//                locale: {
//                    format: 'MM-DD-YYYY h:mm:ss'
//                }
//            });



        });
    </script>
    <!-- /bootstrap-daterangepicker -->
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

    <section class="section checkout contactpage">
        <div class="container">
            <div class="row">
                <form name="order" action="order/add" method="post" id="order">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h1>CHECKOUT</h1>
                <div class="col-md-6 padleft">
                    <div class="whtbg content-area-1">

                        {{--<h3>1. User Information</h3>--}}

                        {{--<div class="col-md-6 padleft">--}}
                            {{--<label>FIRST NAME *</label>--}}
                            {{--<input name="fname" type="text">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6 padright">--}}
                            {{--<label>LAST NAME *</label>--}}
                            {{--<input name="lname" type="text">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 nopad">--}}
                            {{--<label>EMAIL ADDRESS *</label>--}}
                            {{--<input name="email" type="email">--}}
                        {{--</div>--}}

                        <h3>1. NEW ADDRESS</h3>
                        <div class="checkboxbtns">

                                <label for="f-option"><a href="{{ frontend_url('addAddress') }}">  <i class="fa fa-plus" aria-hidden="true" style="font-size: 20px"></i> ADD NEW ADDRESS </a></label><br><br>
                        </div>
                        <h3>2. PREVIOUS ADDRESS</h3>
                        <div class="checkboxbtns">
                            <ul>
                                <li>
                                    <input type="radio" id="f-option" name="address">
                                    <label for="f-option">Deliver to this Address</label>
                                    <div class="check"></div>
                                </li>
                                {{--<li>--}}
                                    {{--<input type="radio" id="s-option" name="selector">--}}
                                    {{--<label for="s-option">Deliver to this Address</label>--}}
                                    {{--<div class="check">--}}
                                        {{--<div class="inside"></div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                        <div class="clearfix"><br>
                            <br>
                        </div>
                        <div class="col-md-12 nopad">
                            <label>SELECT AN ADDRESS FROM ADDRESS BOOK.</label>
                            <select name="address_id" required="required">

                                    @foreach($useraddress as $addItem)
                                <option value="{{$addItem->id}}"> {{$addItem->country}} {{$addItem->street_name}} {{$addItem->building_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"><br>
                            <br>
                        </div>
                        <h3>2. DELIVERY TIME</h3>
                        <p>Select preferred time</p>
                                            <input type="text" name="delivery_datetime" id="reservation-time" class="form-control" value="01-01-2017"/>


                        <div class="clearfix"><br>
                            <br>
                        </div>
                        <h3>3. PAYMENT METHOD</h3>
                        <div class="checkboxbtns">
                            <ul>
                                <li>
                                    <input checked=checked type="radio" id="s-option" name="payment_method" value="cc">
                                    <label for="s-options">Cash On Delivery</label>
                                    <div class="check"></div>
                                </li>
                                {{--<li>--}}
                                {{--<input type="radio" id="s-option" name="selector">--}}
                                {{--<label for="s-option">Deliver to this Address</label>--}}
                                {{--<div class="check">--}}
                                {{--<div class="inside"></div>--}}
                                {{--</div>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6 padright">
                    <div class="whtbg content-area-1 registered_customers">
                        <h3>5. REVIEW YOUR ORDER</h3>
                        <table  class="orderreview" width="100%">
                            <tr>
                                <th>Your Product</th>
                                <th>Item Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                            <?php $total=0;?>
                            @foreach($usercart as $cartItem)
                                <?php $record =  $cartItem->product; ?>
                            <tr>
                                <td>{{$record->product_name}}</td>
                                <td>{{$record->price}}</td>
                                <td>{{$cartItem->quantity}}</td>
                                <?php
                                $subtotal=$record->price*$cartItem->quantity;
                                      $total =$subtotal+$total;

                                $ids[]=$record->id;
                                $quantity[]=$cartItem->quantity;
                                $idsList = implode(',', $ids);
                                $quantityList = implode(',', $quantity);




                                ?>
                                <td>{{$subtotal}}</td>
                            </tr>
                            @endforeach
                        </table>
                          <input type="hidden" value="{{$idsList}}" name="items_ids">
                        <input type="hidden" value="{{$quantityList}}" name="quantities">
                        <?php $user=Session::get('user'); ?>
                        <input type="hidden" value="{{$user->id}}" name="user_id">
                        <div class="clearfix"><br></div>

                        <div class="col-md-3"></div>

                        <div class="col-md-9 noapad">
                            <table  class="subtotal" width="100%">

                                <tr>
                                    {{--<td>Subtotal</td>--}}
                                    {{--<td>BD1.400</td>--}}
                                </tr>
                                <tr>
                                    <td>Home Delivery Charges</td>
                                    <td>Free</td>
                                </tr>

                                <tr>
                                    <td>Total</td>
                                    <td>BD {{$total}}</td>
                                </tr>


                            </table>

                            {{--<div class="forgetitem">Forgot an item? <a href="javascript::">Edit Your Cart</a></div>--}}

                        </div>
                        <div class="clearfix"></div>
                        <hr />



                        <div class="clearfix"></div>

                        <div class="subscribe">

                            <h4>PRODUCT SUBSTITUTUTION PREFERENCE</h4>


                            <input type="radio" name="Substitute" value="Substitute"> <span>Substitute my items</span>


                            <ul>
                                <li>We'll find a suitable alternative if your ordered item is unavailable</li>
                                <li>We’ll call to confirm substitutes and price variances if any</li>
                                <li>If you don't want it, just hand it back to your driver for a full refund</li>
                            </ul>

                            <input type="radio" name="Substitute" value="NotSubstitute"> <span>Do not substitute my items</span>

                            <ul>
                                <li>You will not receive an alternative if the product is unavailable </li>
                            </ul>

                        </div>

                        <div class="clearfix"><br/></div>

                        <div class="commnets"> <label>Comments</label>
                            <textarea name="additional_notes" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" id="mesg" aria-invalid="false"></textarea></div>


                        <div class="clearfix"><br></div>
                        <div class="pull-right">
                            <input value="Place Order" type="submit">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection