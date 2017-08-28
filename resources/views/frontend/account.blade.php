@extends( 'frontend.layout' )
@section('title', '')

@section('inlineJS')

@endsection
@section('content')
<div class="homewrap">
    <section class="section">
        <div class="logintext center">Already have a <a href="javascript::">Ottozlila</a> account? Please <a href="javascript::">sign in</a>.</div>
    </section>
    <div id="tabs-container">
        <ul class="tabs-menu">
            <li class="current"><a href="#tab-1">Registration as User</a></li>
            <li ><a href="#tab-2">Registration as Dealer</a></li>

        </ul>
        <div class="clearfix"></div>
        <div class="tab browse">
            <div id="tab-1" class="tab-content">
                <div class="loginform">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h3>Create a <span>Free Account</span></h3>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li><br>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form name="register" action="signup/add" method="post" id="register" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="javascript::"><img src="{{ frontend_asset('images/facebookbtn.png')}}" alt="facebook"></a>
                            <div class="clearfix"><br>
                            </div>
                            <h3>Upload Profile Picture</h3>
<!--                            <img src="images/profilepicture.jpg" alt="">
                            <div class="clearfix"><br>
                            </div>
                            <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                            <label for="file-1"><span>Choose photo from URL</span></label>
                            <div class="clearfix"><br>
                            </div>-->
                            <input type="file" style="display: none" name="image" id="file-1" class="inputfile inputfile-1"  />
                            <label for="file-1"><span>Choose photo from your computer</span></label>
                            <div class="clearfix"><br>
                                <br>
                            </div>
                            <h3>Or Register Normally</h3>
                            <div class="required">* All Fields are mandatory</div>
                            <div class="col-md-6 padleft">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address *" required="required" >

                            </div>

                            <div class="col-md-6 padright" >
                                <input type="email" name="confirm_email" value="{{ old('confirm_email') }}" placeholder="Confirm Email *" required="required" >

                            </div>
                            <div class="col-md-6 padleft">
                                <input type="password" name="password" value="{{ old('password') }}" placeholder="Password *" required="required">
                            </div>
                            <div class="col-md-6 padright">
                                <input type="password" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm Password *" required="required">
                            </div>
                            <div class="col-md-6 padleft">
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name *" required="required">
                            </div>
                            <div class="col-md-6 padright">
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name*" required="required">
                            </div>
                            <div class="col-md-6 padleft">
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="Mobile Number *" required="required">
                            </div>
                            <div class="col-md-6 padright">
                                <select name="gender" required="required">
                                    <option value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6 padleft">
                                <input type="text" name="dob" id="datepicker" value="{{ old('dob') }}" placeholder="Date Of Birth" required="required">
                            </div>
                            <div class="col-md-6 padright">&nbsp;</div>
                            <div class="clearfix"></div>
                            <!--                        <div class="col-md-6 padleft">
                                                        <select>
                                                            <option>Nationality</option>
                                                            <option>Nationality one</option>
                                                            <option>Nationality two</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 padright">
                                                        <select>
                                                            <option>Career Level</option>
                                                            <option>Career one</option>
                                                            <option>Career two</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 padleft">
                                                        <select>
                                                            <option>Education</option>
                                                            <option>Education one</option>
                                                            <option>Education one</option>
                                                        </select>
                                                    </div>-->
                            <div class="col-md-6 padright">&nbsp;</div>
                            <div class="col-md-12 nopad">
                                <div class="clearfix"> <br>
                                </div>
                                <label>
                                    <input type="checkbox" value="">
                                    Allow Ottozilla to send me occasional updates about the site. </label>
                                <div class="clearfix"><br>
                                </div>
                                <label>
                                    <input type="checkbox" value="">
                                    Send me amazing offers and bargains from our advertising partners. </label>
                                <div class="clearfix"><br>
                                </div>
                                <p class="facebooknote">By clicking on Register, you agree to the Ottozilla Terms and Conditions and the Ottozilla Privacy Policy.</p>
    <!--                                <img src="images/googlemap.jpg" alt="">-->
                                <div class="clearfix"></div>
                                <div class="center margintop">
                                    <input type="submit" value="Register">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <div id="tab-2" class="tab-content">
            <div class="loginform browse">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h3>Create a <span>Free Account</span></h3>
                    <h3>Upload Profile Picture</h3>
                    <form name="register" action="signup/add" method="post" id="register">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!--                        <img src="images/profilepicture.jpg" alt="">
                        <div class="clearfix"><br>
                        </div>-->
    <!--                        <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-1"><span>Choose photo from URL</span></label>
                        <div class="clearfix"><br>
                        </div>-->
                        <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-1"><span>Choose photo from your computer</span></label>
                        <div class="clearfix"><br>
                            <br>
                        </div>
                        <div class="required">* All Fields are mandatory</div>
                        <div class="col-md-6 padleft">
                            <input type="email" name="email" value="" placeholder="Email Address *">
                            <input type="text" name="" value="" placeholder="Password *">
                            <input type="text" name="" value="" placeholder="Company Name *">
                            <input type="text" name="" value="" placeholder="Company Phone Number *">
                            <select>
                                <option>City</option>
                                <option>City one</option>
                                <option>City two</option>
                            </select>
                        </div>
                        <div class="col-md-6 padright">
                            <input type="email" name="email" value="" placeholder="Confirm Email *">
                            <input type="text" name="" value="" placeholder="Confirm Password *">
                            <input type="text" name="" value="" placeholder="Company Trade Lisence Number*">
                            <input type="text" name="" value="" placeholder="Company Mobile Number*">
                            <input type="text" name="" value="" placeholder="Country*">
                        </div>
                        <div class="col-md-12 nopad">
                            <input type="text" name="" value="" placeholder="Company Address**">
                            <textarea rows="6" cols="150" placeholder="Write a short discription about the company.*"></textarea>
                            <div class="clearfix"><br>
                            </div>
                            <div class="col-md-1 padleft"><img src="images/uploadlogo.jpg" alt=""></div>
                            <div class="col-md-4 uploadtext">Upload Your Company Logo<span>*</span></div>
                            <div class="col-md-3 nopad">
                                <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                                <label for="file-1"><span>Choose File</span></label>
                            </div>
                            <div class="clearfix"><br>
                                <br>
                            </div>
                            <label>
                                <input type="checkbox" value="">
                                Allow Ottozilla to send me occasional updates about the site. </label>
                            <div class="clearfix"><br>
                            </div>
                            <label>
                                <input type="checkbox" value="">
                                Send me amazing offers and bargains from our advertising partners. </label>
                            <div class="clearfix"><br>
                            </div>
                            <p class="facebooknote">By clicking on Register, you agree to the Ottozilla Terms and Conditions and the Ottozilla Privacy Policy.</p>
                            <img src="images/googlemap.jpg" alt="">
                            <div class="clearfix"></div>
                            <div class="center margintop">
                                <input type="submit" value="Register">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</div>
</div>

<!------------------------ Content Area Ends ------------------------------------>
@endsection