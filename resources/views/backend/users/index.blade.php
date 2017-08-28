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


function ActiVeInActive(UserId)
	{
		//Ajax Call to activate function 
		$.ajax({
		type: "GET",
		url: "/smartmart/backend/user/changeStatus/"+UserId,
		data: {},
			success: function(data)
			{
				if(data=='1' || data ==1)
				{
					 
                    var DataToset	=	'<button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ '+UserId+' }}" data-target=".bs-example-modal-sm">Blocked</button>';
					$('#CurerntStatusDiv'+UserId).html(DataToset);
				}
				else
				{
					var DataToset	=	'<button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ '+UserId+' }}" data-target=".bs-example-modal-sm">Active</button>'
					$('#CurerntStatusDiv'+UserId).html(DataToset);
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
		var footerData	=	'<button type="button" id="CloseButton" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="ActiVeInActive('+UserId+')">Save changes</button>'; 
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
                <h3>Users <small>User Listing</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    
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
                        <h2>Users <small>User listing</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @include( 'backend.layouts.notification_message' )


                        <table id="datatable" class="table table-striped table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Picture</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach( $users as $record )
                                <tr class="">

                                    <td>{{ $record->id }}</td>

                                    <td>{{ Html::image('public/images/users/'.$record->profile_picture , '', array( 'width' => 70, 'height' => 70 )) }}</td>
                                    <td>{{ rtrim($record->full_name) }}</td>
                                    <td>{{ $record->phone_number }}</td>
                                    <td>{{ $record->email }}</td>
                                    <?php $currentRecordId	=	$record->id; ?>
                          <td id="CurerntStatusDiv<?php echo $currentRecordId; ?>">

                              @if ($record->status  == 1)
                              <button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Active</button>
                              @else
                                  <button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Blocked</button>
                              @endif


                          </td>
                                    <td>
                                        <a href="{{ backend_url('user/profile/'.$record->id) }}" class="btn btn-primary btn-xs" style="float: left;"><i class="fa fa-folder"></i> View </a>
                                        <a href="{{ backend_url('user/edit/'.$record->id) }}" class="btn btn-info btn-xs edit" style="float: left;"><i class="fa fa-pencil"></i> Edit </a>

                                        {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/user/'.$record->id, 'class' =>'form-inline form-delete']) !!}
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