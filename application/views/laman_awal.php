<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>INVENTORY LAB</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/ASETLAIN/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/ASETLAIN/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/ASETLAIN/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/ASETLAIN/lineicons/style.css">    
    <link href="assets/ASETLAIN/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <script src="assets/ASETLAIN/js/fancybox/jquery.fancybox.js"></script>  
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/ASETLAIN/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/ASETLAIN/css/style-responsive.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery-1.8.3.min.js"></script>
    <script src="assets/ASETLAIN/js/jquery-1.8.3.min.js"></script> 
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery.js"></script>

    <script>
        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('wakt').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>

    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="getTime()">

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Perbesar / perkecil tampilan"></div>
              </div>
            <!--logo start-->

            <a href="<?php echo base_url().'index.php/C_project/index'?>" class="logo"><img src="<?php echo base_url('assets/inventory.png')?>" width="20%"></a>

            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li></li> 
             
                    <li> <a class="logout" href="<?php echo base_url().'index.php/C_project/logout/'?>">LOGOUT</a></li>
            	</ul>
            </div>

        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
            
                  <h3 class="centered"><div id="wakt"></div></h3>
              	   

                  <h5 class="centered">Hi <?php
                  print_r($simpansession = $this->session->userdata('NAMA_ADMIN')); ?></h5>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Dara Inventori</span>
                      </a>
                      <ul class="sub">
                        
                          <li><a  href="<?php echo base_url().'index.php/C_project/barang/'?>">Data Barang</a></li>
                          <li><a  href="<?php echo base_url().'index.php/C_project_barangin/barangin/'?>">Data Barang Masuk</a></li>
                          <li><a  href="<?php echo base_url().'index.php/C_project_barangout/barangout/'?>">DataBrang Keluar</a></li>
                          <li><a  href="<?php echo base_url().'index.php/C_project_barangberubah/barangberubah/'?>">Data Barang Berubah</a></li>
  
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Komponen</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#">Galeri Gudang Inventory</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Tentang</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="https://www.fb.com/zenhuzainii">Profil Pengembang</a></li>
                          
                      </ul>
                  </li>
                  <!--
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Forms</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">Form Components</a></li>
                      </ul>
                  </li> -->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <?php
                include 'laman_isiawal.php';
              ?>
        
      <!-- ISI DISINI-->  
        <?php
         ?>                  
          </section>
      </section>

      

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <a href="http://www.zenhuzaini.blogspot.co.id">2016 - Zen aka theboyonfire</a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery-1.8.3.min.js"></script>
    <script src="assets/ASETLAIN/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url();?>assets/ASETLAIN/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="<?php echo base_url();?>assets/ASETLAIN/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/ASETLAIN/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/ASETLAIN/js/gritter-conf.js"></script>


  </body>
</html>
