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
                <h3>Users <small>Some examples to get you started</small></h3>
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

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Users <small>User listing</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include( 'backend.layouts.notification_message' )

                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                      <tr>
                        <th>Id</th>
                        <th>Picture</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      </thead>


                      <tbody>
                      @foreach( $users as $record )
                        <tr class="">

                          <td>{{ $record->id }}</td>
                          <td>{{ $record->profile_picture }}</td>
                          <td>{{ rtrim($record->first_name) }}</td>
                          <td>{{ $record->last_name }}</td>
                          <td>{{ $record->email }}</td>
                          <td>{{ $record->phone }}</td>
                          <td>{{ $record->status }}</td>
                          <td>
                            <a href="{{ backend_url('user/edit/'.$record->id) }}" class="btn btn-xs btn-primary edit" style="float: left;"><i class="fa fa-pencil"></i></a>

                            {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/user/'.$record->id, 'class' =>'form-inline form-delete']) !!}
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