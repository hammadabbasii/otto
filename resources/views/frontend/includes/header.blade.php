<header>
    <div class="container">
        <div class="row"> 
            <?php
            $user = session()->get('user');
            ?>

            <!-- -----------------------Logo  ---------------------- -->
            <logo>
                <div class="col-md-3 padleft logo"> <a href="{{ frontend_url('index')}}" title="Ottozilla"> <img src="{{ frontend_asset('images/logo.png')}}" alt="logo"></a> </div>
            </logo>
            <div class="col-md-3"></div>
            <div class="col-md-1 nopad regions topmrg">
                <select>
                    <option>Dubai</option>
                </select>
            </div>
            <div class="col-md-3 header_right topmrg">

                <ul>
                    @if(isset($user))
                    <li><a href="{{ frontend_url('login')}}">Hi, {{$user->first_name}}  </a></li>
                    <li><a href="{{ frontend_url('logout')}}">Logout </a></li>
                    @else
                    <li><a href="{{ frontend_url('login')}}">Login </a></li>
                    <li><a href="{{ frontend_url('signup')}}">Create an account</a></li>
                    @endif
                </ul>

            </div>
            <div class="col-md-2 nopad add"> <a href="javascript::"><img src="{{ frontend_asset('images/add.jpg')}}"  alt="add"></a></div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <nav class="nav">
            <div class="col-md-8 nopad">
                <div class="menu-header">
                    <div id="menu-button">Menu</div>
                    <ul id="menu-main-menu" class="menu">
                        <li><a href="{{ frontend_url('category/1')}}">Used Cars</a></li>
                        <li><a href="javascript::">Bikes</a></li>
                        <li><a href="javascript::">Boats</a></li>
                        <li><a href="javascript::">Auto Accessories</a></li>
                        <li><a href="javascript::">Number Plates</a></li>
                        <li><a href="javascript::">Auto Services</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 mtop">
                <search>
                    <div class="searchform">
                        <form method="get" id="searchform" action="/">
                            <input id="searchsubmit" value="Search" type="submit">
                            <input value="" name="s" id="s" placeholder="I’m looking for..." type="text">
                        </form>
                    </div>
                </search>
            </div>
            <div class="col-md-1 mtop">
                <div class="btn">العربية</div>
            </div>
            <div class="clearfix"></div>
        </nav>
    </div>
</div>
<div class="container nopad">


