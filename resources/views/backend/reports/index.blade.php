@extends( 'backend.layouts.app' )

@section('title', 'Reports')

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
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,

            });
        });
    </script>
@endsection

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reports</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                @include( 'backend.layouts.notification_message' )

                <div class="panel panel-default">
                    <!-- <div class="panel-heading">
                        Users
                    </div> -->
                    <!-- /.panel-heading -->

                    @include('backend.layouts.modal')

                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover datatable" id="dataTables-example" data-column-defs='[{"sortable": false, "targets": [-1]}]'>
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Report Type</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th class="w-50">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $reports as $record )
                                <tr class="">
                                    <td>{{ rtrim($record->first_name . ' ' . $record->last_name) }}</td>
                                    <td>{{ $record->report_type }}</td>
                                    <td>{{ $record->date }}</td>
                                    <td>{{ $record->start_time }}</td>
                                    <td>{{ $record->end_time }}</td>
                                    <td>
                                        {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/report/'.$record->id, 'class' =>'form-inline form-delete']) !!}
                                        {!! Form::hidden('id', $record->id) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

@endsection