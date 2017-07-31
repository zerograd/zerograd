<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#company-tab">Profile Profile</a></li>
	  <li><a data-toggle="tab" href="#pricing-tab">Price + Match</a></li>
	  <li><a data-toggle="tab" href="#banking-tab">Banking Details</a></li>
	</ul>

	<div class="tab-content">
	
		<!-- Manage Companies -->
	  	<div id="company-tab" class="tab-pane fade in active">
			<div id="company-profile" class="col-sm-12 scroll" style="height:400px;border-radius: 3px;padding: 10px;">
				
			</div>
	  	</div>
	  	<!-- Choose pricing plan for companies-->
	  	<div id="pricing-tab" class="tab-pane fade">
		     <div class="form-group col-sm-12">
			     <form id="pricing-form" action="" method="POST">
			     	{{csrf_field()}}
					<div class="form-group col-sm-12">
						<div class="col-sm-12">
							<label>Price (Choose one of the following options):</label>
						</div>

						<!-- Option #1 -->
						<div class="pricing-panel">
							<div class="plan color-2 one-third column"  title="19">
								<div class="plan-price">
									<h3>Start Up</h3>
									<span class="plan-currency">$</span>
									<span class="value">19</span>
									
								</div>
								<div class="plan-features">
									<ul>
										<li>One Time Fee</li>
										<li>This Plan Includes 1 Job</li>
										<li>Non-Highlighted Post</li>
										<li>Posted For 30 Days</li>
									</ul>
									<a class="button" href="javascript:confirmPricing(19);"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
								</div>
							</div>
						</div>

						<!-- Option #2 -->
						<div class="pricing-panel">
							<div class="plan color-2 one-third column"  title="59">
								<div class="plan-price">
									<h3>Company</h3>
									<span class="plan-currency">$</span>
									<span class="value">59</span>
								</div>
								<div class="plan-features">
									<ul>
										<li>One Time Fee</li>
										<li>This Plan Includes 2 Jobs</li>
										<li>Highlighted Job Post</li>
										<li>Posted For 60 Days</li>
									</ul>
									<a class="button" href="javascript:confirmPricing(59);"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
								</div>
							</div>
						</div>

						<!-- Option #3 -->
						<div class="pricing-panel">
							<div class="plan color-2 one-third column"  title="99">
								<div class="plan-price">
									<h3>Enterprise</h3>
									<span class="plan-currency">$</span>
									<span class="value">99</span>
								</div>
								<div class="plan-features">
									<ul>
										<li>One Time Fee</li>
										<li>This Plan Includes 4 Jobs</li>
										<li>2 Highlighted Job Posts</li>
										<li>Posted For 90 Days</li>
									</ul>
									<a class="button" href="javascript:confirmPricing(99);"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" id="chosen-company-id">
				</form>
			</div>
	  	</div>

	  	<div id="banking-tab" class="tab-pane fade">
	  		
	  	</div>
	</div>