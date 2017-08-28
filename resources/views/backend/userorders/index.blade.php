@extends( 'backend.layouts.app' )

@section('title', 'Order')

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

function updateStatus(id , status)
	{
		
        var new_status =  $('#status').val();
		$('#CurerntStatusDiv'+id).html(new_status);
		$('#CurerntStatusDiv'+id).css('textTransform', 'capitalize');

		//alert(id+" - - "+new_status);return false;
        //alert(new_status);

		//Ajax Call to activate function
		$.ajax({
		type: "POST",
		url: '/portfolio/smartmart/api/order/changeOrderStatus',
		data: {id:id,status:new_status},
			success: function(data)
			{
				if(data.Response=='2000' || data.Response ==2000)
				{
					 var $statusClass, statusText ;

                    if (new_status  == 'published') {  statusClass = 'btn-success'; statusText = 'Published'; }
                    else if (new_status  == 'reserved') { statusClass = 'btn-danger' ; statusText = 'Reserved'; }
                    else if (new_status  == 'self_reserved') { statusClass = 'btn-warning' ; statusText = 'Self Reserved'; }

                    var DataToset	='<button type="button" class="btn '+statusClass+'  btn-xs status_change" data-toggle="modal" data-id="+id+" data-status="+new_status+" data-target=".bs-example-modal-sm">'+statusText+'</button>';

					$('#vehStatus'+id).html(DataToset);
				}

			}
		});



		$('#CloseButton').trigger('click');

	}

function updateDelivery(id)
	{


        var delivery_datetime =  $('#delivery_datetime').val();
		
		//alert(id+" - - "+new_status);return false;
        //alert(new_status);

		//Ajax Call to activate function
		$.ajax({
		type: "POST",
		url: '/smartmartapp/api/order/changeOrderDelivery',
		data: {id:id,delivery_datetime:delivery_datetime},
			success: function(data)
			{
				if(data.Response=='2000' || data.Response ==2000)
				{
					
				}

			}
		});



		$('#CloseButton').trigger('click');

	}
	
function changeOrderDelivery(id,delivery_datetime){

        $('#popup_heading').html('Change Order Delivery');
        var popupBody = '<div class="form-group">';
            popupBody += '<label for="Select Status " class="control-label">Select Status *</label>';
   			popupBody += '<input type="text" name="delivery_datetime" id="delivery_datetime" value="'+delivery_datetime+'">';
            popupBody += '<input type="hidden" name="id" id="id" value="'+id+'">';
            popupBody += '</div>';

        $('#popup_body').html(popupBody);
        $('#status').val(status);
        var footerData	=	'<button type="button" id="CloseButton" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="updateDelivery('+id+')">Save</button>';
        $('#PopupFooter').html(footerData);

    }
    function changeOrderStatus(id,status) {

        $('#popup_heading').html('Change Order Status');
        var popupBody = '<div class="form-group">';
            popupBody += '<label for="Select Status " class="control-label">Select Status *</label>';
            popupBody += '<select class="form-control" name="status" id="status">';
            //popupBody += '<option value="delivered">Delivered</option>';
            popupBody += '<option value="completed">Completed</option>';
            popupBody += '<option value="pending">Pending</option>';
            popupBody += '</select>';
            popupBody += '<input type="hidden" name="id" id="id" value="'+id+'">';
            popupBody += '</div>';

        $('#popup_body').html(popupBody);
        $('#status').val(status);
        var footerData	=	'<button type="button" id="CloseButton" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="updateStatus('+id+',\'' + status + '\')">Save</button>';
        $('#PopupFooter').html(footerData);

    }
	
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


function ActiVeInActive(OrderId)
	{
		//Ajax Call to activate function 
		$.ajax({
		type: "GET",
		url: "/smartmart/backend/userorders/changeStatus/"+OrderId,
		data: {},
			success: function(data)
			{
				if(data=='1' || data ==1)
				{
					 
                    var DataToset	=	'<button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ '+OrderId+' }}" data-target=".bs-example-modal-sm">Blocked</button>';
					$('#CurerntStatusDiv'+OrderId).html(DataToset);
				}
				else
				{
					var DataToset	=	'<button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ '+OrderId+' }}" data-target=".bs-example-modal-sm">Active</button>'
					$('#CurerntStatusDiv'+OrderId).html(DataToset);
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
		var OrderId = $(this).data('id');
		var footerData	=	'<button type="button" id="CloseButton" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="ActiVeInActive('+OrderId+')">Save changes</button>'; 
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
                <h3>Orders</h3>
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
                        <h2>Orders <small>Order listing</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @include( 'backend.layouts.notification_message' )


                        <table id="datatable" class="table table-striped table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Total Items</th>
                                    <th>Total Amount</th>
                                    <!--<th>Discount</th>
                                    <th>Final Amount</th>-->
                                    <!--<th>Address</th>-->
                                    <th>Status</th>
									<th>Created On</th>
                                    <!--<th>Updated On</th>-->
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach( $userorders as $record )
                                <tr class="">

                                    <td>{{ $record->id }}</td>
                                    <td>
                                    	{{ $record->creator['first_name'] }} 
                                        <br />
                                        {{ Html::image($record->creator['profile_picture'] , '', array( 'width' => 50, 'height' => 50 )) }}
                                    </td>
                                    <td>{{ count(explode(",",$record->items_ids)) }}</td>
                                    <td>{{ $record->total_amount }}</td>
                                    <!--<td>{{ $record->discount }}</td>
                                    <td>{{ $record->final_amount }}</td>-->
                                    <!--<td>{{ $record->shipped_to_address }}</td>-->
                                   
                                    
                                    <?php $currentRecordId	=	$record->id; ?>
                          <td id="CurerntStatusDiv<?php echo $currentRecordId; ?>">

                              {{ucfirst($record->status)}}


                          </td>
                          
                            <td>{{ $record->created_at }}</td>
                            <!-- <td>{{ $record->updated_at }}</td>-->
                                    
                                    <td>
                                     	<a data-toggle="modal" data-target=".bs-example-modal-sm" onclick="changeOrderStatus('{{ $record->id }}','{{ $record->status }}')" href="javascript:;" class="btn btn-primary btn-xs" style="float: left;"><i class="fa fa-folder"></i> Change Status </a>
                                        <a href="{{ backend_url('userorder/details/'.$record->id) }}" class="btn btn-primary btn-xs" style="float: left;"><i class="fa fa-folder"></i> View </a>
                                        <!--<button onclick="changeOrderStatus('{{ $record->id }}','{{ $record->status }}')" type="button" class="btn btn-xs " data-toggle="modal" data-target=".bs-example-modal-sm"> Change Status</button>-->
                                        
                                        <!--<button onclick="changeOrderDelivery('{{ $record->id }}','{{ $record->delivery_datetime }}')" type="button" class="btn btn-xs " data-toggle="modal" data-target=".bs-example-modal-sm"> Change Delivery</button>-->

                                        {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/userorder/'.$record->id, 'class' =>'form-inline form-delete']) !!}
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