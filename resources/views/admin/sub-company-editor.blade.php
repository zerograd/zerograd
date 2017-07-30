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
						<div class="pricing-panel" onClick="addBorder(this);" title="free">
							<h3>Option #1</h3>
							<i class="fa fa-money" aria-hidden="true"></i>
							<p>7 Day Trial</p>
						</div>
						<div class="pricing-panel" onClick="addBorder(this);" title="150">
							<h3>Option #2</h3>
							<i class="fa fa-money" aria-hidden="true"></i>
							<i class="fa fa-money" aria-hidden="true"></i>
							<p>$150/month</p>
							<p>up to 10 postings</p>
						</div>
						<div class="pricing-panel" onClick="addBorder(this);" title="250">
							<h3>Option #3</h3>
							<i class="fa fa-money" aria-hidden="true"></i>
							<i class="fa fa-money" aria-hidden="true"></i>
							<i class="fa fa-money" aria-hidden="true"></i>
							<p>$250/month</p>
							<p>up to 20 postings</p>
						</div>
					</div>
					<div style="text-align: center;">
					 	<button type="button" onClick="confirmPricing();"  class="btn btn-success" style="margin:10px auto;">Confirm Pricing</button>
					 </div>
					<input type="hidden" id="chosen-company-id">
				</form>
			</div>
	  	</div>

	  	<div id="banking-tab" class="tab-pane fade">
	  		
	  	</div>
	</div>