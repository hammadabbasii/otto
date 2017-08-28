@extends( 'backend.layouts.app' )

@section('title', 'Add New Cms Page')


@section('JSLibraries')
<script src="{{ backend_asset('libraries/tinymce/js/tinymce/tinymce.min.js') }}"></script>

@endsection


@section('inlineJS')

    <script>tinymce.init({ selector:'textarea' });

    function showUserList(devicetype){


        var userId, brandTitle ;
        var userCheckbox = '';
        $.ajax({
            type: "GET",
            async: false,
            dataType: "json",
            url: 'http://10.1.18.150/mobiles/api/users',
            data: {device_type:devicetype},
            success:
                    function(data) {


                        userCheckbox += ' <div class="checkbox" style="float: left;width:30%">';
                        userCheckbox += ' <label>';
                        userCheckbox += '  <input type="checkbox" class="flat" onchange="checkUncheckAll(this.checked)">All';
                        userCheckbox += ' </label>';
                        userCheckbox += ' </div>';

                        var result				= data['body'];
                        var totalRecords		= data['body'].length;

                        if(totalRecords > 0 ) {
                            for(i=0; i <totalRecords; i++)
                            {
                               // userCheckbox += '<div class="col-md-9 col-sm-9 col-xs-12">';
                                userCheckbox += ' <div class="checkbox" style="float: left;width:30%">';
                                userCheckbox += ' <label>';
                                userCheckbox += ' <input type="checkbox" name="uids[]" value="'+result[i]['id']+'" class="flat">'+result[i]['first_name'];
                                userCheckbox += ' </label>';
                                userCheckbox += ' </div>';

                            }
                        }

                    }
        });
        $('#userCheckbox').html(userCheckbox);
    }

    function checkUncheckAll(value) {

alert(value);
        if(value==true){
            $('input:checkbox').attr('checked','checked');
           // $(this).val('uncheck all')
        } else {
            $('input:checkbox').removeAttr('checked');
            //$(this).val('check all');
        }

        //$('#userCheckbox').find('input[type=checkbox]:checked').removeAttr('checked');
    }

        $( document ).ready(function() {  showUserList('android'); });
    </script>

@endsection

@section('content')



    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Push Notification</h3>
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
                            <h2>Send Push Notification to users -  <small></small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                        </div>

                        {!! Form::open( ['url' => ['backend/push/sendpush'], 'method' => 'POST', 'class' => 'form-horizontal form-label-left', 'role' => 'form']) !!}
                        @include( 'backend.push.form' )
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /page content -->


    {{--<div class="row">
        <div class="col-lg-6">
            {!! Form::model($user, ['url' => ['backend/user', $user->id], 'method' => 'PUT', 'class' => '', 'role' => 'form']) !!}
                @include( 'backend.users.form' )
            {!! Form::close() !!}
        </div>
    </div>--}}


    <!-- /#page-wrapper -->


@endsection
