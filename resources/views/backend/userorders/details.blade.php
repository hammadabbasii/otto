@extends( 'backend.layouts.app' )

@section('title', 'Orders')

@section('CSSLibraries')
<!-- DataTables CSS -->
<link href="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('JSLibraries')
<!-- DataTables JavaScript -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="{{ backend_asset('libraries/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.js') }}"></script>


<script type="text/javascript">



$(document).ready(function() {

});</script>
@endsection

@section('inlineJS')


@endsection

@section('content')

<?php
//echo '<pre>';
// print_r($order);
// die();
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Order Detail</h3>
            </div>


        </div>

        <div class="clearfix"></div>
        @include('backend.layouts.modal')
        @include( 'backend.layouts.popups')

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Report <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <!--<li><a class="close-link"><i class="fa fa-close"></i></a>-->
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!--<div class="col-md-3 col-sm-3 col-xs-12 detail_left">
                            <div class="detail_img">
                                <div id="crop-avatar">
                                   
                                </div>
                            </div>
                            <h3></h3>

                            

                            <br />
                        </div>-->
                        <div class="col-md-9 col-sm-9col-xs-12">



                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Order Details</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="detail-tab2" data-toggle="tab" aria-expanded="false">User Details</a>
                                    </li>
<li role="presentation" class=""><a href="#tab_content4" role="tab" id="detail-tab3" data-toggle="tab" aria-expanded="false">
Ordered Items ({{count($order['items'])}})</a>

                                    </li>
                                    <li role="presentation"><a href="#tab_content5" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Shipping Details</a>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="   home-tab">

                                        <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" >Order Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>No of Items</td>
                                                        <td>
                                                        	<?php
																echo count($order['items'])
															?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Amount</td>
                                                        <td>{{$order['total_amount']}}</td>
                                                    </tr>
                                                    <!--<tr>
                                                        <td>Discount</td>
                                                        <td>{{$order['discount']}}</td>
                                                    </tr>-->
                                                    <tr>
                                                        <td>Final Amount</td>
                                                        <td>{{$order['final_amount']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Status</td>
                                                        <td>{{$order['status']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Placed On</td>
                                                        <td>{{ Carbon\Carbon::parse($order['created_at'])->format('d-M-Y H:i:s') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Updated</td>
                                                        <td>{{ Carbon\Carbon::parse($order['updated_at'])->format('d-M-Y H:i:s') }}</td>
                                                        
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="detail-tab">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" >User</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Full Name</td>
                                                    <td>{{$order['creator']['full_name']}}</td>
                                                </tr>
                                                <!--<tr>
                                                    <td>Last Name</td>
                                                    <td>{{$order['creator']['last_name']}}</td>
                                                </tr>-->
                                                <tr>
                                                    <td>Email Address</td>
                                                    <td>{{$order['creator']['email']}}</td>
                                                </tr>

                                                <!--<tr>
                                                    <td>Address</td>
                                                    <td>{{$order['creator']['address'] != '' ? $order['creator']['address'] : 'N/A'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>{{$order['creator']['city'] != '' ? $order['creator']['city'] : 'N/A'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>State</td>
                                                    <td>{{$order['creator']['state'] != '' ? $order['creator']['state'] : 'N/A'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Country</td>
                                                    <td>{{$order['creator']['country'] != '' ? $order['creator']['country'] : 'N/A'}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Order Status</td>
                                                    <td>{{$order['creator']['status'] == '1' ? 'Active' : 'Inactive'}}</td>
                                                </tr>-->
                                                <tr>
                                                    <td>Created At</td>
                                                    <td>{{ Carbon\Carbon::parse($order['creator']['created_at'])->format('d-M-Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Updated At</td>
                                                    <td>{{ Carbon\Carbon::parse($order['creator']['updated_at'])->format('d-M-Y H:i:s') }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="detail-tab">
                                    @foreach( $order['items'] as $allOrderedItems)
                                    
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" >{{$productDetailsArray[($allOrderedItems['product_id'])]['product_name']}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Unit Price</td>
                                                    <td>{{$allOrderedItems['unit_price']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Quantity</td>
                                                    <td>{{$allOrderedItems['quantity']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Price</td>
                                                    <td>{{$allOrderedItems['total_price']}}</td>
                                                </tr>
                                                <!--<tr>
                                                    <td>Sale Price</td>
                                                    <td>{{$allOrderedItems['sale_price']}}</td>
                                                </tr>-->
                                                <!--<tr>
                                                    <td>Discount Percentage</td>
                                                    <td>{{$allOrderedItems['discount_percentage']}}%</td>
                                                </tr>-->
                                                <?php
													if(isset($allOrderedItems['promotion_id']))
													{
													if($allOrderedItems['promotion_id'] >0)
													{
														$currentPromotionId	=	$allOrderedItems['promotion_id'];
														$promotionDetails[$currentPromotionId]
												?>
                                                	<tr>
                                                    <td>Promotion</td>
                                                    <td>{{$promotionDetails[$currentPromotionId]['promotion_name']}}</td>
                                                	</tr>
                                                <?php
													}}
												?>
                                                <tr>
                                                    <td>Created At</td>
                                                    <td>{{ Carbon\Carbon::parse($allOrderedItems['created_at'])->format('d-M-Y H:i:s') }}</td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    @endforeach
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane fade " id="tab_content5" aria-labelledby="   home-tab">

                                        <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" >Shipping Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>
                                                        	{{$shippedToAddress['country']}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>{{$shippedToAddress['city']}}</td>
                                                    </tr>
                                                    <!--<tr>
                                                        <td>Discount</td>
                                                        <td>{{$order['discount']}}</td>
                                                    </tr>-->
                                                    <tr>
                                                        <td>Street</td>
                                                        <td>{{$shippedToAddress['street_name']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Building</td>
                                                        <td>{{$shippedToAddress['building_name']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Floor</td>
                                                        <td>{{$shippedToAddress['floor']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Appartment</td>
                                                        <td>{{$shippedToAddress['appartment']}}</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Nearest Landmark</td>
                                                        <td>{{$shippedToAddress['nearest_landmark']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location Type</td>
                                                        <td>{{$shippedToAddress['location_type']}}</td>
                                                    </tr>
													

                                                    
                                                </tbody>
                                            </table>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

@endsection