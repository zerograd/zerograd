

@if($maximize == 'maximize')
<div class="panel-content">
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#applicants-tab">Manage Companies</a></li>
	  <li><a data-toggle="tab" href="#pricing-tab">Price + Match</a></li>
	  <li><a data-toggle="tab" href="#banking-tab">Banking Details</a></li>
	</ul>

	<div class="tab-content">
	
		<!-- Manage Companies -->
	  	<div id="applicants-tab" class="tab-pane fade in active">
		     <div class="form-group col-sm-4">
	     		<label>Search Companies:</label>
	     		<input type="text" name="search" id="applicant-search" placeholder="Search" onkeyup="search();" class="form-control">
     			@include('admin.search-list')
		     </div>
		     <div class="form-group col-sm-8">
				<label>Company:</label>
				<div id="company-editor" class="col-sm-12 scroll" style="height:400px;border:1px solid #c6c6c6;border-radius: 3px;padding: 10px;overflow-y: scroll;">
					
				</div>
				
			</div>

	  	</div>
	  	<!-- Choose pricing plan for companies-->
	  	<div id="pricing-tab" class="tab-pane fade">
		     <div class="form-group col-sm-4">
	     		<label>Search Companies:</label>
	     		<input type="text" name="search" id="applicant-search" placeholder="Search" onkeyup="search();" class="form-control">
     			@include('admin.price-match-list')
		     </div>
		     <div class="form-group col-sm-8">
			     <form id="pricing-form" action="" method="POST">
			     	{{csrf_field()}}
					<div class="form-group col-sm-12">
						<label>Company:</label>
						<input type="text" name="company_name" id="chosen-company-match" class="form-control" disabled>
					</div>
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
</div>

@else
	<h3>Manage Companies</h3>
	<p><i class="fa fa-building" aria-hidden="true"></i></p>
	<p>Click here to manage a company account.</p>
@endif