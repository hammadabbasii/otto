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

    <!------------------------ googlemap ----------------------------------->

    <div class="googlemap"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d459187.4791747161!2d50.321307018219755!3d25.9548471955563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e48524e6a47a211%3A0x2e9450e2dbda1046!2sBahrain!5e0!3m2!1sen!2s!4v1494346953446" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>

    <!------------------------ googlemap Ends------------------------------------>

    <!------------------------ Content Area ------------------------------------>
    <section class="section contactpage">
        <div class="container">
            <div class="row">
                <div class="col-md-7 padleft">
                    <h1>CONTACT US</h1>
                    <p>We would love to hear back from you! Send us any feedback you may have about our website, products or services. Fill in your information below and one of our customer service representatives will get in touch within the following 24 working hours</p>
                    <form name="contactus" action="contactus/add" method="post" id="contactus">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-6 padleft">
                        <div class="form-group{{ $errors->has('enquiry_type') ? ' has-error' : '' }}">
                            <label> ENQUIRY TYPE*</label>
                            <select name="enquiry_type">
                                <option>enquiry one</option>
                                <option>enquiry two</option>
                            </select>
                            @if ( $errors->has('enquiry_type') )
                                <p class="help-block">{{ $errors->first('enquiry_type') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6 padright">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label> NAME*</label>
                            <input name="name" type="text">
                            @if ( $errors->has('name') )
                                <p class="help-block">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-12 nopad">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label> EMAIL ADDRESS*</label>
                            <input name="email" type="email">
                            @if ( $errors->has('email') )
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6 padleft">
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label> PHONE*</label>
                            <input name="phone" type="text">
                            @if ( $errors->has('phone') )
                                <p class="help-block">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6 padright">
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label> ADDRESS*</label>
                            <input name="address" type="text">
                            @if ( $errors->has('address') )
                                <p class="help-block">{{ $errors->first('address') }}</p>
                            @endif
                        </div>

                    </div>
                    {{--<div class="applicable">IF APPLICABLE</div>--}}
                    <div class="col-md-6 padleft">
                        <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                            <label> PRODUCT NAME*</label>
                            <input name="product_name" type="text">
                            @if ( $errors->has('product_name') )
                                <p class="help-block">{{ $errors->first('product_name') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6 padright">
                        <div class="form-group{{ $errors->has('store_locations') ? ' has-error' : '' }}">
                            <label> STORE LOCATION*</label>
                            <input name="store_locations" type="text">
                            @if ( $errors->has('store_locations') )
                                <p class="help-block">{{ $errors->first('store_locations') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-12 nopad">
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label> MESSAGE*</label>
                            <textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" id="mesg" aria-invalid="false" ></textarea>
                            @if ( $errors->has('message') )
                                <p class="help-block">{{ $errors->first('message') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="pull-right">
                        <input value="SUBMIT ENQUIRY" type="submit">

                        <div class="clearfix"></div>
                        <div class="requirednote pull-right">*  Required Fields</div>
                    </div>
                    </form>
                </div>
                <div class="col-md-3 contactdetails">
                    <h1>Our Stores</h1>
                    <h3>Alosra Amwaj</h3>
                    <ul>
                        <li>Telephone :  160337765</li>
                        <li>Fax : +973  160337765</li>
                    </ul>
                    <div class="customerbox">
                        <p>Already a customer?</p>
                        <a href="{{ frontend_url('login') }}"><input value="login" type="submit"></a>
                        <hr />
                        <p>Not yet registered?<a href="{{ frontend_url('signup') }}">Register Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------ Content Area Ends ------------------------------------>
@endsection