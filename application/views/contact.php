<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Frontend_Empty_header.php');
?>
<style type="text/css">
    
    .contact-banner {
    background: url('/<?php echo base_url();?>assets/images/contact.jpg') no-repeat center top;
    text-align: center;
    min-height: 300px;
    position: relative;
    background-size: cover;
}


</style>
<!-- ==============================================
**Inner Banner**
=================================================== -->

      
<?php  if(isset($banner)&&count($banner)>0){
         foreach($banner as $row => $data)  {  if($row==0){ ?>
        <section class="inner-banner" style=" background: url('/<?php echo base_url();?><?php echo $data->image; ?>') no-repeat center fixed;
             background-size:100% 100%;">
            <div class="container">
                 <div class="contents">
                    <h1 style="font-size:60px;"><?php echo $data->banner_title;  ?></h1>
                    <p><?php echo $data->banner_content;  ?></span></p>
                </div>
            </div>
        </section>

       <?php } } }?>  
<!-- ==============================================
**Contact**
=================================================== -->
        <section class="padding-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 form-area">
                        <div class="contact-form-wrapper">
                            <form name="contact-form" id="ContactForm">
                                <div class="row">
                                     <div class="col-md-12 mt-4 mb-4">
                                        <h2>Get in <span class="bulecolor"> Touch </span> </h2>
                                     </div>
                                   
                                    <div class="col-md-6 input-col">
                                        <label>Your Name</label>
                                        <input name="your_name" id="your_name" placeholder="" type="text">
                                    </div>
                                    <div class="col-md-6 input-col">
                                        <label>Email Address</label>
                                        <input name="business_email" id="business_email" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-col">
                                        <label>Mobile Number</label>
                                        <input name="mobile_number" id="mobile_number" placeholder="" type="text">
                                    </div>
                                    <div class="col-md-6 input-col">
                                        <label>Company</label>
                                        <input name="company_name" id="company_name" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Message</label>
                                        <textarea name="message" id="message" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" id="addcontactform" class="btn submit">Submit</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="contactform-addmsg"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info-wrapper padding-lg ">
                            <div class="contact-info">
                                <h2>Contact <span class="bulecolor"> Info </span> </h2>
                                <ul class="info-contact-box">
                                    <li>
                                        <h6>Corporate Office &nbsp; : &nbsp;</h6>
                                        <p>Flat No.16, Paigah Apartments, S.P Road, Opp Ashok Bhopal Chambers, Secunderabad, Telangana 500003.</p> 
                                         <br>
                                        <h6>Branch Office &nbsp; : &nbsp;</h6>
                                        <p>Sai Colony, MP Prakash Nagar, Hospet, Karnataka 583201.</p>
                                    </li>
                                    <li>
                                        <h6> +91 &nbsp;  8196 98 98 98</h6>
                                    </li>
                                   
                                    <li>
                                        <a href="mailto:contactus@bizbrainz.in">info@bizbrainz.in</a>
                                     </li>
                                </ul>
                            </div>
                            <div class="social-media-box">
                                <h6><span>Connect with</span></h6>
                                <ul>
                                    <li><a href="https://m.facebook.com/BizBrainz-Technologies-pvtltd-107669170581623/"  target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.youtube.com/channel/UCPunyt8SF3oBKu5oz3YWhAQ/featured"  target="_blank" ><i class="fa fa-youtube-play" style="background-color:#ff0000"></i></a></li>
                                    <li><a href="https://twitter.com/brainzbiz/status/1215980946169532418?s=21"  target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/bizbrainztechnologiespvt.ltd/?r=nametag"  target="_blank"><i class="fa fa-instagram" style="background-image:linear-gradient(-220deg,#4c68d7,#8a3ab9,#8a3ab9,#e95950,#fbad50,#fccc63,#e95950,#bc2a8d,#8a3ab9,#4c68d7);" ></i></a></li>
                                     <li><a href="https://www.linkedin.com/company/bizbrianz"  target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!-- ==============================================
**Contact Map**
=================================================== -->
        <section class="contact-map m-2" >
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.3299430578986!2d78.47896781418838!3d17.443915205765368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9be0a4333cdf%3A0xb60adfaceecf4f37!2sBizBrainz%20Technologies%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1578653318153!5m2!1sen!2sin" width="600" height="150" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </section>

<?php
include('static/Frontend_Empty_footer.php');
?>