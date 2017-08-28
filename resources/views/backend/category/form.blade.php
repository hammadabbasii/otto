<div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
        {{ Form::label('category_name', 'Category Name *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                 {{ Form::text('category_name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('category_name') )
                <p class="help-block">{{ $errors->first('category_name') }}</p>
        @endif
</div>


<div class="form-group{{ $errors->has('profile_picture') ? ' has-error' : '' }}">
        {{ Form::label('image', 'image', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::file('image', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('image') )
                <p class="help-block">{{ $errors->first('image') }}</p>
        @endif
</div>


<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('category'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>


