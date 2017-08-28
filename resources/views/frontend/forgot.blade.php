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
    <section class="section loginpage">
        <div class="container">
            <div class="row">
                <h1>Forgot Password</h1>
                <div class="col-md-6 padleft">
                    <div class="whtbg content-area-1">
                        <h3>New Customers</h3>
                        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                        <a href="javascript::" class="btn">Create an account</a> </div>
                </div>
                <div class="col-md-6 padright">
                    <div class="whtbg content-area-1 registered_customers">
                        <h3> Forgot your Password?</h3>
                        <p> Please Enter Your Email.</p>
                        <form name="forgotpwd" action="sendemail" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label>*  Email Address</label>
                            <input  name="email" type="email" required="required">
                            <label class="rightalign">*  Required Fields</label>
                            <br>
                            <div class="col-md-6 nopad pull-right">
                                <input value="Send" type="submit">
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection