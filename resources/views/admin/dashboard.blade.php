@extends('templates.default')

@section('content')

<div class="container-fluid admin-container">
	<h1>Admin Dashboard</h1>
	<ul class="list-inline">
		<li><a href="{{ route('admin.add') }}" class="btn btn-global">Add Advisor</a></li>
		<li><a href="{{ route('admin.email') }}" class="btn btn-global">Email</a></li>
	</ul>

	<hr>

	<ul class="nav nav-tabs" id="admin-nav">
	  <li class="nav-item" data-title="users">
	    <a class="nav-link active" href="#">Users</a>
	  </li>
	  <li class="nav-item" data-title="advisors">
	    <a class="nav-link" href="#">Advisors</a>
	  </li>
	  <li class="nav-item" data-title="requests">
	    <a class="nav-link" href="#">Advisor Requests</a>
	  </li>
	</ul>

	<div class="admin-section" id="users">
		<h3>Users ({{ $users->count() }})</h3>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Delete User</th>
					<th>ID</th>
					<th>Email</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Created At</th>
					<th>Updated At</th>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr class="user-record">
						<td>
							@unless ($user->email == "mpierce486@gmail.com")
							<span class="user-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
							@endunless
						</td>
						<td class="user-id">{{ $user->id }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->first_name }}</td>
						<td>{{ $user->last_name }}</td>
						<td>{{ $user->created_at }}</td>
						<td>{{ $user->updated_at }}</td>
					</tr>
					@endforeach
				</tbody>	
			</table>
		</div>
	</div>
	<div class="admin-section" id="advisors">
		<h3>Advisors ({{ $advisors->count() }})</h3>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Delete Advisor</th>
					<th>ID</th>
					<th>Username</th>
					<th>Email</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Advisor Type</th>
					<th>Title</th>
					<th>Firm Name</th>
					<th>Firm Website</th>
					<th>Firm Address</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>Services</th>
					<th>About</th>
					<th>Designations</th>
					<th>Fees</th>
					<th>Languages</th>
					<th>Created At</th>
					<th>Updated At</th>
				</thead>
				<tbody>
					@foreach ($advisors as $advisor)
					<tr class="advisor-record">
						<td><span class="advisor-delete"><i class="fa fa-trash" aria-hidden="true"></i></span></td>
						<td class="advisor-id">{{ $advisor->id }}</td>
						<td>{{ $advisor->username }}</td>
						<td>{{ $advisor->email }}</td>
						<td>{{ $advisor->first_name }}</td>
						<td>{{ $advisor->last_name }}</td>
						<td>{{ $advisor->advisor_type }}</td>
						<td>{{ $advisor->title }}</td>
						<td>{{ $advisor->firm_name }}</td>
						<td>{{ $advisor->firm_website }}</td>
						<td>{{ $advisor->firm_address }}</td>
						<td>{{ $advisor->lat }}</td>
						<td>{{ $advisor->long }}</td>
						<td>{{ $advisor->services }}</td>
						<td>{{ $advisor->about }}</td>
						<td>{{ $advisor->designations }}</td>
						<td>{{ $advisor->fees }}</td>
						<td>{{ $advisor->languages }}</td>
						<td>{{ $advisor->created_at }}</td>
						<td>{{ $advisor->updated_at }}</td>
					</tr>
					@endforeach
				</tbody>	
			</table>
		</div>
	</div>
	<div class="admin-section" id="requests">
		<h3>Advisor Join Requests ({{ $joinRequests->count() }})</h3>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Delete Advisor</th>
					<th>Approve Advisor</th>
					<th>ID</th>
					<th>Username</th>
					<th>Email</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Advisor Type</th>
					<th>Title</th>
					<th>Firm Name</th>
					<th>Firm Address</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>Services</th>
					<th>About</th>
					<th>Designations</th>
					<th>Fees</th>
					<th>Languages</th>
					<th>Created At</th>
					<th>Updated At</th>
				</thead>
				<tbody>
					@foreach ($joinRequests as $joinRequest)
					<tr class="advisorRequest-record">
						<td><span id="advisorRequest-delete"><i class="fa fa-trash" aria-hidden="true"></i></span></td>
						<td><!-- <span id="advisorRequest-approve"><i class="fas fa-thumbs-up"></i></span> --></td>
						<td class="advisor-id">{{ $joinRequest->id }}</td>
						<td>{{ $joinRequest->username }}</td>
						<td>{{ $joinRequest->email }}</td>
						<td>{{ $joinRequest->first_name }}</td>
						<td>{{ $joinRequest->last_name }}</td>
						<td>{{ $joinRequest->advisor_type }}</td>
						<td>{{ $joinRequest->title }}</td>
						<td>{{ $joinRequest->firm_name }}</td>
						<td>{{ $joinRequest->firm_address }}</td>
						<td>{{ $joinRequest->lat }}</td>
						<td>{{ $joinRequest->long }}</td>
						<td>{{ $joinRequest->services }}</td>
						<td>{{ $joinRequest->about }}</td>
						<td>{{ $joinRequest->designations }}</td>
						<td>{{ $joinRequest->fees }}</td>
						<td>{{ $joinRequest->languages }}</td>
						<td>{{ $joinRequest->created_at }}</td>
						<td>{{ $joinRequest->updated_at }}</td>
					</tr>
					@endforeach
				</tbody>	
			</table>
		</div>
	</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/admin.js')  }}"></script>

@stop