@extends('layouts.layout')
@section('content')
	<div class="card-body">
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<input type="text" id="name" name="name" class="form-control changeText"  placeholder="Name">
				</div>
				<div class="col-md-3">
					<input type="text" id="name" name="mobileno" class="form-control changeText" placeholder="Mobile No">
				</div>
				<div class="col-md-3">
					<input type="text" id="name" name="companyname" class="form-control changeText" required="" placeholder="Company Name">
				</div>

				<div class="col-md-3">
					<input type="date" id="date" name="date" class="form-control changeText" required="" placeholder="Company Name">
				</div>
				
			</div>	
        </div>
	</div>
	<div class="card-body" id="displayTable">
		<table class="table table-bordered table-striped" id="datatableVisitorList" width="100%" cellspacing="0" >
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Mobile No</th>
					<th>Passport/Emirates</th>
					<th>Company Name</th>
					<th>Person Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($visitors as $key=> $visitor)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$visitor->name}}</td>
						<td>{{$visitor->mobile_no}}</td>
						<td>{{$visitor->passport_or_emiratesno}}</td>
						<td>{{$visitor->company_name}}</td>
						<td>{{$visitor->person_name}}</td>
						<td>
							<a href="{{url('visitor/edit/'.$visitor->id)}}">Edit</a>
							<a href="{{url('visitor/delete/'.$visitor->id)}}" onclick="return confirm('Are you sure?')"> Delete</a>	
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection
