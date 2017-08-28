@extends( 'backend.layouts.app' )

@section('title', 'Product')

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
	
	function ActiVeInActive(ProductId)
	{
		//Ajax Call to activate function 
		$.ajax({
		type: "GET",
		url: "/mobiles/backend/product/changeStatus/"+ProductId,
		data: {},
			success: function(data)
			{
				if(data=='1' || data ==1)
				{
					 
                    var DataToset	=	'<button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ '+ProductId+' }}" data-target=".bs-example-modal-sm">Blocked</button>';
					$('#CurerntStatusDiv'+ProductId).html(DataToset);
				}
				else
				{
					var DataToset	=	'<button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ '+ProductId+' }}" data-target=".bs-example-modal-sm">Active</button>'
					$('#CurerntStatusDiv'+ProductId).html(DataToset);
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
		var ProductId = $(this).data('id');
		var footerData	=	'<button type="button" id="CloseButton" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="ActiVeInActive('+ProductId+')">Save changes</button>'; 
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
                <h3>Product <small>Some examples to get you started</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
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
                    <h2>Product <small>Product listing</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include( 'backend.layouts.notification_message' )

                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                      <tr>
                        <th>Id</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Detail</th>
                        <th>price</th>
                        <th>Status</th>
                        <th>quantity</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                      </thead>


                      <tbody>
                      @foreach( $product as $record )
                        <tr class="">

                          <td>{{ $record->id }}</td>
                          <td><img width="250" src="{{ $record->product_image }}" /></td>
                          <td>{{ $record->product_name }}</td>
                          <td>{{ $record->product_description }}</td>
                          <td>{{ $record->price }}</td>
                           <?php $currentRecordId	=	$record->id; ?>
                          <td id="CurerntStatusDiv<?php echo $currentRecordId; ?>">

                              @if ($record->status  == 1)
                              <button type="button" class="btn btn-success btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Active</button>
                              @else
                                  <button type="button" class="btn btn-warning btn-xs status_change" data-toggle="modal" data-id="{{ $record->id }}" data-target=".bs-example-modal-sm">Blocked</button>
                              @endif


                          </td>
                          <td>{{ $record->quantity }}</td>
                          <td>{{ $record->created_at }}</td>
                          <td>
                            <a href="{{ backend_url('product/edit/'.$record->id) }}" class="btn btn-xs btn-primary edit" style="float: left;"><i class="fa fa-pencil"></i></a>

                            {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/product/'.$record->id, 'class' =>'form-inline form-delete']) !!}
                            {!! Form::hidden('id', $record->id) !!}
                            {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal', 'type' => 'submit']) !!}
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