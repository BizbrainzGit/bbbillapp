<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?><div class="main-panel">
					<div class="content-wrapper">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-sm-6 mb-4 mb-xl-0">
										<h3>Wel Come Admin!</h3>
									</div>
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-md-end">
											<div class="mb-3 mb-xl-0">
												<div class="btn-group dropdown">
													<button type="button" class="btn btn-success"> <?php echo date("Y-m-d"); ?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="page-header-tab mt-xl-4">
									<div class="col-12 pl-0 pr-0">
									</div>
								</div>
								<div class="tab-content tab-transparent-content pb-0">
									<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
										<div class="row">
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card" style="background-image: linear-gradient(#128FD0 0%,#ffffff 45%, #467908 90%);">
													<div class="card-body text-center">
														<h4 class="card-title">Client Logos</h4>
														 <h2 class="mr-3"><?php echo $clientlogocount;?></h2>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card" style="background-image: linear-gradient(#128FD0 0%,#ffffff 45%, #467908 90%);">
													<div class="card-body text-center">
														<h4 class="card-title">Gallery</h4>
														 <h2 class="mr-3"><?php echo $gallerycount;?></h2>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card" style="background-image: linear-gradient(#128FD0 0%,#ffffff 45%, #467908 90%);">
													<div class="card-body text-center">
														<h4 class="card-title">Job Apply</h4>
														 <h2 class="mr-3"><?php echo $applyjobcount;?></h2>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card" style="background-image: linear-gradient(#128FD0 0%,#ffffff 45%, #467908 90%);">
													<div class="card-body text-center">
														<h4 class="card-title">Client Projects</h4>
														 <h2 class="mr-3"><?php echo $clientproductscount;?></h2>
													</div>
												</div>
											</div>
										</div>
									<!-- 	<div class="row">
											<div class="col-12 col-sm-12 col-md-12 col-xl-12 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<div>
																<h4 class="card-title mb-3">Revenue overview</h4>
															</div>
															<div>
																<div class="d-flex align-items-center">
																	<div class="dropdown mr-2 mb-2 d-none d-md-block">
																		<button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuSizeButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		2019
																		</button>
																		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSizeButton4" data-x-placement="bottom-end">
																			<a class="dropdown-item" href="#">2015</a>
																			<a class="dropdown-item" href="#">2016</a>
																			<a class="dropdown-item" href="#">2017</a>
																			<a class="dropdown-item" href="#">2018</a>
																		</div>
																	</div>
																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonsrevenue" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonsrevenue" x-placement="left-start">
																			<a class="dropdown-item" href="#">Action</a>
																			<a class="dropdown-item" href="#">Another action</a>
																			<a class="dropdown-item" href="#">Something else here</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<p class="text-muted">Customers who have upgraded the level of your products or service</p>
														<div class="mt-4 mb-4 d-sm-flex">
															<div id="legendContainer" class="mb-4 mr-4 legendContainer col-md-4 pl-0 pr-0"></div>
															<div class="col-md-6 pl-0 pr-0">
																<h6>Summary</h6>
																<p class="text-muted">A comparison of people who mark themeselves of their interest based from the date range given above.</p>
															</div>
														</div>
														<div class="row mt-1 d-sm-flex">
															<div class="col-12">
																<div class="flot-chart-container">
																	<div id="flotChart" class="flot-chart"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div> -->
								
									</div>
									<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
										Tab Item
									</div>
									<div class="tab-pane fade" id="returns-1" role="tabpanel" aria-labelledby="returns-tab">
										Tab Item
									</div>
									<div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">
										Tab Item
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- content-wrapper ends -->
					<!-- partial:partials/_footer.html -->
          <div class="footer-wrapper">
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2019 Bizbrainz Technologies Prevate Limited All rights reserved. </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="http://bizbrainz.in/" target="_blank">BizBrainz.in</a> </span>
              </div>
            </footer>
          </div>
          <!-- partial -->
        <!-- main-panel ends -->
        </div>
      <!-- page-body-wrapper ends -->
      </div>
    </div>
    <!-- container-scroller -->
<?php
include('Layouts/adminLayout_Footer.php');
?>
   
