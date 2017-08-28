<div class="container">
    <div class="row">
        <div class="col-md-4 padleft logo"><a href="{{ frontend_url('index') }}"><img src="{{ frontend_asset('images/logo.png') }}" alt="logo"></a></div>
        <div class="col-md-5 searchbar nopad">
            <form name="search" action="{{ frontend_url('search') }}" method="post" id="search">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{--<input placeholder="Search" name="searchtxt" type="text">--}}
                <select class="js-example-basic-single" data-placeholder="Search" placeholder="Search" name="category_id">
                    @foreach( \App\Category::where('parent_id',0)->with('subcategories')->get() as $category )
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>

                <input value="Search" type="submit">
            </form>
        </div>
        <?php
        $user = session()->get('user');
        ?>
        @if(isset($user))
        <?php $cartcount = \App\Usercart::where('user_id', $user->id)->get()->count();
        ?>
        <div class="col-md-1 headercart"> <span class="count">{{$cartcount}}</span>

            <div class="clearfix"></div>
            Cart </div>
        @endif
        <div class="col-md-2 headerlinks">

            <?php
            $user = session()->get('user');
            ?>
            @if(isset($user))
            <ul>
                <li><a href="{{ frontend_url('logout') }}">Logout</a></li>
                <li><a href="{{ frontend_url('signup') }}">Join</a></li>
                <span class="smartmarttag">{{$user->first_name}}</span>


            </ul>
            @endif
            @if(!isset($user))
            <ul>
                <li><a href="{{ frontend_url('login') }}">Sign in</a></li>
                <li><a href="{{ frontend_url('signup') }}">Join</a></li>
            </ul>
            <span class="smartmarttag">SmartMart</span>
            @endif


        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9 menu-header">
            <ul>
                <li><a href="{{ frontend_url('index') }}">home</a></li>
                @foreach( \App\Category::where('parent_id',0)->with('subcategories')->limit(4)->get() as $category )
                <li><a href="{{ frontend_url('category/'.str_slug($category->id)) }}">{{$category->category_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
