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
<script src="{{ backend_asset('libraries/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.js') }}"></script>
@endsection

@section('inlineJS')
<script type="text/javascript">
<!-- Datatable -->
$(document).ready(function () {
    $('#datatable').dataTable();

    $('table[data-form="deleteForm"]').on('click', '.form-delete', function (e) {
        e.preventDefault();
        var $form = $(this);
        $('#confirm').modal({backdrop: 'static', keyboard: false})
                .on('click', '#delete-btn', function () {
                    $form.submit();
                });
    });
});


function ActiVeInActive(TripId)
	{
		//Ajax Call to activate function 
		$.ajax({
		type: "GET",
		url: "/tripcrasher/backend/trips/changeStatus/"+TripId,
		data: {},
			success: function(data)
			{
				if(data=='1' || data ==1)
				{
					 
                    var DataToset	=	'<button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ '+TripId+' }}" data-target=".bs-example-modal-sm">Blocked</button>';
					$('#CurerntStatusDiv'+TripId).html(DataToset);
				}
				else
				{
					var DataToset	=	'<button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ '+TripId+' }}" data-target=".bs-example-modal-sm">Active</button>'
					$('#CurerntStatusDiv'+TripId).html(DataToset);
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
		var TripId = $(this).data('id');
		var footerData	=	'<button type="button" id="CloseButton" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="ActiVeInActive('+TripId+')">Save changes</button>'; 
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
                <h3>Trips <small>Some examples to get you started</small></h3>
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

        @include('backend.layouts.modal')
        @include( 'backend.layouts.popups')
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Trips <small>Trip listing</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @include( 'backend.layouts.notification_message' )


                        <table id="datatable" class="table table-striped table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Trip Name</th>
                                    <td>Creator</td>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Age Bracket</th>
                                    <th>Itinerary</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach( $trips as $record )
                                <tr class="">

                                    <td>{{ $record->id }}</td>
									<td>{{ rtrim($record->trip_name) }}</td>
                                    <td>
                                    	{{ $record->creator['first_name'] }} 
                                        <br />
                                        {{ Html::image($record->creator['profile_picture'] , '', array( 'width' => 50, 'height' => 50 )) }}
                                    </td>
                                    <td>{{ $record->trip_origin }}</td>
                                    <td>{{ $record->trip_destination }}</td>
                                    <td>{{ $record->trip_from }}</td>
                                    <td>{{ $record->trip_to }}</td>
                                    <td>{{ $record->age_bracket }}</td>
                                    <td>{{ $record->itinerary['itinerary_name'] }}</td>
                                    <td>{{ $record->created_at }}</td>
                                    
                                    <?php $currentRecordId	=	$record->id; ?>
                          <td id="CurerntStatusDiv<?php echo $currentRecordId; ?>">

                              @if ($record->status  == 1)
                              <button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Active</button>
                              @else
                                  <button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Blocked</button>
                              @endif


                          </td>
                                    <td>
                                        <a href="{{ backend_url('trip/details/'.$record->id) }}" class="btn btn-primary btn-xs" style="float: left;"><i class="fa fa-folder"></i> View </a>

                                        {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/trip/'.$record->id, 'class' =>'form-inline form-delete']) !!}
                                        {!! Form::hidden('id', $record->id) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i> Delete ', ['class' => 'btn btn-danger btn-xs', 'name' => 'delete_modal','data-toggle' => 'modal']) !!}
                                        {!! Form::close() !!}

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