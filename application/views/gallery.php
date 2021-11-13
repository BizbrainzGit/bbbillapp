<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Frontend_Empty_header.php');
?>
<!-- ==============================================
**Inner Banner**
=================================================== -->
      
<?php  if(isset($banner)&&count($banner)>0){
         foreach($banner as $row => $data)  {  if($row==0){ ?>
        <section class="inner-banner" style=" background: url('/<?php echo base_url();?><?php echo $data->image; ?>') no-repeat center fixed;
    background-size:100% 100%;">
            <div class="container">
                <div class="contents">
                    <h1><?php echo $data->banner_title;  ?></h1>
                    <p><?php echo $data->banner_content;  ?></span></p>
                </div>
            </div>
        </section>

 <?php } } }?>

<!-- ==============================================
**Portfolio**
=================================================== -->
        <section class="portfolio-outer padding-lg"> 

            <!-- Start portfolio filter -->
            <div class="container text-center">
                <div class="isotopeFilters">
                    <ul class="portfolio-filter clearfix">
                      <!--   <li class="active"><a href="#" data-filter="*">All</a></li> -->

                          <?php  if(isset($gallerytype)){
                   foreach($gallerytype as $row => $data) {  
                    ?> 
                     <li><a href="#" data-filter=".<?php echo "garllery".$data->id;?>"><?php echo $data->gallerytype_name;  ?></a></li>
                  
                  <?php } } ?>

                       <!--  <li><a href="#" data-filter=".application">application</a></li>
                        <li><a href="#" data-filter=".business">business</a></li>
                        <li><a href="#" data-filter=".company">company</a></li>
                        <li><a href="#" data-filter=".software">software</a></li>
                        <li><a href="#" data-filter=".webapp">webapp</a></li> -->
                    </ul>
                </div>
                <!-- end portfolio filter -->

                <ul class="row portfolio clearfix isotopeContainer">
                    <?php  if(isset($gallery)){
                   foreach($gallery as $row => $data) {  
                    ?> 
                 <li class="col-6 col-md-4 isotopeSelector <?php echo "garllery".$data->gallery_type;?>">
                        <div class="inner">
                            <div class="overlay">
                                <h2><?php echo $data->gallery_title;?></h2>
                                <p><?php echo $data->gallerytype_name;?></p>
                                <a class="galleryItem" href="/<?php echo base_url();?><?php echo $data->image;?>"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?><?php echo $data->image;?>" class="img-responsive" alt=" <?php echo $data->image_alt; ?> " height="200px;"></figure>
                        </div>
                    </li>

                    <?php } } ?>
                     
                   <!--  <li class="col-6 col-md-4 isotopeSelector business company application software">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg2.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio2.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li>
                    <li class="col-6 col-md-4 isotopeSelector company software webapp">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg3.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio3.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li>
                    <li class="col-6 col-md-4 isotopeSelector business software webapp">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg4.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio4.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li>
                    <li class="col-6 col-md-4 isotopeSelector business company application webapp">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg5.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio5.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li>
                    <li class="col-6 col-md-4 isotopeSelector software company application">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg6.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio6.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li>
                    <li class="col-6 col-md-4 isotopeSelector business company application webapp">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg7.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio7.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li>
                    <li class="col-6 col-md-4 isotopeSelector business company software company application webapp">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg8.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio8.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li>
                    <li class="col-6 col-md-4 isotopeSelector business software company application webapp">
                        <div class="inner">
                            <div class="overlay">
                                <h2>Lorem ipsum</h2>
                                <p>Application</p>
                                <a class="galleryItem" href="/<?php echo base_url();?>assets/forntend/images/portfolio-lg9.jpg"><span class="icon-expand"></span></a></div>
                            <figure><img src="/<?php echo base_url();?>assets/forntend/images/portfolio9.jpg" class="img-responsive" alt=""></figure>
                        </div>
                    </li> -->
                </ul>
                <div class="paging-block">

                    <ul>
                        <!-- <li><a href="#" class="prev"><span class="icon-left-arrow"></span></a></li> -->
                        <?php  if(isset($links)){
                         echo "<li>". $links."</li>";
                        }?> 
                        <!-- <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#" class="dots"><span class="icon-paging-dots"></span></a></li>
                        <li><a href="#">43</a></li>
                        <li><a href="#" class="next"><span class="icon-right-arrow"></span></a></li> -->
                    </ul>
                </div>
            </div>
        </section>

<?php
include('static/Frontend_Empty_footer.php');
?>