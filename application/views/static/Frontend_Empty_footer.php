 <!-- container-scroller -->
  <!-- base:js -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
var base_url={baseurl:"/<?php echo base_url();?>"};
// alert(base_url);
</script>

<!-- Start Block 6 -->
         <!--    <div class="call-action-bar bg">
                <div class="container">
                    <div class="download-box dark">
                        <div class="top">
                            <h2>Download now</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                        <div class="bottom">
                            <div class="star-box"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </div>
                            <p class="small">Based on 3,000+ reviews</p>
                            <div class="button-box"> <a href="#"><img src="/<?php echo base_url();?>assets/forntend/images/google-play.png" alt=""></a> <a href="#"><img src="/<?php echo base_url();?>assets/forntend/images/apple-icon-black.png" alt=""></a> </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- End Block 6 --> 

            <!-- ==============================================
**Partners**
=================================================== -->
        <section class="brands background-img-brands mr-2">
            <div class="container">
                 <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mb-4 ">
                        <h2>Happy <span class="bulecolor">Clients </span> </h2>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p> -->
                    </div>
                </div>
                <ul id="owl-brands" class="owl-carousel">
                    
                    <?php  if(isset($clientlogos)){
                     foreach($clientlogos as $row => $data) {  ?> 

                    <li class="brandslist-class"><a href="<?php  echo $data->clientlogo_url; ?>" target="_blank"><img src="/<?php echo base_url();?><?php echo $data->clientlogo_image; ?>" class="img-fluid" alt=" <?php echo $data->clientlogo_image_alt; ?> "> </a></li>

                     <?php } } ?>

                   <!--    <li><a href="#"><img src="/<?php echo base_url();?>assets/images/banners/download1.png" class="img-fluid" alt=""></a></a></li>
                    <li><a href="#"><img src="/<?php echo base_url();?>assets/images/banners/download2.png" class="img-fluid" alt=""></a></a></li>
                    <li><a href="#"><img src="/<?php echo base_url();?>assets/images/banners/download3.png" class="img-fluid" alt=""></a></a></li> -->

                </ul>
            </div>
        </section>

<!-- ==============================================
**Footer opt1**
=================================================== -->
        <footer class="footer dark-bg">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-4 mob-acco">
                            <div class="quick-links">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="/<?php echo base_url();?>Home">Home</a></li>
                                    <li><a href="/<?php echo base_url();?>About-Us">About Us</a></li>
                                    <li><a href="/<?php echo base_url();?>Our-Products">Our Products</a></li>
                                    <li><a href="/<?php echo base_url();?>Clients-Projects">Clients Projects</a></li>
                                    <li><a href="/<?php echo base_url();?>Gallery">Gallery</a></li>
                                    <!-- <li><a href="/<?php echo base_url();?>Our-Team">Our Team</a></li> -->

                                    <li><a href="/<?php echo base_url();?>Careers">Career</a></li>
                                    <li><a href="/<?php echo base_url();?>Contact-Us">Contact Us</a></li>
                                    <li><a href="/<?php echo base_url();?>Privacy-Policy">Privacy Policy</a></li>
                                </ul>
                            </div>
                            <div class="connect-outer">
                                <h4>Connect with Us</h4>
                                <ul class="connect-us">
                                    <li><a href="https://m.facebook.com/BizBrainz-Technologies-pvtltd-107669170581623/" target="_blank" ><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="https://twitter.com/brainzbiz/status/1215980946169532418?s=21" target="_blank" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/bizbrianz" target="_blank" ><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                     <!--<li><a href="#" target="_blank" ><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> -->
                                    <li><a href="https://www.youtube.com/channel/UCPunyt8SF3oBKu5oz3YWhAQ/playlists" target="_blank" ><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.instagram.com/bizbrainztechnologiespvt.ltd/?r=nametag" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mob-acco">
                            <div class="recent-post">
                                <h4>Location Map</h4>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.3299430578986!2d78.47896781418838!3d17.443915205765368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9be0a4333cdf%3A0xb60adfaceecf4f37!2sBizBrainz%20Technologies%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1578653318153!5m2!1sen!2sin" height="330" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <div class="subscribe">
                                 <h4>Corporate Office :</h4>
                                 <p>Flat No.16, Paigah Apartments, S.P Road, Opp Ashok Bhopal Chambers, Secunderabad, Telangana 500003.</p>
                                  <h4>Branch Office :</h4>
                                  <p>Sai Colony, MP Prakash Nagar, Hospet, Karnataka 583201.</p> 
                                 <h4>Mobile No :</h4>
                                  <p>For Business : &nbsp; +91 &nbsp;  8196 98 98 98.<br>For Tech Support : &nbsp; +91 &nbsp;  906 99 45 999.</p>
                                  <!-- <p>For Tech Support : &nbsp; +91 &nbsp;  906 99 45 999</p> -->
                                 <h4>Email :</h4> 
                                  <p>For Business : &nbsp; <a href="mailto:sales@bizbrainz.in" style="color:#8d9ca8;">sales@bizbrainz.in</a><br>
                                    For Tech Support : &nbsp; <a href="mailto:tech@bizbrainz.in" style="color:#8d9ca8;">tech@bizbrainz.in</a></p>
                                
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="container"> Copyright © 2019 <a href="http://bizbrainz.in/" target="_blank">Bizbrainz Technologies Private Limited </a> All Rights Reserved. </div>
            </div>
        </footer>

        <!-- Scroll to top --> 
        <a href="#" class="scroll-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a> 
        <!-- jQuery first, then Popper.js, then Bootstrap JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/js/jquery.min.js"></script> 
        <!-- Popper JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/js/popper.min.js"></script> 
        <!-- Bootsrap JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/bootstrap/js/bootstrap.min.js"></script> 
        <!-- Select2 JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/select2/js/select2.min.js"></script> 
        <!-- Bxslider JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/bxslider/js/bxslider.min.js"></script> 
        <!-- Owl Carousal JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/owl-carousel/js/owl.carousel.min.js"></script> 
        <!-- Video Popup JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/magnific-popup/js/magnific-popup.min.js"></script> 
       
         <!-- Waypoints JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/waypoints/js/waypoints.min.js"></script> 

         <!-- Counter Up JS --> 
          <!-- Bxslider JS --> 
        <script src="/<?php echo base_url();?>assets/forntend/bxslider/js/bxslider.min.js"></script> 
        <script src="/<?php echo base_url();?>assets/forntend/counterup/js/counterup.min.js"></script>
        <script src="/<?php echo base_url();?>assets/forntend/matchHeight/js/matchHeight-min.js"></script> 
        <script src="/<?php echo base_url();?>assets/forntend/isotope/js/isotope.min.js"></script>
     
        <!-- Custom JS --> 
         <script src="/<?php echo base_url();?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
       <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script> 
        <script src="/<?php echo base_url();?>assets/forntend/js/custom.js"></script>
       <!--  <script src="/<?php echo base_url();?>assets/js/Common/LoginController.js"></script> -->
        <script src="/<?php echo base_url();?>assets/js/Common/ProjectFrontViewController.js"></script>
        <script src="/<?php echo base_url();?>assets/js/Common/FrontViewController.js"></script>
        <script src="/<?php echo base_url();?>assets/js/Common/JobApplyController.js"></script>
        <script src="/<?php echo base_url();?>assets/js/Common/ContactFormController.js"></script>
    </body>
</html>


 <script type="text/javascript">
    $(function(){
    // this will get the full URL at the address bar
    var url = window.location.href; 
    // passes on every "a" tag 
    $(".navbar-nav > li a").each(function() {
            // checks if its the same on the address bar
        if(url == (this.href)) { 
            $(this).closest("a").addClass("active");
        }
    });
});
    </script> 


    <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e32977edaaca76c6fd09509/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


<script type="text/javascript">
    
      var $element = $('.banner-carousel .owl-carousel');
        if ($element.length > 0) {
            $element.owlCarousel({
                loop: true,
                margin: 30,
                navText: ['', ''],
                nav: true,
                autoplay: true,
                smartSpeed: 500,
                responsive: {
                    0: {
                        items: 1
                    },

                    768: {
                        items: 1,
                        margin: 20
                    },
                },
                
            navText: ['<i class="icon-know-more-arrow" ></i>', '<i class="icon-know-more-arrow " ></i>'],
                navigation: true,
                controls: true,
                autoPlay: false,
                scrollPerPage: true,
                autoHeight:true
            });
        }


var $element = $('.brands .owl-carousel');
        if ($element.length > 0) {
            $element.owlCarousel({
                loop: true,
                margin: 30,
                navText: ['', ''],
                nav: true,
                dots: false,
                autoplay: true,
                smartSpeed: 500,
                responsive: {
                    0: {
                        items: 2
                    },
                    480: {
                        items: 3,
                        margin: 20
                    },
                    768: {
                        items: 4,
                        margin: 20
                    },
                    1024: {
                        items: 4,
                        margin: 30
                    },
                    1200: {
                        items: 4,
                        margin: 30
                    },
                },

                  navText: ['<i class="icon-know-more-arrow" ></i>', '<i class="icon-know-more-arrow " ></i>'],
            });
        }
</script>
