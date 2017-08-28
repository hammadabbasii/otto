@extends( 'backend.layouts.app' )

@section('title', 'Itinerary')

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
<script type="text/javascript">
<!-- Datatable -->
$(document).ready(function() {
        $('#datatable').dataTable();
});

function ActiVeInActive(UserId)
{
        //Ajax Call to activate function 
        $.ajax({
        type: "GET",
                url: "/tripcrasher/backend/itinerary/changeStatus/" + UserId,
                data: {},
success: function(data)
{
                        if (data == '1' || data == 1)
                {

                var DataToset = '<button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ ' + UserId + ' }}" data-target=".bs-example-modal-sm">Blocked</button>';
                $('#CurerntStatusDiv' + UserId).html(DataToset);
}
else
{
                        var DataToset = '<button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ ' + UserId + ' }}" data-target=".bs-example-modal-sm">Active</button>'
                        $('#CurerntStatusDiv' + UserId).html(DataToset);
                }
                }
                });
                


$('#CloseButton').trigger('click');
                        
                        }
                $(document).ready(function() {

                        $(".status_change").click(function(){
                $('#popup_heading').html('Confirmation');
                var popupBody = '<p>Are you sure you want the change status</p>';
                                    $('#popup_body').html(popupBody);
                                    var UserId = $(this).data('id');
                                    var footerData = '<button type="button" id="CloseButton" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="ActiVeInActive(' + UserId + ')">Save changes</button>';
                                    $('#PopupFooter').html(footerData);

	
		

  });

});
	
</script>
@endsection

@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Itinerary </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        {{--@include('backend.layouts.modal')--}}
        @include( 'backend.layouts.popups')

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><small>Itinerary listing</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @include( 'backend.layouts.notification_message' )

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Itinerary Name</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach( $itinerary as $record )
                                @if($record->parent_id == 0)

                                <tr class="">

                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->itinerary_name }}</td>
                                    <td>{{ $record->created_at }}</td>
                                    <?php $currentRecordId = $record->id; ?>
                                    <td id="CurerntStatusDiv<?php echo $currentRecordId; ?>">

                                        @if ($record->status  == '1')
                                        <button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Active</button>
                                        @else
                                        <button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Blocked</button>
                                        @endif


                                    </td>
                                    <td>
                                        <a href="{{ backend_url('itinerary/edit/'.$record->id) }}" class="btn btn-xs btn-primary edit" style="float: left;"><i class="fa fa-pencil"></i></a>

                                        {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/itinerary/'.$record->id, 'class' =>'form-inline form-delete']) !!}
                                        {!! Form::hidden('id', $record->id) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endif  
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