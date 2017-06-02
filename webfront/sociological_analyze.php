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
            <a href="sociological_analyze.php" class="active-menu waves-effect waves-dark">社会学算法</a>
          </li>

          <li>
            <a href="medical_analyze.php" class="waves-effect waves-dark">医学算法</a>
          </li>
        </ul>
      </div>
    </nav>

    <div id="page-wrapper">
      <div class="header">
        <h1 class="page-header">社会学算法</h1>
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
                <div id="income-donut-chart"></div>
              </div>

              <div class="card-action">
                <b>收入分布</b>
              </div>
            </div>
          </div>

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
                <div id="education-donut-chart"></div>
              </div>

              <div class="card-action">
                <b>教育时长分布</b>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-image">
                <div id="trust-donut-chart"></div>
              </div>

              <div class="card-action">
                <b>信任程度分布</b>
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
      </div><!-- /. PAGE INNER  -->
    </div><!-- /. PAGE WRAPPER  -->
  </div><!-- /. WRAPPER  -->
  <!-- JS Scripts-->
  <!-- jQuery Js -->
  <script src="assets/js/jquery-1.10.2.js">
</script> <!-- Bootstrap Js -->
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

            /* MORRIS DONUT CHART
                        ----------------------------------------*/
            Morris.Donut({
                element: 'trust-donut-chart',
                data: 
				<?php
                  $trust_dist_array=
					array(
						array(
							"label"=>"信任",
							"where"=>"<4",
							"value"=>0
						),
						array(
							"label"=>"不信任",
							"where"=>">3",
							"value"=>0
						)
					);
				  $sql="select count(*) as total from user_info where trust?";
                  foreach ($trust_dist_array as $index=>$slice){
                    $final_sql=str_replace("?",$slice["where"],$sql);
                    $query=$database->query($final_sql);
                    if($query){
                      $row=$query->fetch_assoc();
                      $trust_dist_array[$index]["value"]=$row['total'];
                    }
                  }
				  echo json_encode($trust_dist_array);
				  echo ",colors: [
				  '#2E7D32','#EF6C00'
				  ],
                  resize: true});\n\n"
				?>
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
                element: 'income-donut-chart',
                data: 
				<?php
                  $income_dist_array=
					array(
						array(
							"label"=>"低收入",
							"where"=>"annual_income < 2.4",
							"value"=>0
						),
						array(
							"label"=>"中等收入",
							"where"=>"annual_income >= 2.4 and annual_income < 24",
							"value"=>0
						),
						array(
							"label"=>"高收入",
							"where"=>"annual_income > 24",
							"value"=>0
						)
					);
				  $sql="select count(*) as total from user_info where ?";
                  foreach ($income_dist_array as $index=>$slice){
                    $final_sql=str_replace("?",$slice["where"],$sql);
                    $query=$database->query($final_sql);
                    if($query){
                      $row=$query->fetch_assoc();
                      $income_dist_array[$index]["value"]=$row['total'];
                    }
                  }
				  echo json_encode($income_dist_array);
				  echo ",colors: [
				  '#283593','#558B2F','#EF6C00' 
				  ],
                  resize: true});\n\n"
				?>
				
			Morris.Donut({
                element: 'education-donut-chart',
                data: 
				<?php
                  $education_dist_array=
					array(
						array(
							"label"=>"小学",
							"where"=>"education_status <= 3",
							"value"=>0
						),
						array(
							"label"=>"初中",
							"where"=>"education_status <= 4 and education_status > 3",
							"value"=>0
						),
						array(
							"label"=>"高中",
							"where"=>"education_status <= 6 and education_status > 4",
							"value"=>0
						),
						array(
							"label"=>"大学",
							"where"=>"education_status <= 8 and education_status > 6",
							"value"=>0
						),
						array(
							"label"=>"研究生",
							"where"=>"education_status > 8",
							"value"=>0
						)
					);
				  $sql="select count(*) as total from user_info where ?";
                  foreach ($education_dist_array as $index=>$slice){
                    $final_sql=str_replace("?",$slice["where"],$sql);
                    $query=$database->query($final_sql);
                    if($query){
                      $row=$query->fetch_assoc();
                      $education_dist_array[$index]["value"]=$row['total'];
                    }
                  }
				  echo json_encode($education_dist_array);
				  echo ",colors: [
				  '#4527A0','#0277BD','#2E7D32','#F9A825','#D84315'
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
</body>
</html>
