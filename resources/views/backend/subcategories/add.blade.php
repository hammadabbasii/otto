@extends( 'backend.layouts.app' )

@section('title', 'Add Sub Category')

@section('content')
<?php
#print_r($category);die();
?>


    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Add Sub Category</h3>
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
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">

                        @if ( $errors->count() )
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                There was an error while saving your form, please review below.
                            </div>
                        @endif

                        @include( 'backend.layouts.notification_message' )

                        <div class="x_title">
                            <h2>Form Design <small>different form elements</small></h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                        </div>

                        {!! Form::open( ['url' => ['backend/subcategories/create'], 'method' => 'POST', 'files' => true , 'class' => 'form-horizontal form-label-left', 'role' => 'form']) !!}
                        @include( 'backend.subcategories.form' )
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /page content -->


    {{--<div class="row">
        <div class="col-lg-6">
            {!! Form::model($subcategory, ['url' => ['backend/subcategory', $subcategory->id], 'method' => 'PUT', 'class' => '', 'role' => 'form']) !!}
                @include( 'backend.subcategory.form' )
            {!! Form::close() !!}
        </div>
    </div>--}}


    <!-- /#page-wrapper -->


@endsection
