
<div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
    {{ Form::label('category_name', 'Category Title', ['class'=>'control-label']) }}
    {{ Form::text('category_name', null, ['class' => 'form-control']) }}
    @if ( $errors->has('category_name') )
        <p class="help-block">{{ $errors->first('category_name') }}</p>
    @endif
</div>

<?php 
#echo "hellos".$subcategory->parent_id;die();
?>
<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
    {!! Form::Label('parent_id', 'Parent Category:') !!}
  <select class="form-control" name="parent_id" style="width:auto;">
  
  <?php
  if(isset($subcategory->parent_id))
  {
 	$thisParentId	=	$subcategory->parent_id;
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

<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('user'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>

<style> 
#category_name{
	width:auto;
	}

</style>

