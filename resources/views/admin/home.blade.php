@extends('layout.admin-layout')

@section('title')
	Admin-Home
@stop

@section('content')
	<div id="add-new-user-panel" class="panel" style="background-color:#16a085;">
			<h3>Add New Admin Users</h3>
			<p>Click here to add a new user. They will have access to this dashboard.</p>

	</div>

	<div id="manage-applicants-panel" class=" panel" style="background-color:#27ae60">

			<h3>Manage Applicants</h3>
			<p>Click here to manage an applicant's.</p>

	</div>

	<div id="manage-companies-panel" class=" panel" style="background-color:#2980b9">
	
			<h3>Add New Admin Users</h3>
			<p>Click here to manage a company account.</p>

	</div>

	<div id="manage-companies-panel" class=" panel" style="background-color:#8e44ad">
	
			<h3>Edit Resources</h3>
			<p>Click here to manage resources.</p>

	</div>
@stop