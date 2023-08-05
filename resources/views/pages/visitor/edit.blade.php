@extends('layouts.layout')
@section('content')
	<div class="container mt-4">
	  	@if(session('success'))
		    <div class="alert alert-success">
		        {{ session('success') }}
		    </div>
	  	@endif
	  	<div class="card">
		    <div class="card-header text-center font-weight-bold">
		      Edit Visitor
		    </div>
		    <div class="card-body">
		      <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('visitor/update/'.$visitor->id)}}">
		       @csrf
		        <div class="form-group">
		          	<label for="">Name</label>
		          	<input type="text" id="name" name="name" class="form-control" required="" placeholder="Name" value="{{$visitor->name}}">
		        </div>
		        <div class="form-group">
		          	<label for="">Mobile No</label>
		          	<input type="text" id="mobileno" name="mobileno" class="form-control" required="" placeholder="0XXXXXXXXX" value="{{$visitor->mobile_no}}">
		        </div>
		        <div class="form-group">
		          	<label for="">Passport No/Emirates Id</label>
		          	<input type="text" id="passportoremirates" name="passportoremirates" class="form-control" required="" placeholder="Passport No/Emirates Id" value="{{$visitor->passport_or_emiratesno}}">
		        </div>
		        <div class="form-group">
		          	<label for="">Company Name</label>
		          	<input type="text" id="companyname" name="companyname" class="form-control" required="" placeholder="Company Name" value="{{$visitor->company_name}}">
		        </div>
		        <div class="form-group">
		          	<label for="">Concerned Person Name</label>
		          	<input type="text" id="personname" name="personname" class="form-control" required="" placeholder="Concerned Person Name" value="{{$visitor->person_name}}">
		        </div>
		        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Update</button>
		      </form>
		    </div>
	  	</div>
	</div> 
@endsection