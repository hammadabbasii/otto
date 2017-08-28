@extends( 'backend.layouts.app' )

@section('title', 'Feedbacks')

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
	

	
    </script>
@endsection

@section('content')


<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Feedbacks</h3>
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
                    <h2>Feedbacks <small>Feedbacks listing</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include( 'backend.layouts.notification_message' )

                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                      <tr>
                        <th>Id</th>
                        <th>User</th>
                        <th>Feedback Message</th>
                        <th>Created On</th>
                        <th>Action</th>
                      </tr>
                      </thead>


                      <tbody>
                      @foreach( $allFeedbacks as $record )
                      
                        <tr class="">

                          <td>{{ $record->id }}</td>
                          <td>
                          <?php
						  	$feedbackPosterId	=	$record->user_id;
							if($feedbackPosterId>0)
							{
								echo $record->user['full_name'];
							}
							else
							{
								echo "Guest";
							}
						  ?>
                          	
                          
                          </td>
                          <td>{{ $record->feedback_message }}</td>
                          <td>{{ $record->created_at }}</td>
                          <?php $currentRecordId	=	$record->id; ?>
                          
                          <td>
                            {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/feedback/'.$record->id, 'class' =>'form-inline form-delete']) !!}
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