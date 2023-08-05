<table class="table table-bordered dataTable" id="ajax-crud-datatable">
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
							<a href="">Edit</a>
							<a href="">Delete</a>	
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>