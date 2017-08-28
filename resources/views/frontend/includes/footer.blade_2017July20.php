<!------------------------ Subfooter ------------------------------------>
<section class="subfooter">
    <div class="container">
        <div class="row">
            <div class="col-md-3 padleft"><a href="{{ frontend_url('index') }}"><img src="{{ frontend_asset('images/subfooter.png') }}" alt="logo" class="footerlogo"></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
            </div>
            <div class="col-md-3">
                <h4>Join the conversation</h4>
                <p>Aenean erat lacus, vulputate sit amet lacinia ornare a augue..</p>
                <div class="social_icons">
                    <ul>
                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li> <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 newsletter">
                <h4>Newsletter</h4>
                <p>Aenean erat lacus, vulputate sit amet ornare a augue.</p>
                <form name="newsletter" action="{{frontend_url('newsmail')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input name="newsletter" type="text">
                    <input value="submit" type="submit">
                </form>
            </div>
            <div class="col-md-3 sfooter">
                <h4>Contact Us</h4>
                <span><i></i>No 1123, Sky Tower, New York, USA</span> <span><i data-position="64 146" style="background-position: 0px -32px;" data-pos="1"></i>(+800) 1234 5678 90</span> <span><i data-position="63 179" style="background-position: -0px -63px;" data-pos="1"></i><a href="javascript:;" title="">Email: info@company.com</a></span> </div>
        </div>
    </div>
</section>
<!------------------------ Subfooter Ends ------------------------------------>
<!------------------------ Footer ------------------------------------>
<footer class="footer">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-2 padleft">
                <?php
                $user=session()->get('user');
                ?>
                <h4>Information</h4>
                <ul>
                    <li><a href="{{ frontend_url('aboutus') }}">About Us</a></li>
                    <li><a href="{{ frontend_url('contactus') }}">Contact Us</a></li>
                    <li><a href="{{ frontend_url('terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ frontend_url('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ frontend_url('orderandreturn') }}">Orders and Returns</a></li>
                    <li><a href="{{ frontend_url('sitemap')}}">Site Map</a></li>
                </ul>
            </div>
            <div class="col-md-2 padleft">
                <h4>Why buy from us</h4>
                <ul>
                    <li><a href="{{ frontend_url('shippingoption') }}">Shipping Options</a></li>
                    <li><a href="{{ frontend_url('help') }}">Help & FAQs</a></li>
                </ul>
            </div>
            <div class="col-md-2 padleft">
                <h4>My account</h4>
                <ul>
                    <li><a href="{{ frontend_url('login') }}">Sign In</a></li>

                    @if($user)
                        <li><a href="{{ frontend_url('wishlist') }}">My Wishlist</a></li>
                        @else
                        <li><a href="{{ frontend_url('login') }}">My Wishlist</a></li>
                        @endif

                    @if($user)
                    <li><a href="{{ frontend_url('orders') }}">View Cart</a></li>
                    @else
                        <li><a href="{{ frontend_url('login') }}">View Cart</a></li>
                    @endif
                    @if($user)
                    <li><a href="{{ frontend_url('checkout') }}">Check out</a></li>
                    @else
                        <li><a href="{{ frontend_url('login') }}">Check out</a></li>
                    @endif
                    {{--<li><a href="#">Track My Order</a></li>--}}
                </ul>
            </div>
            <div class="col-md-2 padleft">
                <h4>Assistance</h4>
                <ul>
                    <li><a href="{{ frontend_url('shipping') }}">Shipping Information</a></li>
                    <li><a href="{{ frontend_url('needhelp') }}">Need help?</a></li>
                    <li><a href="{{frontend_url('customersupport')}}">Customer Support</a></li>
                </ul>
            </div>
            <div class="col-md-2 padleft">
                <h4>Userful links</h4>
                <ul>
                    <li><a href="{{ frontend_url('pricing/policy') }}">Pricing Policy</a></li>
                    <li><a href="{{ frontend_url('shipping/policy') }}">Shipping Policy</a></li>
                    <li><a href="{{ frontend_url('siteinformation') }}">Site Information</a></li>
                    <li><a href="{{ frontend_url('satisfaction')}}">Your Satisfaction</a></li>
                </ul>
            </div>
            <div class="col-md-2 padleft">
                <h4>Top Pages</h4>
                <ul>
                    <li><a href="{{ frontend_url('index') }}">Home</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6 padleft"> Copyright © 2017 - <strong>SmartMart</strong>. All rights reserved.</div>
            <div class="col-md-6 padright text-right"><img src="{{ frontend_asset('images/payment.png') }}" alt="paymentlogos"></div>
        </div>
    </div>
</section>