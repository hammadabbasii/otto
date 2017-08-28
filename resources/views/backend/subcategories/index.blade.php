@extends( 'backend.layouts.app' )

@section('title', 'Categories')

@section('CSSLibraries')
    <!-- DataTables CSS -->
    <link href="{{ backend_asset('libraries/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="{{ backend_asset('libraries/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
    <!-- Image Viewer CSS -->
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
        $(document).ready(function() {
            $('#datatable').dataTable();
            $(".group1").colorbox({height:"75%"});

        });

    </script>
@endsection

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Sub Categories</h3>
            </div>

        </div>

        <div class="clearfix"></div>

        {{--@include('backend.layouts.modal')--}}

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sub Categories <small>Categories listing</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @include( 'backend.layouts.notification_message' )

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Parent Category</th>
                                @if(Auth::user()->is_subadmin == 'admin')
                                <th>Seller name</th>
                                @endif
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php   $categoriesArray	=	array();
                            foreach( $categories as $record )
                            {
                                $currentCategoryId	=	$record->id;
                                $categoriesArray[$currentCategoryId]	=	$record->name;
                            }
                            //dd($subcategories);
                            ?>

                            @foreach( $subcategories as $record )
                                <?php $parentId	=	$record->parent_id; ?>
                                {{--@if($record->parent_id > 0)--}}
                                    <tr class="">

                                        <td>{{ $record->id }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td><a class="group1" href="{{ URL::to('/') }}/public/images/categories/{{$record->image}}" >
                                                <img style="width:70px" src="{{ URL::to('/') }}/public/images/categories/{{$record->image}}" /></a>
                                        </td>
                                        <td>{{ $categoriesArray[$parentId] }}</td>
                                        @if(Auth::user()->is_subadmin == 'admin')
                                            <td>{{$record->EntityDetail->name}}</td>
                                        @endif
                                        <td>
                                            <a href="{{ backend_url('subcategories/edit/'.$record->id) }}" class="btn btn-xs btn-primary edit" style="float: left;"><i class="fa fa-pencil"></i></a>

                                            {!! Form::model($record, ['method' => 'delete', 'url' => 'backend/subcategories/'.$record->id, 'class' =>'form-inline form-delete']) !!}
                                            {!! Form::hidden('id', $record->id) !!}
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal', 'type' => 'submit']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                {{--@endif--}}
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