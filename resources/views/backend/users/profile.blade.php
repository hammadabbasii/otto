@extends( 'backend.layouts.app' )

@section('title', 'Users')

@section('CSSLibraries')
<!-- DataTables CSS -->
<link href="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('JSLibraries')
<!-- DataTables JavaScript -->
<script src="{{ backend_asset('libraries/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.js') }}"></script>
@endsection

@section('inlineJS')


@endsection

@section('content')

<?php
//echo '<pre>';
// print_r($userLogs);
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{$users['full_name']}} Profile</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Report <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    {{ Html::image('public/images/users/'.$users['profile_picture'] , '', array( 'width' => 200, 'height' => 200 )) }}
                                </div>
                            </div>
                            <h3>{{$users['full_name']}}</h3>

                            <ul class="list-unstyled user_data">
                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> {{$users['email'] != '' ? $users['email'] : 'N/A'}}
                                </li>


                            </ul>

                            {{--<a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile {{$users['first_name'                            ]}}</a>                                     --}}
                            <br />
                        </div>
                        <div class="col-md-9 col-sm-9col-xs-12">



                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Profile</a>
                                    </li>
<!--                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                                    </li>-->
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="    home-tab">
<table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" >User Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Full Name</td>
                                                    <td>{{$users['full_name']}}</td>
                                                </tr>
                                                {{--<tr>--}}
                                                    {{--<td>Last Name</td>--}}
                                                    {{--<td>{{$users['last_name']}}</td>--}}
                                                {{--</tr>--}}
                                                <tr>
                                                    <td>Email Address</td>
                                                    <td>{{$users['email']}}</td>
                                                </tr>
                                                
                                                {{--<tr>--}}
                                                    {{--<td>Address</td>--}}
                                                    {{--<td>{{$users['address'] != '' ? $users['address'] : 'N/A'}}</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td>City</td>--}}
                                                    {{--<td>{{$users['city'] != '' ? $users['city'] : 'N/A'}}</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td>State</td>--}}
                                                    {{--<td>{{$users['state'] != '' ? $users['state'] : 'N/A'}}</td>--}}
                                                {{--</tr>--}}
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>{{$users['phone_number'] != '' ? $users['phone_number'] : 'N/A'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>User Status</td>
                                                    <td>{{$users['status'] == '1' ? 'Active' : 'Inactive'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Created At</td>
                                                    <td>{{ Carbon\Carbon::parse($users['created_at'])->format('d-M-Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Updated At</td>
                                                    <td>{{ Carbon\Carbon::parse($users['updated_at'])->format('d-M-Y H:i:s') }}</td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>

<!--                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                        
                                    </div>-->
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