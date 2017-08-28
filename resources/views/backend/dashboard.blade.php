@extends( 'backend.layouts.app' )

@section('title', 'Dashboard')

@section('JSLibraries')
<script src="{{ backend_asset('libraries/Chart.js/dist/Chart.min.js') }}"></script>
@endsection

@section('inlineJS')
  <script>




function showStats(){


var userId, brandTitle ;
var userCheckbox = '';
$.ajax({
type: "GET",
async: false,
dataType: "json",
url: '/smartmart/api/stats/user',
data: {},
success:
function(data) {


    var result			          = data['Result'];
    var total_users                 =  data['Result']['total_users'];
    var total_active_users          =  data['Result']['total_active_users'];
    var total_blocked_users         =  data['Result']['total_blocked_users'];
    var total_android_users         =  data['Result']['total_android_users'];
    var total_android_users_percentage   =  data['Result']['total_android_users_percentage'];
    var total_ios_users             =  data['Result']['total_ios_users'];
    var total_ios_users_percentage  =  data['Result']['total_ios_users_percentage'];
    var total_web_users             =  data['Result']['total_web_users'];
    var total_web_users_percentage  =  data['Result']['total_web_users_percentage'];
    var total_fb_users              =  data['Result']['total_fb_users'];
	var total_trips              =  data['Result']['total_trips'];


    $('#totalUser').html(total_users);
    $('#totalAndroidUser').html(total_android_users);
    $('#totalIosUser').html(total_ios_users);
    $('#totalWebUser').html(total_web_users);
    $('#totalActiveUser').html(total_trips);
    $('#totalblockedUser').html(total_blocked_users);

    var labels = '"Adndroid" , "Ios" , "Web"';
    var labelsValue = '"'+total_android_users +'","'+total_ios_users+'","'+total_web_users+'"';


          //populateDonutChart(total_android_users,total_ios_users,total_web_users);
        populateDonutChart(total_android_users,total_ios_users);




  }
  });
  //$('#userCheckbox').html(userCheckbox);
  }

  $( document ).ready(function() {  showStats(); });

    function populateDonutChart(total_android_users,total_ios_users) {

      var options = {
        legend: false,
        responsive: false
      };

      new Chart(document.getElementById("canvas1"), {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: {
          labels: [
            "Android",
            "iOs"
          ],
          datasets: [{
            data: [total_android_users,total_ios_users],
            backgroundColor: [
              "#BDC3C7",
              "#9B59B6",
              "#26B99A",
              "#E74C3C",

              "#3498DB"
            ],
            hoverBackgroundColor: [
              "#CFD4D8",
              "#49A9EA",

              "#36CAAB",
              "#E95E4F",
              "#B370CF",


            ]
          }]
        },
        options: options
      });

    }
</script>
  @endsection


@section('content')

       <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count" id="totalUser"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Android Users</span>
              <div class="count" id="totalAndroidUser"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Ios Users</span>
              <div class="count " id="totalIosUser">0</div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Orders</span>
              <div class="count" id="totalActiveUser"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top" ><i class="fa fa-user"></i> Total Blocked User</span>
              <div class="count" id="totalblockedUser"></div>
            </div>
          </div>
          <!-- /top tiles -->



          <div class="row" style="display: none;">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">


            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Registered Platform</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">

                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">

                    <tr>
                      <td>
                        <canvas id="canvas1" height="240" width="240" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">

                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Android </p>
                            </td>

                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>iOS </p>
                            </td>

                          </tr>

                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            
          </div>



        </div>

	 
	            <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        <!-- /#page-wrapper -->

@endsection