@extends( 'frontend.layout' )
@section('title', '')

@section('content')



<div class="homewrap">
    <section class="section">
        <div class="logintext center">Already have a <a href="javascript::">Ottozlila</a> account? Please <a href="javascript::">sign in</a>.</div>
    </section>
    <div class="loginform">
        <h3 class="center">Login <span>Now</span></h3>

        <div class="innerloginform">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li><br>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif
            <form name="login" action="login/authentication" method="post" id="login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="required">* All Fields are mandatory</div>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address *" required="required">
                <input type="password" name="password" value="" placeholder="Password *" required="required">
                <a href="javascript::" class="forgotlink">Forgot Password?</a>
                <div class="center margintop">
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="or center">Or
                <div class="clearfix"><br>
                    <br>
                </div>
                <a href="javascript::"><img src="{{ frontend_asset('images/facebookbtn.png')}}" alt=""></a>
                <p class="facebooknote">We won’t post on your Facebook</p>
                <a href="javascript::"><img src="{{ frontend_asset('images/googlebtn.png')}}" alt=""></a> </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


@endsection