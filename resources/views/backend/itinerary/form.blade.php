
<div class="form-group{{ $errors->has('itinerary_name') ? ' has-error' : '' }}">
        {{ Form::label('itinerary_name', 'Itinerary Title *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                 {{ Form::text('itinerary_name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('itinerary_name') )
                <p class="help-block">{{ $errors->first('itinerary_name') }}</p>
        @endif
</div>


<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('user'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>

