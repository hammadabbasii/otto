<?php
if (isset($deal->entity_id))
{
        $checkDeal = $deal->entity_id;
}else{
        $checkDeal = '';
}
?>
<?php if(Auth::user()->is_subadmin == 'admin'){?>
<div class="form-group{{ $errors->has('entity_id') ? ' has-error' : '' }}">
        {{ Form::label('entity_id', 'Seller Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div id="model_id" class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" id="getSubCategory" name="entity_id">
                        <?php foreach($getEntities as $entities){ ?>
                        <option <?php if($entities->id == $checkDeal){ echo "selected";}?> value="<?php echo $entities->id;?>"><?php echo $entities->name;?></option>
                        <?php } ?>
                </select>
        </div>
        @if ( $errors->has('entity_id') )
                <p class="help-block">{{ $errors->first('entity_id') }}</p>
        @endif
</div>
<?php }?>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {{ Form::label('name', 'Category Name *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
                {{ Form::text('category_name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
        </div>
        @if ( $errors->has('category_name') )
                <p class="help-block">{{ $errors->first('category_name') }}</p>
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

if(isset($category)) {?>

<div class="form-group">
        <label for="Image" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
        <div class="col-md-6 col-sm-6 col-xs-12">

                <input name="delete_reports" id="delete_reports" value="0" type="hidden">
                <?php $categoryImage  =  $category->image; $categoryld  =  $category->id;?>

                <div style="float: left;padding: 3px; border:1px solid #ddd; min-height:75px" id="ImageDiv_<?php echo $categoryld; ?>">
                        <img  style="max-width: 200px; max-height: 200px;" id="image_<?php echo $categoryld; ?>" src="{{$categoryImage}}" style="width:50px; max-height:50px">

                </div>

        </div>
</div>
<?php
} // isset ends here .....
?>


{{--<div class="form-group {{ $errors->has('seller_type') ? ' has-error' : '' }}">
        {{ Form::label('seller_type', 'Seller type *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">

                <div class="checkbox col-md-3 col-sm-3 col-xs-12">
                        <label>
                                {{ Form::radio('seller_type','dinning') }}
                                <span class="cr"></span>Dinning
                        </label>
                </div>
                <div class="checkbox col-md-3 col-sm-3 col-xs-12">
                        <label>
                                {{ Form::radio('seller_type','shopping') }}
                                <span class="cr"></span>Shopping
                        </label>
                </div>
        </div>
        @if ( $errors->has('seller_type') )
                <p class="help-block">{{ $errors->first('seller_type') }}</p>
        @endif
</div>--}}

<div class="ln_solid"></div>
<div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Html::link( backend_url('categories'), 'Cancel', ['class' => 'btn btn-default']) }}
        </div>
</div>

