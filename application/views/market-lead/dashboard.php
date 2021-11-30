<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/market-leadLayout_Header.php');
?>
					<div class="main-panel">
					<div class="content-wrapper">
						<div class="row">
							<div class="col-md-12">
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
										
										<div class="row">
											<div class="col-lg-6 d-flex flex-column">
												<div class="row flex-grow">
													<div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
														<div class="card">
															<div class="card-body">
																<div class="d-flex flex-wrap justify-content-between">
																	<h4 class="card-title mb-3">Citywise Sales Details </h4>
																	
																	<button class="btn btn-warning btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span id="alltotalsalescitywise_monthname"></span></button>

																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonsalestop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonsalestop" x-placement="left-start">
																		  <a class="dropdown-item" href="#" onClick="AllSalesCitywiseData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																		  <a class="dropdown-item" onClick="AllSalesCitywiseData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																		  <a class="dropdown-item"  href="#" onClick="AllSalesCitywiseData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>

																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-12">
																		<div class="row">
																			<div class="col-12">
																				<p class="text-muted mb-4 text-left">Customers who have upgraded the level of your products or service</p>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-6 col-sm-6 text-left text-uppercase">
																				<h4 class="font-weight-height text-primary">City Name</h4>
																			</div>
																			<div class="col-6 col-sm-6 text-left text-uppercase">
																				<h4 class="font-weight-height text-primary">Total Sales</h4>
																			</div>
																		</div> 
                                                                        <div class="class-hide"> 
																		<div class="row mt-2">
																			<div class="col-12">
																				 <h6 class="font-weight-height text-success"> Today Sales:</h6>
																			</div>
																		</div>
																		 <div id="todaytotalsalescitywise">
																		 </div>
																	   <div class="row mt-2">
																			<div class="col-12 tex">
																				 <h6 class="font-weight-height text-success"> Total Sales:</h6>
																			</div>
																		</div>
                                                                       </div>
                                                                      <div id="alltotalsalescitywise"></div>

																	
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-lg-6 d-flex flex-column">
												<div class="row flex-grow">
													<div class="col-12 col-md-12 col-lg-12 grid-margin stretch-card">
														<div class="card">
															<div class="card-body">
																<div class="d-flex flex-wrap justify-content-between">
																	<h4 class="card-title mb-3">Sales in detail</h4>
																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonpurchasedetails" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonpurchasedetails" x-placement="left-start">
																			<a class="dropdown-item" href="#" onClick="AllSalesData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																			<a class="dropdown-item" onClick="AllSalesData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																			<a class="dropdown-item"  href="#" onClick="AllSalesData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-12">
																		<!-- <div class="chartjs-legend mt-4" id="chart-legends-purchase"></div> -->
																		<!-- <div class="row">
																			<div class="col-12">
																				<canvas id="purchaseDetails"></canvas>
																			</div>
																		</div> -->
																		<div class="row pt-3 mt-md-4">
																			<div class="col col-sm-12 mb-2">
																				<div class="d-flex sales-top-chart-legend align-items-center">
																					<div class="bg-info p-3 mr-3 mr-lg-0 mr-lg-3 mb-md-2 mb-lg-0">
																						<canvas id="acquisition-bar_1" height="20" width="20"></canvas>
																					</div>
																					<div class="wrapper d-flex flex-column justify-content-center">
																						<p class="font-weight-medium text-muted">Online Sales</p>
																						<h3 class="font-weight-medium mb-0 text-primary"><span class="rupeesymbole">₹</span><span id="online_totalamount">0</span></h3>
																					</div>
																				</div>
																			</div>
																			<div class="col col-sm-12">
																				<div class="d-flex sales-top-chart-legend align-items-center">
																					<div class="bg-success p-3 mr-3 mr-lg-0 mr-lg-3 mb-md-2 mb-lg-0">
																						<canvas id="acquisition-bar_2" height="20" width="20"></canvas>
																					</div>
																					<div class="wrapper d-flex flex-column justify-content-center">
																						<p class="font-weight-medium text-muted">Offline Sales</p>
																						<h3 class="font-weight-medium mb-0 text-primary"><span class="rupeesymbole">₹</span><span id="offline_totalamount">0</span></h3>
																					</div>
																				</div>
																			</div>
																		</div>
                                                                          <hr> 
																		<div class="row pt-3 mt-md-4"> 
																			<div id="alltypepayment_totalamountsales"></div>
																		</div>
																		
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
											    <div class="row">
										            <div class="col-12 grid-margin">
										              <div class="card">
										                <div class="card-body">
										                  <h4 class="card-title">Projects List </h4>
										                  <div class="row">
										                    <div class="col-12">
										                      <div class="table-responsive">
										                        <table id="projectslisttable" class="table table-hover businesstable">
										                        </table>
										                      </div>
										                    </div>
										            
										                  </div>
										                </div>
										              </div>
										            </div>
										          </div>
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
include('Layouts/market-leadLayout_Footer.php');
?>
 <script src="/<?php echo base_url();?>assets/js/Common/DashboardController.js" type="text/javascript"></script>   
