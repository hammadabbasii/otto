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

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    {{ Form::label('phone', 'Phone', ['class'=>'control-label']) }}
    {{ Form::text('phone', null, ['class' => 'form-control']) }}
    @if ( $errors->has('phone') )
        <p class="help-block">{{ $errors->first('phone') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
    {{ Form::label('company_name', 'Company Name', ['class'=>'control-label']) }}
    {{ Form::text('company_name', null, ['class' => 'form-control']) }}
    @if ( $errors->has('company_name') )
        <p class="help-block">{{ $errors->first('company_name') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    {{ Form::label('address', 'Address', ['class'=>'control-label']) }}
    {{ Form::text('address', null, ['class' => 'form-control']) }}
    @if ( $errors->has('address') )
        <p class="help-block">{{ $errors->first('address') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    {{ Form::label('city', 'City', ['class'=>'control-label']) }}
    {{ Form::text('city', null, ['class' => 'form-control']) }}
    @if ( $errors->has('city') )
        <p class="help-block">{{ $errors->first('city') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
    {{ Form::label('state', 'State', ['class'=>'control-label']) }}
    {{ Form::text('state', null, ['class' => 'form-control']) }}
    @if ( $errors->has('state') )
        <p class="help-block">{{ $errors->first('state') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
    {{ Form::label('country', 'Country', ['class'=>'control-label']) }}
    {{ Form::text('country', null, ['class' => 'form-control']) }}
    @if ( $errors->has('country') )
        <p class="help-block">{{ $errors->first('country') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
    {{ Form::label('postal_code', 'Postal Code', ['class'=>'control-label']) }}
    {{ Form::text('postal_code', null, ['class' => 'form-control']) }}
    @if ( $errors->has('postal_code') )
        <p class="help-block">{{ $errors->first('postal_code') }}</p>
    @endif
</div>

{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{{ Html::link( backend_url('user'), 'Cancel', ['class' => 'btn btn-default']) }}--}}


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


<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
        {{ Form::label('Gender', 'Gender', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                <div id="gender" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
                        </label>
                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="gender" value="female"> Female
                        </label>
                </div>
        </div>
</div>

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        {{ Form::label('address', 'Address', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('address', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('address') )
                <p class="help-block">{{ $errors->first('address') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
        {{ Form::label('city', 'City', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('city', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('city') )
                <p class="help-block">{{ $errors->first('city') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
        {{ Form::label('state', 'State', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('state', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('state') )
                <p class="help-block">{{ $errors->first('state') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
        {{ Form::label('country', 'Country', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('country', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('country') )
                <p class="help-block">{{ $errors->first('country') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
        {{ Form::label('postal_code', 'Postal code', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('postal_code', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('postal_code') )
                <p class="help-block">{{ $errors->first('postal_code') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
        {{ Form::label('phone_no', 'Phone no', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('phone_no', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('phone_no') )
                <p class="help-block">{{ $errors->first('phone_no') }}</p>
        @endif
</div>

<div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
        {{ Form::label('company_name', 'Company name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('company_name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('company_name') )
                <p class="help-block">{{ $errors->first('company_name') }}</p>
        @endif
</div>




<div class="form-group{{ $errors->has('profile_picture') ? ' has-error' : '' }}">
        {{ Form::label('profile_picture', 'Profile picture', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::file('profile_picture', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('profile_picture') )
                <p class="help-block">{{ $errors->first('profile_picture') }}</p>
        @endif
</div>


<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('user'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>

