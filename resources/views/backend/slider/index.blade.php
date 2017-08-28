@extends( 'backend.layouts.app' )

@section('title', 'Slider')

@section('CSSLibraries')
        <!-- DataTables CSS -->
<link href="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
<link href="{{ backend_asset('libraries/galleria/colorbox.css') }}" rel="stylesheet">
@endsection

@section('JSLibraries')
        <!-- DataTables JavaScript -->
<script src="{{ backend_asset('libraries/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ backend_asset('libraries/galleria/jquery.colorbox.js') }}"></script>
@endsection

@section('inlineJS')
    <script type="text/javascript">
        <!-- Datatable -->
        $(document).ready(function () {

            $('#datatable').dataTable();
            $(".group1").colorbox({width:"50%", height:"50%"});

            $(document).on('click', '.status_change', function(e){
                var Uid = $(this).data('id');

                $.confirm({
                    title: 'A secure action',
                    content: 'Are you sure you want to change status ??',
                    icon: 'fa fa-question-circle',
                    animation: 'scale',
                    closeAnimation: 'scale',
                    opacity: 0.5,
                    buttons: {
                        'confirm': {
                            text: 'Proceed',
                            btnClass: 'btn-info',
                            action: function () {

                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo URL::to('/'); ?>/api/changeUserStatus/"+Uid,
                                    data: {},
                                    success: function(data)
                                    {
                                        if(data.Result.status == '0' )
                                        {
                                            var DataToset	=	'<button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="'+Uid+'" data-target=".bs-example-modal-sm">Blocked</button>';
                                            $('#CurerntStatusDiv'+Uid).html(DataToset);
                                        }
                                        else
                                        {
                                            var DataToset	=	'<button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="'+Uid+'" data-target=".bs-example-modal-sm">Active</button>'
                                            $('#CurerntStatusDiv'+Uid).html(DataToset);
                                        }
                                    }
                                });

                            }
                        },
                        cancel: function () {
                            //$.alert('you clicked on <strong>cancel</strong>');
                        }
                    }
                });
            });

            $(document).on('click', '.form-delete', function(e){

                var $form = $(this);
                $.confirm({
                    title: 'A secure action',
                    content: 'Are you sure you want to delete slider Image ??',
                    icon: 'fa fa-question-circle',
                    animation: 'scale',
                    closeAnimation: 'scale',
                    opacity: 0.5,
                    buttons: {
                        'confirm': {
                            text: 'Proceed',
                            btnClass: 'btn-info',
                            action: function () {
                                $form.submit();
                            }
                        },
                        cancel: function () {
                            //$.alert('you clicked on <strong>cancel</strong>');
                        }
                    }
                });
            });

        });

    </script>
@endsection

@section('content')


    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Slider <small>Listing of all slider images</small></h3>
                </div>


            </div>

            <div class="clearfix"></div>

            {{--@include('backend.layouts.modal')--}}

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Slider <small> Slider Images listing</small></h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            @include( 'backend.layouts.notification_message' )

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Slider Images</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach( $slider as $record )
                                    <tr class="">
                                        <td>{{ rtrim($record->id) }}</td>
                                        <td><a class="group1" href="{{ URL::to('/') }}/public/images/slider/{{$record->slider_images}}" >
                                                <img style="width:50px;height: 50px;" src="{{ URL::to('/') }}/public/images/slider/{{$record->slider_images}}" /></a></td>
                                        <td>
                                            <a href="{{ backend_url('slider/edit/'.$record->id) }}" class="btn btn-xs btn-primary edit" style="float: left;"><i class="fa fa-pencil"></i></a>

                                            {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/slider/'.$record->id, 'class' =>'form-inline form-delete']) !!}
                                            {!! Form::hidden('id', $record->id) !!}
                                            {!! Form::button('<i class="fa fa-trash-o"></i>  ', ['class' => 'btn btn-danger btn-xs', 'name' => 'delete_modal','data-toggle' => 'modal']) !!}
                                            {!! Form::close() !!}
                                            {{--check--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection