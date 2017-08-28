@extends( 'backend.layouts.app' )

@section('title', 'Trips')

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

function getJoinees(TripId)
        {
        $('#popup_heading').html('Trip Joinees');
        var PopupBody = '';
        $.ajax({
        type: "GET",
                url: "/tripcrasher/backend/trips/getJoinees/" + TripId,
                data: {},
                success: function(data)
                {
                var incomingData = JSON.parse((data))
                        console.log(incomingData)
                        for (var i = 0; i < (incomingData.length); i++)
                {
                var fullName = incomingData[i]['full_name'];
                var profilePic = incomingData[i]['profile_picture'];
                if ($.trim(fullName == ''))
                {
                fullName = " " + incomingData[i]['first_name'] + " " + incomingData[i]['last_name']; ;
                }
                PopupBody = PopupBody + '<tr><td style="padding:10px"><img src="' + profilePic + '" width="50" ></td><td>' + fullName + '</td></tr>';
                }

                $('#popup_body').html(PopupBody);
                }
        });
        var footerData = '';
        $('#PopupFooter').html(footerData);
        }



function ShowMap(placeName, placeLatitude, placeLongitude)
        {
        //$('#myModal').css('width','600');
        $('#myModalInner').css('width', '650');
        $('#popup_heading').html('Location');
        // var PopupBody	=	'<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD-SF9cO7YaQP9lVTEtXmlFJVpaov6D3Fw&q='+placeLatitude+','+placeLongitude+'" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';

        // var PopupBody	=	'<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14482.748950634612!2d'+placeLongitude+'!3d'+placeLatitude+'!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1482514201112" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';


        var PopupBody = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14482.116194992053!2d' + 67.073816 + '!3d' + 24.829413 + '!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!!2s' + placeName + '!5e0!3m2!1sen!2s!4v1482514462965" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
        $('#popup_body').html(PopupBody);
        var footerData = '';
        $('#PopupFooter').html(footerData);
        /* var popupBody = '';
         //Body Setting 
         $('#popup_body').html(popupBody);
         var popupBody = '<div id="dvMap" style="height: 380px; width: 580px;"></div>';
         $('#popup_body').html(popupBody);*/
        /*var mapOptions = {
         center: new google.maps.LatLng(25.197197, 55.274376),
         zoom: 10,
         mapTypeId: google.maps.MapTypeId.ROADMAP
         }
         var map = new google.maps.Map($("#dvMap")[0], mapOptions);*/
        }
$(document).ready(function() {

});</script>
@endsection

@section('inlineJS')


@endsection

@section('content')

<?php
//echo '<pre>';
// print_r($tripLogs);
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{$trips['trip_name']}} Detail</h3>
            </div>


        </div>

        <div class="clearfix"></div>
        @include('backend.layouts.modal')
        @include( 'backend.layouts.popups')

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Trip Report <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 detail_left">
                            <div class="detail_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    {{ Html::image('public/images/users/'.$trips['creator']['profile_picture'] , '', array( 'width' => 200, 'height' => 200 )) }}
                                </div>
                            </div>
                            <h3>{{$trips['creator']['first_name'].' '.$trips['creator']['last_name']}}</h3>

                            <ul class="list-unstyled trip_data">
                                <li><i class="fa fa-map-marker trip-detail-icon"></i> {{$trips['creator']['address'] != '' ? $trips['creator']['address'] : 'N/A'}}
                                </li>

                                <li>
                                    <i class="fa fa-briefcase trip-detail-icon"></i> {{$trips['creator']['email'] != '' ? $trips['creator']['email'] : 'N/A'}}
                                </li>


                            </ul>

                                        {{--<a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Detail {{$trips['creator']['first_name'                            ]}}</a>                                     --}}
                            <br />
                        </div>
                        <div class="col-md-9 col-sm-9col-xs-12">



                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Trip Details</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="detail-tab2" data-toggle="tab" aria-expanded="false">Detail</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="   home-tab">

                                        <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" >Trip Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Trip Name</td>
                                                        <td>{{$trips['trip_name']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trip Purpose</td>
                                                        <td>{{$trips['trip_purpose']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trip Details</td>
                                                        <td>{{$trips['trip_detail']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trip Origin</td>
                                                        <td> 
                                                            <a data-toggle="modal" data-id="{{ $trips['id'] }}" data-target=".bs-example-modal-sm" href="javascript:;" onclick="ShowMap('{{$trips['trip_origin']}}','{{$trips['trip_origin_latitude']}}','{{$trips['trip_origin_longitude']}}')">
                                                                {{$trips['trip_origin']}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trip Destination</td>
                                                        <td> 

                                                            <a data-id="{{ $trips['id'] }}" data-toggle="modal" data-target=".bs-example-modal-sm" href="javascript:;" onclick="ShowMap('{{$trips['trip_destination']}}','{{$trips['trip_destination_latitude']}}','{{$trips['trip_destination_longitude']}}')">
                                                                {{$trips['trip_destination']}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trip From</td>
                                                        <td>{{$trips['trip_from']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trip To</td>
                                                        <td>{{$trips['trip_to']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Age Bracket</td>
                                                        <td>{{$trips['age_bracket']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Itinerary</td>
                                                        <td>{{$trips['itinerary']['itinerary_name']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Interests</td>
                                                        <td>
<?php
$selectedInterests = array();
foreach ($trips['interests'] as $eachTripInterest) {
    $selectedInterests[] = ucfirst($allInterestsArray[$eachTripInterest['id']]['interest_name']);
}
echo implode(", ", $selectedInterests);
?>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>No of Joinees</td>
                                                        <td>
                                                            <a data-toggle="modal" data-id="{{ $trips['id'] }}" data-target=".bs-example-modal-sm" href="javascript:;" onclick="getJoinees('{{ $trips['id'] }}')">
                                                                {{count($allTripJoinees['Accepted'])}}
                                                            </a>  
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Preferred Gender</td>
                                                        <td>{{$trips['preferred_gender']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Created On</td>
                                                        <td>{{$trips['created_at']}}</td>
                                                    </tr>



                                                </tbody>
                                            </table>

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="detail-tab">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" >Trip Creator</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>First Name</td>
                                                    <td>{{$trips['creator']['first_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Last Name</td>
                                                    <td>{{$trips['creator']['last_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email Address</td>
                                                    <td>{{$trips['creator']['email']}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Address</td>
                                                    <td>{{$trips['creator']['address'] != '' ? $trips['creator']['address'] : 'N/A'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>{{$trips['creator']['city'] != '' ? $trips['creator']['city'] : 'N/A'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>State</td>
                                                    <td>{{$trips['creator']['state'] != '' ? $trips['creator']['state'] : 'N/A'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Country</td>
                                                    <td>{{$trips['creator']['country'] != '' ? $trips['creator']['country'] : 'N/A'}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Trip Status</td>
                                                    <td>{{$trips['creator']['status'] == '1' ? 'Active' : 'Inactive'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Created At</td>
                                                    <td>{{ Carbon\Carbon::parse($trips['creator']['created_at'])->format('d-M-Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Updated At</td>
                                                    <td>{{ Carbon\Carbon::parse($trips['creator']['updated_at'])->format('d-M-Y H:i:s') }}</td>
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