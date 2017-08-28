@extends( 'frontend.layout' )
@section('title', '')
@section('CSSLibraries')
    <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet">
    @endsection
    @section('JSLibraries')
    @endsection
    @section('inlineJS')
    @endsection
    @section('content')
            <!------------------------ Header Ends ------------------------------------>

    <!------------------------ Tagline ------------------------------------>
    <section class="major-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6  col-sm-6"> </div>
                <div class="col-lg-5 col-md-5 hidden-sm hidden-xs nopad"> <span class="hours24" href="javascript:;" title="">Deliver  within 24 Hours </span> <span class="hours24 num" href="javascript:;" title="">800-33257 (deals) </span> </div>
            </div>
        </div>
    </section>
    <!------------------------ Tagline Ends------------------------------------>

    <!------------------------ Content Area ------------------------------------>

    <section class="section checkout contactpage">
        <div class="container">
            <div class="row">
                <h1>ADD ADDRESS</h1>
                <div class="col-md-12 padleft">
                    <div class="whtbg content-area-1">
                        <h3>ADD ADDRESS</h3>
                        <div class="clearfix"><br>
                            <br>
                        </div>
                        <div id="address_detail">
                            <form name="address" action="address/add" method="post" id="address">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-md-12 nopad">
                        <label>COUNTRY *</label>
                        <input name="country" type="text" required="required">
                            @if ( $errors->has('country') )
                                <p class="help-block">{{ $errors->first('country') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 padleft">
                        <label>CITY *</label>
                        <input name="city" type="text" required="required">
                            @if ( $errors->has('city') )
                                <p class="help-block">{{ $errors->first('city') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 padright">
                        <label>STREET NAME</label>
                        <input name="street_name" type="text" required="required">
                            @if ( $errors->has('street_name') )
                                <p class="help-block">{{ $errors->first('street_name') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 padleft">
                        <label>BUILDING NAME</label>
                        <input name="building_name" type="text" required="required">
                            @if ( $errors->has('building_name') )
                                <p class="help-block">{{ $errors->first('building_name') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 padright">
                        <label>FLOOR (OPTIONAL)</label>
                        <input name="floor" type="text" >
                            @if ( $errors->has('floor') )
                                <p class="help-block">{{ $errors->first('floor') }}</p>
                            @endif
                        </div>
                        <div class="col-md-12 nopad">
                        <label>APARTMENT (OPTIONAL)</label>
                        <input name="appartment" type="text" >
                            @if ( $errors->has('appartment') )
                                <p class="help-block">{{ $errors->first('appartment') }}</p>
                            @endif
                        </div>
                        <div class="col-md-12 nopad">
                        <label>NEAREST LANDMARK (OPTIONAL)</label>
                        <input name="nearest_landmark" type="text">
                            @if ( $errors->has('nearest_landmark') )
                                <p class="help-block">{{ $errors->first('nearest_landmark') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 padleft">
                        <label>TELEPHONE *</label>
                        <input name="phone" type="text" required="required">
                            @if ( $errors->has('phone') )
                                <p class="help-block">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 padright">
                        <label>LOCATION TYPE</label>
                        <select name="location_type">
                        <option value="Building">BUILDING</option>
                        <option value="Flat">VILLA</option>
                        </select>

                        </div>
                        <input  checked="checked" type="checkbox" id="c1" name="check" value="1"/>
                        <label for="c1"><span></span>SAVE IN ADDRESS BOOK</label>
                                @if ( $errors->has('check') )
                                    <p class="help-block">{{ $errors->first('check') }}</p>
                                @endif
                        <div class="clearfix"><br>
                        <br>
                        </div>
                                <input type="submit">
                            </form>
                        </div>
                        <div class="clearfix"><br>
                            <br>
                        </div>
                        </div>
                    <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!------------------------ Content Area Ends ------------------------------------>

    <!------------------------ Footer ------------------------------------>
@endsection