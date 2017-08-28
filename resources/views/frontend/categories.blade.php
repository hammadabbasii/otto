@extends( 'frontend.layout' )
@section('title', '')

@section('content')
<div class="wrap">
    <div class="col-md-9"></div>
    <div class="col-md-3 sortby nopad">
        <label>Sort By :</label>
        <select>
            <option>Newest to Oldest</option>
            <option>Oldest to Newest</option>
        </select>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-3 sidebar">
        <div class="center">
            <h6>Search</h6>
        </div>
        <form id="sidebarform">
            <select>
                <option>Dubai</option>
                <option>Uae</option>
            </select>
            <select>
                <option>Motors</option>
                <option>Motors</option>
            </select>
            <select>
                <option>Used Car for Sale</option>
                <option>Used Car for Sale</option>
            </select>
            <select>
                <option>GMC</option>
                <option>GMC</option>
            </select>
            <select>
                <option>Terrain</option>
                <option>Terrain</option>
            </select>
            <h5>Price ( AED )</h5>
            <div class="col-md-6 padleft">
                <input type="text" name="PriceFrom" value="" placeholder="Price From">
            </div>
            <div class="col-md-6 padright">
                <input type="text" name="Priceto" value="" placeholder="Price To">
            </div>
            <div class="clearfix"></div>
            <h5>Year</h5>
            <div class="col-md-6 padleft">
                <input type="text" name="PriceFrom" value="" placeholder="Year From">
            </div>
            <div class="col-md-6 padright">
                <input type="text" name="Priceto" value="" placeholder="Year To">
            </div>
            <div class="clearfix"></div>
            <h5>Kilometer</h5>
            <div class="col-md-6 padleft">
                <input type="text" name="PriceFrom" value="" placeholder="Year From">
            </div>
            <div class="col-md-6 padright">
                <input type="text" name="Priceto" value="" placeholder="Year To">
            </div>
            <div class="clearfix"></div>
            <h5>Seller Type</h5>
            <select>
                <option>All Type</option>
                <option>All Type</option>
            </select>
            <div class="clearfix"></div>
            <h5>Badges</h5>
            <label>
                <input type="checkbox" value="">
                Full Service History  (10809)</label>
            <label>
                <input type="checkbox" value="">
                Negotiable (5175)</label>
            <label>
                <input type="checkbox" value="">
                Under Warranty (5149)</label>
            <label>
                <input type="checkbox" value="">
                Urgent (1015)</label>
            <div class="clearfix"></div>
            <h5>CarReport</h5>
            <label>
                <input type="checkbox" value="">
                Show ads with carReport Only(4656)</label>
            <div class="clearfix"></div>
            <h5>Content Language</h5>
            <label>
                <input type="checkbox" value="">
                Show English ads only (36)</label>
            <a href="javascript::" onClick="sidebarform()" class="clear">clear</a>
            <input type="text" name="PriceFrom" value="" placeholder="Keyword">
            <div class="center margintop">
                <input type="submit" value="Search">
            </div>
            <div class="clearfix"><br>
                <br>
            </div>
            <h6 class="center">Advance Search</h6>
            <h5>Neighborhoods</h5>
            <select>
                <option>All Location</option>
                <option>All Location</option>
            </select>
            <div class="clearfix"></div>
            <h5>Ads Posted</h5>
            <select>
                <option>Any Time</option>
                <option>Any Time</option>
            </select>
            <div class="clearfix"></div>
            <h5>Auto Agent</h5>
            <select>
                <option>Any Time</option>
                <option>Any Time</option>
            </select>
            <div class="clearfix"></div>
            <h5>Body Type</h5>
            <label>
                <input type="checkbox" value="">
                SUV (1547)</label>
            <label>
                <input type="checkbox" value="">
                Sedan (41)</label>
            <label>
                <input type="checkbox" value="">
                Coupe (415)</label>
            <label>
                <input type="checkbox" value="">
                Hatchback (1066)</label>
            <label>
                <input type="checkbox" value="">
                Sports Car (478)</label>
            <label>
                <input type="checkbox" value="">
                Hard Top Convertible (123)</label>
            <label>
                <input type="checkbox" value="">
                Soft Top Convertible (337)</label>
            <div class="clearfix"></div>
            <h5>Color</h5>
            <label>
                <input type="checkbox" value="">
                White (5412)</label>
            <label>
                <input type="checkbox" value="">
                Black (142)</label>
            <label>
                <input type="checkbox" value="">
                Silver (7845)</label>
            <label>
                <input type="checkbox" value="">
                Grey (415)</label>
            <label>
                <input type="checkbox" value="">
                Red (1478)</label>
            <label>
                <input type="checkbox" value="">
                Blue (954)</label>
            <div class="clearfix"></div>
            <h5>Doors</h5>
            <label>
                <input type="checkbox" value="">
                4 door (5412)</label>
            <label>
                <input type="checkbox" value="">
                5+ door (142)</label>
            <label>
                <input type="checkbox" value="">
                2 door (7845)</label>
            <label>
                <input type="checkbox" value="">
                3 door (415)</label>
            <div class="clearfix"></div>
            <h5>No. Of Cylinders</h5>
            <label>
                <input type="checkbox" value="">
                4 (5412)</label>
            <label>
                <input type="checkbox" value="">
                6 (575)</label>
            <label>
                <input type="checkbox" value="">
                8 (52)</label>
            <label>
                <input type="checkbox" value="">
                12 (589)</label>
            <label>
                <input type="checkbox" value="">
                5 (842)</label>
            <label>
                <input type="checkbox" value="">
                3 (211)</label>
            <label>
                <input type="checkbox" value="">
                10 (945)</label>
            <label>
                <input type="checkbox" value="">
                Unknown (1457)</label>
            <div class="clearfix"></div>
            <h5>Technical Features</h5>
            <label>
                <input type="checkbox" value="">
                Front Airbags (5412)</label>
            <label>
                <input type="checkbox" value="">
                Power Steering (142)</label>
            <label>
                <input type="checkbox" value="">
                Anti-Lock Barkes / ABS (7845)</label>
            <label>
                <input type="checkbox" value="">
                Side Airbags (415)</label>
            <label>
                <input type="checkbox" value="">
                Dual Exhaus (1478)</label>
            <label>
                <input type="checkbox" value="">
                4 Wheel Drive (954)</label>
            <div class="clearfix"></div>
            <h5>Extras</h5>
            <label>
                <input type="checkbox" value="">
                Air Conditioning (5412)</label>
            <label>
                <input type="checkbox" value="">
                AM/FM Radio (142)</label>
            <label>
                <input type="checkbox" value="">
                Power Locks (7845)</label>
            <label>
                <input type="checkbox" value="">
                Power Windows (415)</label>
            <label>
                <input type="checkbox" value="">
                CD Player (1478)</label>
            <label>
                <input type="checkbox" value="">
                Power Mirrors (954)</label>
            <div class="clearfix"></div>
            <h5>Horsepower</h5>
            <label>
                <input type="checkbox" value="">
                Less than 150 HP (5412)</label>
            <label>
                <input type="checkbox" value="">
                150 - 200 HP (142)</label>
            <label>
                <input type="checkbox" value="">
                200 - 300 HP (7845)</label>
            <label>
                <input type="checkbox" value="">
                300 - 400 HP (415)</label>
            <label>
                <input type="checkbox" value="">
                400 - 500 HP (1478)</label>
            <div class="clearfix"></div>
            <h5>Addes</h5>
            <label>
                <input type="checkbox" value="">
                Today</label>
            <label>
                <input type="checkbox" value="">
                Within 3 Days</label>
            <label>
                <input type="checkbox" value="">
                Within 1 week</label>
            <label>
                <input type="checkbox" value="">
                Within 2 week</label>
            <label>
                <input type="checkbox" value="">
                Within 1 Month</label>
            <label>
                <input type="checkbox" value="">
                Within 3 Months</label>
            <label>
                <input type="checkbox" value="">
                Within 6 Months</label>
            <label>
                <input type="checkbox" value="">
                All</label>
            <div class="clearfix"></div>
            <h5>Trasmission Type</h5>
            <label>
                <input type="checkbox" value="">
                Automatic Transmission (33)</label>
            <label>
                <input type="checkbox" value="">
                Manual Transmission (3)</label>
            <div class="clearfix"></div>
            <h5>Warranty</h5>
            <label>
                <input type="checkbox" value="">
                Does not apply (13)</label>
            <label>
                <input type="checkbox" value="">
                No (45)</label>
            <label>
                <input type="checkbox" value="">
                Yes (12)</label>
            <div class="clearfix"></div>
            <h5>Fuel Type</h5>
            <label>
                <input type="checkbox" value="">
                Gasonline (36)</label>
            <div class="clearfix"></div>
            <h5>Regional Specs</h5>
            <label>
                <input type="checkbox" value="">
                GCC Specs (13)</label>
            <label>
                <input type="checkbox" value="">
                Other (45)</label>
            <label>
                <input type="checkbox" value="">
                North American Specs (12)</label>
            <label>
                <input type="checkbox" value="">
                Japanese Specs (41)</label>
            <div class="clearfix"></div>
            <h5>Photos</h5>
            <label>
                <input type="checkbox" value="">
                Show ads with photo only (36)</label>
            <div class="center margintop">
                <input type="submit" value="Update Search">
            </div>
        </form>
    </div>

    <div class="col-md-9 categoryright">
        <h2>{{count($allAddFromDb) }} Ads</h2>
        <!--        <div class="col-md-6 padleft alignleft">
                    <p>Browse results in: Dubai</p>
                </div>
                <div class="col-md-6 padleft alignright">
                    <p>Page 1 of 53</p>
                </div>-->


        <!--        <div class="inventorylisting">     
                    <div class="col-md-6 padleft alignleft">
                        <div class="title">BMW 530I WHITE 2004</div>
                    </div>
                    <div class="price padright alignright">AED 19,000</div>
                    <div class="clearfix"><br></div>
                    <div class="col-md-4 padleft"> <a href="detail.php"><img src="images/usedcars1.jpg" alt=""></a></div>
                    <div class="col-md-8 padright inventorydetail">
                        <h4> Dubai > Motors > Used Cars for Sale > BMW > 5-Series > Details</h4>
                        <div class="date">17 August 2016</div>
                        <div class="clearfix separator"></div>
                        <div class="col-md-6 padleft makemodel"><strong>Make/Model:</strong> GMC Terrain</div>
                        <div class="col-md-6 padright"><strong>Doors:</strong> 5+ doors</div>
                        <div class="clearfix separator"></div>
                        <div class="col-md-6 padleft"><strong>Year:</strong> 2008</div>
                        <div class="col-md-6 padright"><strong>Color: White</strong></div>
                        <div class="clearfix separator"></div>
                        <p><strong>Kilometers:</strong> 128,000</p>
                        <div class="col-md-10 padleft location">Located : UAE ‪>‪ Dubai ‪>‪ JBR Jumeirah Beach Residence</div>
                        <div class="col-md-2 flag">
                            <ul>
                                <li><a href="javascript::"><img src="images/star.png" alt="rating"></a></li>
                                <li><a href="javascript::"><img src="images/flag.png" alt="flaq"></a></li>
                            </ul>
                        </div>
                    </div>
        
                    <div class="clearfix"></div>
        
                </div>-->



        @foreach( $allAddFromDb as $ad)
        <div class="inventorylisting">     
            <div class="col-md-6 padleft alignleft">
                <div class="title">{{$ad->title}}</div>
            </div>
            <div class="price padright alignright">AED {{number_format($ad->price,0)}}</div>
            <div class="clearfix"><br></div>
            <div class="col-md-4 padleft"> <a href="javascript::"><img src="{{ $ad->ad_image[0]}}" alt=""></a> </div>
            <div class="col-md-8 padright inventorydetail">
                <h4> {{$ad->description}}</h4>
                <div class="date">{{$ad->created_at->format('d M Y')}}</div>
                <div class="clearfix separator"></div>
                <div class="col-md-6 padleft makemodel"><strong>Creator:</strong> {{$ad->user->first_name}}</div>
  <!--              <div class="col-md-6 padright"><strong>Doors:</strong> 5+ doors</div>-->
                <div class="clearfix separator"></div>
                <div class="clearfix separator"></div>
                <div class="col-md-6 padleft"><strong>Year:</strong> {{$ad->year}}</div>
                <div class="clearfix separator"></div>
                <div class="clearfix separator "></div>
                <!--  
                <div class="col-md-6 padright"><strong>Color: White</strong></div>
                
                <p><strong>Kilometers:</strong> 128,000</p>
                <div class="col-md-10 padleft location">Located : UAE ‪>‪ Dubai ‪>‪ JBR Jumeirah Beach Residence</div>-->
                <div class="col-md-2 flag">
                    <ul>
                        <li><a href="javascript::"><img src="{{frontend_asset('images/star.png')}}" alt="rating"></a></li>
                        <li><a href="javascript::"><img src="{{frontend_asset('images/flag.png')}}" alt="flaq"></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        @endforeach






        <!--        <div class="inventorylisting">     
                    <div class="col-md-6 padleft alignleft">
                        <div class="title">BMW 530I WHITE 2004</div>
                    </div>
                    <div class="price padright alignright">AED 19,000</div>
                    <div class="clearfix"><br></div>
                    <div class="col-md-4 padleft"> <img src="images/usedcars16.jpg" alt=""> </div>
                    <div class="col-md-8 padright inventorydetail">
                        <h4> Dubai > Motors > Used Cars for Sale > BMW > 5-Series > Details</h4>
                        <div class="date">17 August 2016</div>
                        <div class="clearfix separator"></div>
                        <div class="col-md-6 padleft makemodel"><strong>Make/Model:</strong> GMC Terrain</div>
                        <div class="col-md-6 padright"><strong>Doors:</strong> 5+ doors</div>
                        <div class="clearfix separator"></div>
                        <div class="col-md-6 padleft"><strong>Year:</strong> 2008</div>
                        <div class="col-md-6 padright"><strong>Color: White</strong></div>
                        <div class="clearfix separator"></div>
                        <p><strong>Kilometers:</strong> 128,000</p>
                        <div class="col-md-10 padleft location">Located : UAE ‪>‪ Dubai ‪>‪ JBR Jumeirah Beach Residence</div>
                        <div class="col-md-2 flag">
                            <ul>
                                <li><a href="javascript::"><img src="images/star.png" alt="rating"></a></li>
                                <li><a href="javascript::"><img src="images/flag.png" alt="flaq"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>-->



        <!------------ Pagination -------------------------->

<!--        <div class="pagination"><a href=""><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>

            <a href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a>


            <a href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">4</a>


            <a href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a>

            <a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>-->


    </div>
</div>
@endsection