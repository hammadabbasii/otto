<?php 


$adminRightsObject	=	array();
$adminRightsObject['category']	=	0;
$adminRightsObject['product']	=	0;
$adminRightsObject['user']	=	0;
$adminRightsObject['cms']	=	0;
$adminRightsObject['noti']	=	0;

 if(isset($admin->rights))
 {
	$adminRightsString	= 	 $admin->rights;
	$adminRightsArray	 =	explode(",",$adminRightsString);
	
	#print_r($adminRightsArray);die();
	if(in_array("category",$adminRightsArray))
	{
		$adminRightsObject['category']	=	1;
	}
	
	if(in_array("product",$adminRightsArray))
	{
		$adminRightsObject['product']	=	1;
	}
	
	if(in_array("user",$adminRightsArray))
	{
		$adminRightsObject['user']	=	1;
	}
	
	if(in_array("cms",$adminRightsArray))
	{
		$adminRightsObject['cms']	=	1;
	}
	
	if(in_array("noti",$adminRightsArray))
	{
		$adminRightsObject['noti']	=	1;
	}
	
 }
 
$adminRightsObject 	=	(object)$adminRightsObject; 
?>
{{--
<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    {{ Form::label('first_name', 'First Name', ['class'=>'control-label']) }}
    {{ Form::text('first_name', null, ['class' => 'form-control']) }}
    @if ( $errors->has('first_name') )
        <p class="help-block">{{ $errors->first('first_name') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    {{ Form::label('last_name', 'Last Name', ['class'=>'control-label']) }}
    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control']) }}
    @if ( $errors->has('last_name') )
        <p class="help-block">{{ $errors->first('last_name') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {{ Form::label('email', 'Email', ['class'=>'control-label']) }}
    {{ Form::email('email', null, ['class' => 'form-control']) }}
    @if ( $errors->has('email') )
        <p class="help-block">{{ $errors->first('email') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {{ Form::label('password', 'Password', ['class'=>'control-label']) }}
    {{ Form::password('password', ['class' => 'form-control']) }}
    @if ( $errors->has('password') )
        <p class="help-block">{{ $errors->first('password') }}</p>
    @endif
</div>




{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{{ Html::link( backend_url('admin'), 'Cancel', ['class' => 'btn btn-default']) }}--}}


<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
        {{ Form::label('first_name', 'First Name *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                 {{ Form::text('first_name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('first_name') )
                <p class="help-block">{{ $errors->first('first_name') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
        {{ Form::label('last_name', 'Last Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('last_name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('last_name') )
                <p class="help-block">{{ $errors->first('last_name') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {{ Form::label('email', 'Email', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('email', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('email') )
                <p class="help-block">{{ $errors->first('email') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        {{ Form::label('password', 'Password', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::password('password',['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('password') )
                <p class="help-block">{{ $errors->first('password') }}</p>
        @endif
</div>


<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        {{ Form::label('Rights', 'Rights', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
        <br />
                {{ Form::checkbox('rights[]', 'category', $adminRightsObject->category) }} Categories  <br />
                {{ Form::checkbox('rights[]', 'product', $adminRightsObject->product) }} Products  <br />
                {{ Form::checkbox('rights[]', 'user', $adminRightsObject->user) }} Users  <br />
                {{ Form::checkbox('rights[]', 'cms', $adminRightsObject->cms) }} CMS Pages  <br />
                {{ Form::checkbox('rights[]', 'noti', $adminRightsObject->noti) }} Notification  <br />
        </div>
        
</div>


<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('admin'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>

