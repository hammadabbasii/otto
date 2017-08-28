<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {{ Form::label('name', 'Brand Name *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                 {{ Form::text('name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('name') )
                <p class="help-block">{{ $errors->first('name') }}</p>
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



<div class="form-group{{ $errors->has('caetgory_id') ? ' has-error' : '' }}">
        {{ Form::label('category_id', 'Category *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
        <select class="form-control" name="caetgory_id" style="width:auto;">
  
  <?php
  if(isset($brand->category_id))
  {
 	$thisParentId	=	$brand->category_id;
  	foreach($category as $item)
	{
		$thisCategoryId	=	$item->id;
		if($thisCategoryId == $thisParentId)
		{
			echo '<option value="'.$item->id.'" selected>'.$item->category_name.'</option>';
		}
		else
		{
  			echo '<option value="'.$item->id.'">'.$item->category_name.'</option>';
		}
	}
  }
  else 
  foreach($category as $item)
	{
		
  		echo '<option value="'.$item->id.'">'.$item->category_name.'</option>';
	}
  	
  ?>

  </select>
  		</div>
</div>




<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('brand'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>


