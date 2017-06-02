<?php
// include db conn class
// require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/db_conn.php';

$database=new db_conn();
if($database->connect_errno){
	echo "connect failed";
}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Home</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" /><!-- Bootstrap Styles-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" /><!-- FontAwesome Styles-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" /><!-- Morris Chart Styles-->
  <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" /><!-- Custom Styles-->
  <link href="assets/css/custom-styles.css" rel="stylesheet" /><!-- Google Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css" />
</head>

<body>
  <div id="wrapper">
    <nav class="navbar navbar-default top-navbar" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=
        ".sidebar-collapse"><span class="sr-only">Toggle navigation</span></button> <a class="navbar-brand waves-effect waves-dark"
        href="index.html"><i class="large material-icons">insert_chart</i> <strong>健康监护系统</strong></a>

        <div id="sideNav" href="">
          <i class="material-icons dp48">toc</i>
        </div>
      </div>
    </nav>

    <nav class="navbar-default navbar-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
          <li>
            <a href="sociological_analyze.php" class="waves-effect waves-dark">社会学算法</a>
          </li>

          <li>
            <a href="medical_analyze.php" class="active-menu waves-effect waves-dark">医学算法</a>
          </li>
        </ul>
      </div>
    </nav><!-- /. NAV SIDE  -->

    <div id="page-wrapper">
      <div class="header">
        <h1 class="page-header">医学算法</h1>
      </div>

      <div id="page-inner">

        <div class="row">
          <div class="col-md-12">
            <div class="card-panel text-center">
              <h1>算法描述</h1><br />

              <p>asdfasldkjalksdjgl asdjlgj</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-image">
                <div id="gender-donut-chart"></div>
              </div>

              <div class="card-action">
                <b>性别分布</b>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-image">
                <div id="heart-rate-donut-chart"></div>
              </div>

              <div class="card-action">
                <b>心率分布</b>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-image">
                <div id="spo2h-donut-chart"></div>
              </div>

              <div class="card-action">
                <b>血氧分布</b>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card-panel text-center">
              <h1>数据分析</h1><br />

              <p>asdfasldkjalksdjgl asdjlgj</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- JS Scripts-->
  <!-- jQuery Js -->
  <script src="assets/js/jquery-1.10.2.js" /> <!-- Bootstrap Js -->
   <script src="assets/js/bootstrap.min.js">
</script> <script src="assets/materialize/js/materialize.min.js">
</script> <!-- Metis Menu Js -->
   <script src="assets/js/jquery.metisMenu.js">
</script> <!-- Morris Chart Js -->
   <script src="assets/js/morris/raphael-2.1.0.min.js">
</script> <script src="assets/js/morris/morris.js">
</script> <script src="assets/js/easypiechart.js">
</script> <script src="assets/js/easypiechart-data.js">
</script> <script src="assets/js/Lightweight-Chart/jquery.chart.js">
</script> <!-- Custom Js -->
	<script>
	(function ($) {
    "use strict";
    var mainApp = {

        initFunction: function () {
            /*MENU 
            ------------------------------------*/
            $('#main-menu').metisMenu();
			
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });

            /* MORRIS BAR CHART
			-----------------------------------------*/

            /* MORRIS DONUT CHART
			----------------------------------------*/
            Morris.Donut({
                element: 'gender-donut-chart',
                data: 
				<?php
                  $gender_dist_array=
					array(
						array(
							"label"=>"男性",
							"where"=>"=1",
							"value"=>0
						),
						array(
							"label"=>"女性",
							"where"=>"=2",
							"value"=>0
						)
					);
				  $sql="select count(*) as total from user_info where gender?";
                  foreach ($gender_dist_array as $index=>$slice){
                    $final_sql=str_replace("?",$slice["where"],$sql);
                    $query=$database->query($final_sql);
                    if($query){
                      $row=$query->fetch_assoc();
                      $gender_dist_array[$index]["value"]=$row['total'];
                    }
                  }
				  echo json_encode($gender_dist_array);
				  echo ",colors: [
				  '#1565C0','#AD1457'
				  ],
                  resize: true});\n\n"
				?>
				
			Morris.Donut({
                element: 'spo2h-donut-chart',
                data: 
				<?php
                  $spo2h_rate_dist_array=
					array(
						array(
							"label"=>"正常",
							"where"=>"average_stats>=86 and average_stats<=95",
							"value"=>0
						),
						array(
							"label"=>"醉氧",
							"where"=>"average_stats>95",
							"value"=>0
						),
						array(
							"label"=>"血氧过低",
							"where"=>"average_stats<86",
							"value"=>0
						)
					);
				  $sql="select count(*) as total from user_health_event where body_sign='spo2h' and ?";
                  foreach ($spo2h_rate_dist_array as $index=>$slice){
                    $final_sql=str_replace("?",$slice["where"],$sql);
                    $query=$database->query($final_sql);
                    if($query){
                      $row=$query->fetch_assoc();
                      $spo2h_rate_dist_array[$index]["value"]=$row['total'];
                    }
                  }
				  echo json_encode($spo2h_rate_dist_array);
				  echo ",colors: [
				  '#283593','#2E7D32','#F9A825' 
				  ],
                  resize: true});\n\n"
				?>
				
			Morris.Donut({
                element: 'heart-rate-donut-chart',
                data: 
				<?php
                  $heart_rate_dist_array=
					array(
						array(
							"label"=>"心律过低",
							"where"=>"average_stats<80",
							"value"=>0
						),
						array(
							"label"=>"正常",
							"where"=>"average_stats>=80 and average_stats<=120",
							"value"=>0
						),
						array(
							"label"=>"心律过高",
							"where"=>"average_stats>120",
							"value"=>0
						)
					);
				  $sql="select count(*) as total from user_health_event where body_sign='heart_rate' and ?";
                  foreach ($heart_rate_dist_array as $index=>$slice){
                    $final_sql=str_replace("?",$slice["where"],$sql);
                    $query=$database->query($final_sql);
                    if($query){
                      $row=$query->fetch_assoc();
                      $heart_rate_dist_array[$index]["value"]=$row['total'];
                    }
                  }
				  echo json_encode($heart_rate_dist_array);
				  echo ",colors: [
				  '#283593','#2E7D32','#F9A825' 
				  ],
                  resize: true});\n\n"
				?>

            /* MORRIS AREA CHART
			----------------------------------------*/

            /* MORRIS LINE CHART
			----------------------------------------*/
           
        
            $('.bar-chart').cssCharts({type:"bar"});
            $('.donut-chart').cssCharts({type:"donut"}).trigger('show-donut-chart');
            $('.line-chart').cssCharts({type:"line"});

            $('.pie-thychart').cssCharts({type:"pie"});
       
	 
        },

        initialization: function () {
            mainApp.initFunction();

        }

    }
    // Initializing ///

    $(document).ready(function () {
		$(".dropdown-button").dropdown();
		$("#sideNav").click(function(){
			if($(this).hasClass('closed')){
				$('.navbar-side').animate({left: '0px'});
				$(this).removeClass('closed');
				$('#page-wrapper').animate({'margin-left' : '260px'});
				
			}
			else{
			    $(this).addClass('closed');
				$('.navbar-side').animate({left: '-260px'});
				$('#page-wrapper').animate({'margin-left' : '0px'}); 
			}
		});
		
        mainApp.initFunction(); 
    });

	$(".dropdown-button").dropdown();
	
}(jQuery));
</script>
</script>
</body>
</html>
