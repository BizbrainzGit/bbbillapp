<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="google" content="notranslate" class=notranslate />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="-1" />
                 
         <?php   
         if(isset($metalinks)&&count($metalinks)>0){
              foreach($metalinks as $row => $data) {  
                 if($row==0){?> 

                         <title><?php echo $data->menu_titletag;  ?></title>
                         <meta name="keywords" content=" <?php echo $data->menu_metakeyword;?> ">
                         <meta name="description" content=" <?php echo $data->menu_metadescription;?> ">
                         

          <?php } } }else{ ?>
                         
                           <title>Bizbrainz Technologies Pvt Ltd:Business Development and IT services Company.</title>
                           <meta name="keywords" content="website design,website design services,website design company,website development,website development company,website development services,digital marketing,SEO,search enginee optimization,SMM,social Media Marketing,pay per click,PPC,Pay per click,online marketing,internet marketing,Logo design,logo design online,logo design services,Creative logo design,logo makers,mobile applications,mobile app development,app promotions,android app development,IOS app development,app development,E-Commerce,e-commerce websites,e-commerce services,domain and hosting,server maintenance,web hosting services,web maintenance.">
                           <meta name="description" content="We at Bizbrainz  is a  destination for businesses looking for the best IT services and Business Development. Our services Digital Marketing | Website Design |E-Commerce | Logo Designing| Mobile Applications| Server Maintenance.">
                       
          <?php } ?>

       <!--  <div id="menumetadatalist"></div> -->
         <!-- Favicon Link -->
        <link rel="shortcut icon" type="image/png" href="/<?php echo base_url();?>assets/images/BB_Icon.png">
        <!-- Bootstrap core CSS -->
        <link href="/<?php echo base_url();?>assets/forntend/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="/<?php echo base_url();?>assets/forntend/select2/css/select2.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="/<?php echo base_url();?>assets/forntend/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        
        <!-- Animate -->
        <link href="/<?php echo base_url();?>assets/forntend/css/animate.css" rel="stylesheet">
        <!-- Owl Carousel -->
        <link href="/<?php echo base_url();?>assets/forntend/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
        <!-- Video Popup -->
        <link href="/<?php echo base_url();?>assets/forntend/magnific-popup/css/magnific-popup.css" rel="stylesheet">
        <!-- Iconmoon -->
        <link href="/<?php echo base_url();?>assets/forntend/iconmoon/css/iconmoon.css" rel="stylesheet">

        <!-- <link href="/<?php echo base_url();?>assets/forntend/css/scroll.css" rel="stylesheet" type="text/css"  media="all">
         <link rel="stylesheet" href="/<?php echo base_url();?>assets/wow/css/libs/animate.css"> -->
         
        <!-- Custom styles for this template -->
        <link href="/<?php echo base_url();?>assets/forntend/css/custom.css" rel="stylesheet">

        <link href="/<?php echo base_url();?>assets/forntend/css/customnew.css" rel="stylesheet">
        <style type="text/css">

     .background-img-brands{
  background-image: url("/<?php echo base_url();?>assets/images/background/background1.jpg");
  background-repeat: no-repeat;
  background-position:center;
  background-size: 100% 100%;
}

.navbar-right > li:last-child a {
    border-radius: 30px 30px 30px 30px;
    background: #57bce2;
}


   </style>
    </head>
    <body id="body-main">

<!-- ==============================================
**Preloader**
=================================================== -->
        <div id="loader">
            <div id="element">
                <div class="circ-one"></div>
                <div class="circ-two"></div>
            </div>
        </div>

<!-- ==============================================
**Header**
=================================================== -->
        <header class="sticky-top"> 
            <!-- Start Header top Bar -->
            <div class="header-top">
                <div class="container clearfix">
                    <div class="lang-wrapper"> 
                        <!-- <div id="google_translate_element"></div>  -->
                        <!-- <div class="select-lang"> 
                            <select class="currency_select">
                                <option value="usd">USD</option>
                                <option value="aud">AUD</option>
                                <option value="gbp">GBP</option>
                            </select>
                        </div>
                        <div class="select-lang2">
                            <select class="custom_select">
                                <option value="en">English</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                            </select>
                        </div> --> 

                    </div>
                      <div class="right-block clearfix">
                        <ul class="top-nav hidden-xs">
                            <li><a href="/<?php echo base_url();?>Contact-Us" ><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;  +91 8196 98 98 98</a></li>
                            <li><a href="/<?php echo base_url();?>Contact-Us" > <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; info@bizbrainz.in</a></li> 
                            <li><a href="https://goo.gl/maps/AbmRWMPRtdTJiswi8" target="_blank"> <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Location</a></li> 
                        </ul>
                        <ul class="follow-us hidden-xs">
                            <li><a href="https://m.facebook.com/BizBrainz-Technologies-pvtltd-107669170581623/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/brainzbiz/status/1215980946169532418?s=21" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                             <li><a href="https://www.linkedin.com/company/bizbrianz" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <!--<li><a href="" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> -->
                            <li><a href="https://www.youtube.com/channel/UCPunyt8SF3oBKu5oz3YWhAQ/playlists" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.instagram.com/bizbrainztechnologiespvt.ltd/?r=nametag" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Header top Bar --> 

            <!-- Start Navigation -->
        <!-- <div class="row clearfix" > -->
            <nav class="navbar navbar-expand-lg navbar-light" >
                <div class="container">
                 
                         <a class="navbar-brand"  href="/<?php echo base_url();?>Home"><img src="/<?php echo base_url();?>assets/images/BB_logo_400X180.png" alt="" height="80">
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                  
                    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"> 
                                <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="/<?php echo base_url();?>Home">Home</a>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="/<?php echo base_url();?>About-Us">AboutUs</a>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link dropdown-toggle" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown2" style="display: none;">
                                    <div class="inner">
                                     <?php   
                                   if(isset($servicestype)&&count($servicestype)>0){
                                      for($i=0; $i<count($servicestype); $i++){
                                         ?> 
                                     <a class="dropdown-item" href="/<?php echo base_url();?><?php echo $servicestype[$i]["service_url"]; ?>"><?php
                                     echo $servicestype[$i]["service_title"]; ?>
                                     </a>
                                     <?php 
                                    } }

                                    ?>

                                       <!--   <span id="servicesmenulist"></span> -->
                                    </div>
                                </div>
                            </li>

                             <li class="nav-item dropdown"> 
                                <a class="nav-link dropdown-toggle" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Portfolio</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown2">
                                    <div class="inner"> 
                                        <a class="dropdown-item" href="/<?php echo base_url();?>Our-Products">Our Products</a>
                                        <a class="dropdown-item" href="/<?php echo base_url();?>Clients-Projects">Client Projects</a>
                                    </div>
                                </div>
                            </li>
                           <!--  <li class="nav-item dropdown"> 
                                <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="/<?php echo base_url();?>Our-Team">Our Team</a>
                            </li> -->
                            <li class="nav-item dropdown"> 
                                <a class="nav-link" aria-haspopup="true" aria-expanded="false" href="/<?php echo base_url();?>Gallery">Gallery</a>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link" aria-haspopup="true" aria-expanded="false"  href="/<?php echo base_url();?>Careers">Careers</a>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link" aria-haspopup="true" aria-expanded="false"  href="/<?php echo base_url();?>Contact-Us">Contact </a>
                            </li>
                           
                        </ul>
                        <ul class="navbar-right d-flex">
                            <li><a href="/<?php echo base_url();?>login">Login</a></li>
                           <!--  <li><a href="login.html">Login</a></li> -->
                        </ul>
                    </div>
              
                 </div>
               
            </nav>
            <!-- End Navigation --> 
            <!-- </div> -->
        </header>


<div id="rightside-sidebar" class="sidenav">
  <a href="#" id="mobilenumber-sidebar"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; &nbsp; <span style="color: #467908;">+91 8196 98 98 98 </span></a>
  <a href="#" id="email-sidebar"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; &nbsp;<span style="color: #128FD0;">sales@bizbrainz.in </span></a>
</div>

 