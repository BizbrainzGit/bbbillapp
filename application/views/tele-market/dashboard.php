<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/tele-marketLayout_Header.php');
?> 
				<div class="main-panel">
					<div class="content-wrapper">
						<div class="row">
							<div class="col-md-12">
								<!-- <div class="row">
									<div class="col-sm-6 mb-4 mb-xl-0">
										<h3>Congrats Edwin!</h3>
										<h6 class="font-weight-normal mb-0 text-muted">You have done 57.6% more sales today.</h6>
									</div>
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-md-end">
											<div class="border-right-dark pr-4 mb-3 mb-xl-0 d-xl-block d-none">
												<p class="text-muted">Today</p>
												<h6 class="font-weight-medium text-dark mb-0">23 Aug 2019</h6>
											</div>
											<div class="pr-4 pl-4 mb-3 mb-xl-0 d-xl-block d-none">
												<p class="text-muted">Category</p>
												<h6 class="font-weight-medium text-dark mb-0">All Categories</h6>
											</div>
											<div class="pr-1 mb-3 mb-xl-0">
												<button type="button" class="btn btn-success btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
											</div>
											<div class="pr-1 mb-3 mb-xl-0">
												<button type="button" class="btn btn-success btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
											</div>
											<div class="mb-3 mb-xl-0">
												<div class="btn-group dropdown">
													<button type="button" class="btn btn-success">14 Aug 2019</button>
													<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
														<a class="dropdown-item" href="#">2015</a>
														<a class="dropdown-item" href="#">2016</a>
														<a class="dropdown-item" href="#">2017</a>
														<a class="dropdown-item" href="#">2018</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> -->
								<!-- <div class="page-header-tab mt-xl-4">
									<div class="col-12 pl-0 pr-0">
										<div class="row ">
											<div class="col-12 col-sm-6 mb-xs-4  pt-2 pb-2 mb-xl-0">
												<ul class="nav nav-tabs tab-transparent" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" id="overview-tab" data-toggle="tab" href="#" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="users-tab" data-toggle="tab" href="#" role="tab" aria-controls="users" aria-selected="false">Users</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="returns-tab" data-toggle="tab" href="#" role="tab" aria-controls="returns" aria-selected="false">Returns</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="more-tab" data-toggle="tab" href="#" role="tab" aria-controls="more" aria-selected="false">More</a>
													</li>
												</ul>
											</div>
											<div class="col-12 col-sm-6 mb-xs-4 mb-xl-0 pt-2 pb-2 text-md-right d-none d-md-block">
												<div class="d-inline-flex">
													<button class="btn d-flex align-items-center">
													<i class="mdi mdi-download mr-1"></i>
													<span class="text-left font-weight-medium">
													Download report
													</span>
													</button>
													<button class="btn d-flex align-items-center">
													<i class="mdi mdi-file-pdf  mr-1"></i>
													<span class="font-weight-medium text-left">
													Export
													</span>
													</button>
													<button class="btn d-flex align-items-center pr-0">
													<i class="mdi mdi-email-outline  mr-1"></i>
													<span class="text-left font-weight-medium">
													Send as Email
													</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div> -->
								<div class="tab-content tab-transparent-content pb-0">
									<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
										<div class="row">
											<div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Sales</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonreturns" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonreturns" x-placement="left-start">

																	<a class="dropdown-item" href="#" onClick="AllMonthlySalesData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																  <a class="dropdown-item" onClick="AllMonthlySalesData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																  <a class="dropdown-item"  href="#" onClick="AllMonthlySalesData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>
																</div>
															</div>
														</div>
														
														<div id="returns" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div id="allmonthlysales_viewdashboard"></div>
															</div>
															<a class="carousel-control-prev" href="#returns" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#returns" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Appointments</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonsales" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonsales" x-placement="left-start">

																  <a class="dropdown-item" href="#" onClick="AllAppointmentsData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																  <a class="dropdown-item" onClick="AllAppointmentsData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																  <a class="dropdown-item"  href="#" onClick="AllAppointmentsData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>

																</div>


															</div>
														</div>
														<div id="sales" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div id="allappointment_viewdashboard"></div>
															</div>

															<a class="carousel-control-prev" href="#sales" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#sales" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Deal Close</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonpurchase" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonpurchase" x-placement="left-start">

																	<a class="dropdown-item" href="#" onClick="AllDealcloseData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																  <a class="dropdown-item" onClick="AllDealcloseData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																  <a class="dropdown-item"  href="#" onClick="AllDealcloseData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>

																</div>
															</div>
														</div>
														<div id="purchases" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div id="alldealclose_viewdashboard"></div>
															</div>
															<a class="carousel-control-prev" href="#purchases" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#purchases" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div>
											
										
										</div>
										
									
											   
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
                <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2019 BizBrainz Technologies Private Limited All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="http://bizbrainz.in/" target="_blank">BizBrainz Technologies Private Limited.</a> </span>
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
include('Layouts/tele-marketLayout_Footer.php');
?>
   
<script src="/<?php echo base_url();?>assets/js/Common/DashboardController.js"></script>