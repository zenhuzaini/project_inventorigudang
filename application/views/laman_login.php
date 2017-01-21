<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Masuk Sistem Inventory Lab</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/ASETLAIN/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/ASETLAIN/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/ASETLAIN/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/ASETLAIN/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>
	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="<?php echo base_url().'index.php/C_project/login_user/'?>" method="post">
		        <h2 class="form-login-heading">Masuk Sistem Utama<br><strong>INVENTORY BARANG</strong></h2>
		        <div class="login-wrap">
		            <input type="text" name="username" id="username" class="form-control" placeholder="User ID" autofocus>
		            <br>
		            <input type="password" name="userpwd" id="userpwd" class="form-control" placeholder="Password">
		            <hr>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> MASUK </button>
		            <!-- <button class="btn btn-theme btn-block" href="" type="submit"><i class="fa fa-lock"></i> Register </button> -->

		        </div>
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="<?php echo base_url();?>ASETLAIN/assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("<?php echo base_url().'assets/ASETLAIN/img/portfolio/d6.png'?>", {speed: 700});
    </script>


  </body>
</html>
