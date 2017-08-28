@extends( 'frontend.layout' )
@section('title', '')

@section('inlineJS')

@endsection
@section('content')
<div class="homewrap">
    <div class="formbg">
        <div class="col-md-8 nopad">
            <div class="homesearch wow fadeIn">
                <div class="col-md-7">
                    <h2>Search By Make & Model</h2>
                    <form action="index')}}">
                        <select>
                            <option>Moke</option>
                            <option>Honda</option>
                            <option>Toyota</option>
                        </select>
                        <select>
                            <option>Model</option>
                            <option>2016</option>
                            <option>2017</option>
                        </select>
                        <div class="col-md-6 nopad">
                            <select>
                                <option>Year From</option>
                                <option>2016</option>
                                <option>2017</option>
                            </select>
                        </div>
                        <div class="col-md-6 nopad">
                            <select>
                                <option>Year to</option>
                                <option>2016</option>
                                <option>2017</option>
                            </select>
                        </div>
                        <div class="center">
                            <input type="submit" value="Yalla!">
                        </div>
                    </form>
                </div>
                <div class="col-md-5 welcometext">
                    <h4>Hi, This is Ottozilla. <br>
                        Welcome to My Auto Classifieds <br>
                        Website! I will help you find your <br>
                        new dearm car today!</h4>
                    <br>
                    <div class="wow bounceInDown"> <img src="{{ frontend_asset('images/ottozilla.png')}}" alt=""></div></div>
            </div>
        </div>
        <div class="col-md-4 nopad homebanner2"> <img src="{{ frontend_asset('images/homebanner.jpg')}}" alt=""> </div>
        <div class="clearfix"></div>
    </div>
    <section class="section">
        <div class="searchcategory wow slideInRight">
            <h3>Search By <span>Category</span></h3>
            <ul>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c1.jpg')}}" alt="">
                        <div class="title">Sedan</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c2.jpg')}}" alt="">
                        <div class="title">coupe</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c3.jpg')}}" alt="">
                        <div class="title">hatchback</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c4.jpg')}}" alt="">
                        <div class="title">convertible</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c5.jpg')}}" alt="">
                        <div class="title">luxury</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c6.jpg')}}" alt="">
                        <div class="title">sports</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c7.jpg')}}" alt="">
                        <div class="title">suv</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c8.jpg')}}" alt="">
                        <div class="title">truck</div>
                    </a> </li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/c9.jpg')}}" alt="">
                        <div class="title">van</div>
                    </a> </li>
            </ul>
        </div>
    </section>
    <section class="section brand fadeInUp">
        <div class="brandcategory">
            <h3>Search By <span>Brand</span></h3>
            <ul>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand1.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand2.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand3.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand4.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand5.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand6.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand7.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand8.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"> <img src="{{ frontend_asset('images/brand9.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand10.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand11.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand12.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand13.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"> <img src="{{ frontend_asset('images/brand14.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand15.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand16.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"> <img src="{{ frontend_asset('images/brand17.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"> <img src="{{ frontend_asset('images/brand18.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"> <img src="{{ frontend_asset('images/brand19.png')}}" alt="brand"></a></li>
                <li><a href="javascript::"><img src="{{ frontend_asset('images/brand20.png')}}" alt="brand"></a></li>
            </ul>
            <a href="javascript::" class="button mrgtop">See More Brands</a> </div>
    </section>
    <section class="section">
        <div class="brandcategory wow zoomIn">
            <div class="col-md-2 nopad"><img src="{{ frontend_asset('images/ottozilla_.jpg')}}" alt="logo"></div>
            <div class="col-md-10 padright budgetsearch">
                <h3> Have a budget in mind? <span>Try your luck here!</span></h3>
                <form action="index">
                    <div class="col-md-5 padleft">
                        <select>
                            <option>Year From</option>
                            <option>2016</option>
                            <option>2016</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select>
                            <option>Year to</option>
                            <option>2016</option>
                            <option>2017</option>
                        </select>
                    </div>
                    <div class="col-md-2 padright">
                        <input type="submit" value="Hit it">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="section featuredlisting wow fadeInUp">
        <h3>Feature <span>Listing</span></h3>
        <ul>
            @foreach( $featureAds as $featureAd)

            <a href="javascript::">
                <li> 
                    <img src="{{ $featureAd->ad_image[0]}}" alt="">
                    <div class="fdetail">
                        <div class="title">{{$featureAd->title}}</div>
                        <div class="price">AED {{number_format($featureAd->price,0)}}</div>
                    </div>
                </li>
            </a>

            @endforeach


            <!--            <a  href="{{ frontend_url('detail')}}">
                            <li> 
                                <img src="{{ frontend_asset('images/featured5.jpg')}}" alt="">
                                <div class="fdetail">
                                    <div class="title">Blue Mazda CX-9 Full Option 2013</div>
                                    <div class="price">AED 35,700</div>
                                </div>
                            </li>
                        </a>-->
        </ul>
    </section>
    <div class="clearfix"></div>
</div>
@endsection