<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/itdepartmentLayout_Header.php');
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
                                                                   <a class="dropdown-item" href="#" onClick="AllMonthlySalesData(1);" ><?php echo date('M Y', strtotime('0 month')); ?></a>
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
                                                                  <a class="dropdown-item" href="#" onClick="AllAppointmentsData(1);" ><?php echo date('M Y', strtotime('0 month')); ?></a>
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
                                                                  <a class="dropdown-item" href="#" onClick="AllDealcloseData(1);" ><?php echo date('M Y', strtotime('0 month')); ?></a>
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

											
			<!-- 								<div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Returns</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonsmarketing" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonsmarketing" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<div id="marketing" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">27632</h2>
																		<h3 class="text-success">+2.3%</h3> 
																	</div>
																	<div class="mb-3">
																		 <p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p> 
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">27632</h2>
																		 <h3 class="text-success">+2.3%</h3> 
																	</div>
																	<div class="mb-3">
																		 <p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p> 
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
																<div class="carousel-item">
																	<div class="d-flex flex-wrap align-items-baseline">
																		<h2 class="mr-3">27632</h2>
																		 <h3 class="text-success">+2.3%</h3> 
																	</div>
																	<div class="mb-3">
																		 <p class="text-muted font-weight-bold text-small">North Ludwig <span class=" font-weight-normal">($2643M last month)</span></p> 
																	</div>
																	<button class="btn btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center">
																	<i class="mdi mdi-calendar mr-1"></i>
																	<span class="text-left">
																	Oct
																	</span>
																	</button>
																</div>
															</div>
															<a class="carousel-control-prev" href="#marketing" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
															</a>
															<a class="carousel-control-next" href="#marketing" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
															</a>
														</div>
													</div>
												</div>
											</div> -->
										</div>
										<!-- <div class="row">
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
										<div class="row">

											<div class="col-lg-4 d-flex flex-column">
												<div class="row flex-grow">
													<div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
														<div class="card">
															<div class="card-body">
																<div class="d-flex flex-wrap justify-content-between">
																	<h4 class="card-title mb-3">Citywise Appointments Details </h4>

																	<button class="btn btn-warning btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span id="alltotalappointmentscitywise_monthname"></span></button>

																	<div class="dropdown dropleft card-menu-dropdown">
																		<button class="btn p-0" type="button" id="cardMenuButtonsalestop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="cardMenuButtonsalestop" x-placement="left-start">
																		 <a class="dropdown-item" href="#" onClick="AllAppointmentsCitywiseData(1);" ><?php echo date('M Y', strtotime('0 month')); ?></a>
																		  <a class="dropdown-item" href="#" onClick="AllAppointmentsCitywiseData(2);" ><?php echo date('M Y', strtotime('-1 month')); ?></a>
																		  <a class="dropdown-item" onClick="AllAppointmentsCitywiseData(3);" href="#"><?php echo date('M Y', strtotime('-2 month')); ?></a>
																		  <a class="dropdown-item"  href="#" onClick="AllAppointmentsCitywiseData(4);"><?php echo date('M Y', strtotime('-3 month')); ?></a>

																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-12">
																		<!-- <div class="row ">
																			<div class="col-12">
																				<p class="text-muted mb-4 text-left">Customers who have upgraded the level of your products or service</p>
																			</div>
																		</div> -->
																		<div class="row mt-2">
																			<div class="col-6 col-sm-6 text-left text-uppercase">
																				<h4 class="font-weight-height text-primary">City Name</h4>
																			</div>
																			<div class="col-6 col-sm-6 text-left text-uppercase">
																				<h4 class="font-weight-height text-primary">Total Appts</h4>
																			</div>
																		</div> 
                                                                        <div class="class-hide"> 
																		<div class="row mt-2">
																			<div class="col-12">
																				 <h6 class="font-weight-height text-success"> Today Appointments:</h6>
																			</div>
																		</div>

																		 <div id="todaytotalappointmentscitywise">
																		 </div>

																	 <!--   <div class="row mt-2">
																			<div class="col-12 tex">
																				 <h6 class="font-weight-height text-success"> Total Appointments:</h6>
																			</div>
																		</div> -->

                                                                       </div>
                                                                      <div id="alltotalappointmentscitywise"></div>
																	
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>


											<div class="col-lg-4 d-flex flex-column">
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
																			 <a class="dropdown-item" href="#" onClick="AllSalesCitywiseData(1);" ><?php echo date('M Y', strtotime('0 month')); ?></a>
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
										
											<div class="col-lg-4 d-flex flex-column">
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
																			<a class="dropdown-item" href="#" onClick="AllSalesData(1);" ><?php echo date('M Y', strtotime('0 month')); ?></a>
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
																		<!-- 	<div class="col">
																				<div class="d-flex purchase-detail-legend align-items-center">
																						<div id="circleProgress1" class="p-2"></div>
																						<div>
																							<p class="font-weight-medium text-muted text-small">Sessions</p>
																							<h3 class="font-weight-medium  mb-0">26.80%</h3>
																						</div>
																				</div>
																			</div>
																			<div class="col">
																				<div class="d-flex purchase-detail-legend align-items-center">
																						<div id="circleProgress2" class="p-2"  width="42" height="42"></div>
																						<div>
																							<p class="font-weight-medium text-muted text-small">Users</p>
																							<h3 class="font-weight-medium  mb-0">56.80%</h3>
																						</div>
																				</div>
																			</div> -->

																		</div>
																		
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- <div class="row">
											<div class="col-12 col-lg-4 col-xl-4 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">To do</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtontodo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtontodo" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<div class="add-items d-flex">
															<input type="text" class="form-control todo-list-input" placeholder="Add list here">
															<button class="btn btn-primary  todo-list-add-btn">Add to list</button>
														</div>
														<div class="list-wrapper">
															<p class="text-muted">People who have a ticket reservation of the event is automatically mark as interested.</p>
															<ul class="d-flex flex-column-reverse todo-list">
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">Need to complete the product
																		Manager needs.
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">
																		Buy Pizza on the way to work on web design
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">
																		Upload the draft design for admin dashboard
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li class="completed">
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox" checked="">
																		This morning,be sure to get up early to eat breakfast!
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
																<li>
																	<div class="form-check">
																		<label class="form-check-label text-muted font-weight-medium">
																		<input class="checkbox" type="checkbox">
																		Accompany her to thr theater to see the musical.
																		<i class="input-helper"></i></label>
																	</div>
																	<i class="remove mdi mdi-delete"></i>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-lg-8 col-xl-8 grid-margin stretch-card">
												<div class="card">
													<div class="card-body">
														<div class="d-flex flex-wrap justify-content-between">
															<h4 class="card-title">Sales</h4>
															<div class="dropdown dropleft card-menu-dropdown">
																<button class="btn p-0" type="button" id="cardMenuButtonsales1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="mdi mdi-dots-vertical card-menu-btn"></i>
																</button>
																<div class="dropdown-menu" aria-labelledby="cardMenuButtonsales1" x-placement="left-start">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div>
															</div>
														</div>
														<p class="text-muted">People who have a ticket reservation of the event is automatically mark as interested.</p>
														<div class="border pt-2 pb-2 mt-4 mb-3 border-radius-widget">
															<ul class="d-md-flex flex-wrap align-items-baseline justify-content-center list-unstyled text-center mb-0 sales-legend">
																<li class="border-right-sm">
																	<h6 class="font-weight-normal">Total</h6>
																	<h2 class="text-primary">2584</h2>
																	<p class="text-primary pl-md-4 pr-md-4">56.04 % Total</p>
																</li>
																<li class="border-right-sm">
																	<h6 class="font-weight-normal">This Year</h6>
																	<h2 class="text-primary pl-md-3 pr-3">46360</h2>
																	<p class="text-primary pl-3 pr-3">32.68 % Total</p>
																</li>
																<li class="border-right-sm">
																	<h6 class="font-weight-normal">Past year</h6>
																	<h2 class="text-primary">46360</h2>
																	<p class="text-primary">97.32% Total</p>
																</li>
																<li class="pb-2 pt-2 pl-4 pr-4">
																	<h6 class="font-weight-normal">Difference</h6>
																	<h2 class="text-primary">93819</h2>
																	<p class="text-primary">76.47% Total</p>
																</li>
															</ul>
														</div>
														<div class="row mt-1 d-sm-flex">
															<div class="col-12">
																<canvas id="salesChart"></canvas>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div> -->
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
include('Layouts/itdepartmentLayout_Footer.php');
?>
   
