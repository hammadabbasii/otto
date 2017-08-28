

<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
    {{ Form::Label('id', 'Select Brand:' , ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
     <select class="form-control col-md-7 col-xs-12" name="id" style="width:auto;">

        <?php
        if (isset($product->brand_id)) {
            $thisParentId = $product->brand_id;

            foreach ($brand as $item) {
                $thisid = $item->id;
                if ($thisid == $thisParentId) {
                    echo '<option value="' . $item->id . '" selected>' . $item->name . '</option>';
                } else {
                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                }
            }
        } else {
            foreach ($brand as $item) {

                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }
        ?>

    </select>
</div>

<div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
    {{ Form::label('product_name', 'Product Name *', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::text('product_name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
    </div>
    @if ( $errors->has('product_name') )
    <p class="help-block">{{ $errors->first('product_name') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('product_description') ? ' has-error' : '' }}">
    {{ Form::label('product_description', 'Product Description', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::textArea('product_description', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
    </div>
    @if ( $errors->has('product_description') )
    <p class="help-block">{{ $errors->first('product_description') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    {{ Form::label('price', 'price', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::text('price', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
    </div>
    @if ( $errors->has('price') )
    <p class="help-block">{{ $errors->first('price') }}</p>
    @endif
</div>

<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
    {{ Form::label('quantity', 'quantity', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::text('quantity',null,['class' => 'form-control col-md-7 col-xs-12']) }}
    </div>
    @if ( $errors->has('quantity') )
    <p class="help-block">{{ $errors->first('quantity') }}</p>
    @endif
</div>


<div class="form-group{{ $errors->has('product_image') ? ' has-error' : '' }}">
    {{ Form::label('product_image', 'Product Image', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::file('product_image', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
    </div>
    @if ( $errors->has('product_image') )
    <p class="help-block">{{ $errors->first('product_image') }}</p>
    @endif
</div>


<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Html::link( backend_url('product'), 'Cancel', ['class' => 'btn btn-default']) }}
    </div>
</div>

