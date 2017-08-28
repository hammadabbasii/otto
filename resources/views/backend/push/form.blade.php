
<div class="form-group{{ $errors->has('devicetype') ? ' has-error' : '' }}">
        {{ Form::label('Platfoem', 'Platform *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                 {{ Form::select('devicetype', ['android' => 'Android', 'ios' => 'iOS', 'all' => 'All'],null, ['class' => 'form-control col-md-7 col-xs-12','onchange' => 'showUserList(this.value)'] ) }}
        </div>
        @if ( $errors->has('key') )
                <p class="help-block">{{ $errors->first('key') }}</p>
        @endif
</div>


<div class="form-group{{ $errors->has('uids') ? ' has-error' : '' }}" >
        {{ Form::label('User', 'Users List *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div id="userCheckbox" class="col-md-6 col-sm-6 col-xs-12" style="border:2px solid #ddd;"> User List Will display here ... </div>
        </div>

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {{ Form::label('title', 'Title *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('title', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('title') )
                <p class="help-block">{{ $errors->first('title') }}</p>
        @endif
</div>


<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
        {{ Form::label('message', 'Message *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('message', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('title') )
                <p class="help-block">{{ $errors->first('message') }}</p>
        @endif
</div>



<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Send', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('push/send'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>

