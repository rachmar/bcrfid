@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">
	<div class="col-md-8">
	    <div class="box">
	    	<div class="box-header with-border">
          		<h3 class="box-title">Student Reports</h3>
      		</div>
	      	<div class="box-body">
		        <table id="datatable" class="table table-bordered table-striped">
		          <thead>
		            <tr>
		              <th>Date</th>
		              <th>Card ID</th>
		              <th>Student ID</th>
		              <th>Name</th>
		              <th>Purpose</th>
		              <th>Section</th>
		            </tr>
		          </thead>
		          <tbody>
		          	@foreach ($reports as $report)
		                <tr>
		                  <td>{{ $report->created_at->format('Y/m/d - h:i a')}}</td>
		                  <td>{{ strtoupper($report->crd_id) }}</td>
		                  <td>{{ strtoupper($report->std_id) }}</td>
		                  <td>{{ strtoupper($report->name) }}</td>
		                  <td>{{ strtoupper($report->purpose) }}</td>
		                  <td>{{ strtoupper($report->sectgrade) }} - {{ strtoupper($report->sectname) }}</td>
		                </tr>
		            @endforeach
		          </tbody>
		          <tfoot>
		        </table>
		    </div>
	    </div>
	</div>
	<div class="col-md-4">
	    <div class="box">
	    	<div class="box-header with-border">
          		<h3 class="box-title">Unauthorize Reports</h3>
      		</div>
	      	<div class="box-body">
	      		@if(!$unauthorizes->isEmpty())
        			<table class="table table-bordered table-striped">
			          <thead>
			            <tr>
			              <th>Date</th>
			              <th>Card ID</th>
			            </tr>
			          </thead>
			          <tbody>
			          	@foreach ($unauthorizes as $unauthorize)
			                <tr>
			                  <td>{{ $unauthorize->created_at->format('Y/m/d - h:i a')}}</td>
			                  <td>{{ strtoupper($unauthorize->crd_id) }}</td>
			                </tr>
			            @endforeach
			          </tbody>
			          <tfoot>
		        	</table>
		      	@else
		      	    No Report Found
		      	@endif 
		    </div>
	    </div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection