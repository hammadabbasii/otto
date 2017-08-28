<?php
$getSellerId = 0;
$getParentId = 0;

if(isset($getEntities)){
	$getSellerId = $getEntities[0]->id ;

}
if(isset($subcategory)){

	$getParentId = $subcategory->parent_id ;
	$getSellerId = $subcategory->entity_id ;
}


?>

@section('inlineJS')
<script>
	$( document ).ready(function() {

		$('#getSellerCategory').on('change', function(e){
			var categoryId    = $('#getSellerCategory').val();
			getSellerCategories(categoryId,'');
		});

		<?php if($getSellerId> 0){?>
        getSellerCategories('<?php echo $getSellerId; ?>','<?php echo $getParentId;?>');
		<?php }?>

		function getSellerCategories(sellerId,parId){

			var modelsSelectbox ='';
			$.ajax({
				type: "GET",
				async: false,
				dataType: "json",
				url: '<?php echo URL::to('/');?>/api/getSellerCategories/'+sellerId,
				data: {},
				success:
						function(data) {

							var result				= data['Result'];
							var totalRecords		= data['Result'].length;

							modelsSelectbox += ' <option value="0" class="flat">Select</option>';
							if(totalRecords > 0 ) {
								for(i=0; i <totalRecords; i++)
								{
									showselected = '';
									if(parId == result[i]['id']) { showselected = 'selected'; }
									modelsSelectbox += ' <option value="'+result[i]['id']+'" '+showselected+' class="flat">'+result[i]['name']+'</option>';
								}
							}
						}
			});

			$('#getCategory').html(modelsSelectbox);
		}

	});
</script>
@endsection

<?php if(Auth::user()->is_subadmin == 'admin'){?>
<div class="form-group{{ $errors->has('entity_id') ? ' has-error' : '' }}">
	{{ Form::label('entity_id', 'Seller Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
	<div id="model_id" class="col-md-6 col-sm-6 col-xs-12">
		<select class="form-control col-md-7 col-xs-12" id="getSellerCategory" name="entity_id">
			<?php foreach($getEntities as $entities){ ?>
			<option <?php if($entities->id == $getSellerId){ echo "selected";}?> value="<?php echo $entities->id;?>"><?php echo $entities->name;?></option>
			<?php } ?>
		</select>
	</div>
	@if ( $errors->has('entity_id') )
		<p class="help-block">{{ $errors->first('entity_id') }}</p>
	@endif
</div>


<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
	{{ Form::label('parent_id', 'Parent Category  *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
	<div class="col-md-6 col-sm-6 col-xs-12">
		{{ Form::select('parent_id',  array('0' => 'Select'),null, ['class' => 'form-control col-md-7 col-xs-12 ','id'=>'getCategory']) }}
	</div>
	@if ( $errors->has('parent_id') )
		<p class="help-block">{{ $errors->first('parent_id') }}</p>
	@endif
</div>

<?php }else{?>



<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
    {!! Form::Label('parent_id', 'Parent Category:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
	<div class="col-md-6 col-sm-6 col-xs-12">
	<select class="form-control col-md-7 col-xs-12" name="parent_id" >
		<option>Select</option>
  
  <?php
  if(isset($subcategory->parent_id))
  {
 	$thisParentId	=	$subcategory->parent_id;
  	foreach($category as $item)
	{
		$thisCategoryId	=	$item->id;
		if($thisCategoryId == $thisParentId)
		{
			echo '<option value="'.$item->id.'" selected>'.$item->name.'</option>';
		}
		else
		{
  			echo '<option value="'.$item->id.'">'.$item->name.'</option>';
		}
	}
  }
  else
  foreach($category as $item)
	{

  		echo '<option value="'.$item->id.'">'.$item->name.'</option>';
	}
  	
  ?>

  </select>
	</div>
	@if ( $errors->has('parent_id') )
		<p class="help-block">{{ $errors->first('parent_id') }}</p>
	@endif
</div>

<?php }?>


<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	{{ Form::label('name', 'Sub Category Name *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
	<div class="col-md-6 col-sm-6 col-xs-12">
		{{ Form::text('name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
	</div>
	@if ( $errors->has('name') )
		<p class="help-block">{{ $errors->first('name') }}</p>
	@endif
</div>



<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
	{{ Form::label('image', 'Category Image', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
	<div class="col-md-6 col-sm-6 col-xs-12">
		{{ Form::file('image', ['class' => 'form-control col-md-7 col-xs-12','style'=>'width:70%;float:left;padding:0px;']) }}
		<div id="add_browse"></div>
	</div>
	@if ( $errors->has('image') )
		<p class="help-block">{{ $errors->first('image') }}</p>
	@endif
</div>

<?php

if(isset($subcategory)) {?>

<div class="form-group">
	<label for="Image" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
	<div class="col-md-6 col-sm-6 col-xs-12">

		<input name="delete_reports" id="delete_reports" value="0" type="hidden">
		<?php $categoryImage  =  $subcategory->image; $categoryld  =  $subcategory->id;?>

		<div style="float: left;padding: 3px; border:1px solid #ddd; min-height:75px" id="ImageDiv_<?php echo $categoryld; ?>">
			<img  style="max-width: 200px; max-height: 200px;" id="image_<?php echo $categoryld; ?>" src="{{ URL::to('/') }}/public/images/categories/{{$categoryImage}}" style="width:50px; max-height:50px">

		</div>

	</div>
</div>
<?php
} // isset ends here .....
?>



<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('subcategories'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>

