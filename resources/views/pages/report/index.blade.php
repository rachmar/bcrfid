@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">

	<div class="col-md-12">
	    <div class="box">
	    	<div class="box-header with-border">
          		<h3 class="box-title">Filter</h3>
      		</div>
	      	<div class="box-body">
		       
		       	<form  action="{{ route('report.store') }}" method="POST">
           			{{csrf_field()}}

           		<div class="row">

           			<div class="form-group col-md-3">
           				<label>ID Num</label>
           				<input type="text" name="std_id" class="form-control">
		            </div>

		            <div class="form-group col-md-3">
           				<label>Name</label>
           				<input type="text" name="name" class="form-control">
		            </div>

           			<div class="form-group col-md-3">
           				<label>Grade Level</label>
           				<select name="grade" class="form-control">
           					<option value="0">Please Choose</option>
           					<option value="0">All Grade Level</option>
           					<option value="11">Grade 11 Only</option>
           					<option value="12">Grade 12 Only</option>
           				</select>
		            </div>

		            <div class="form-group col-md-3">
           				<label>Purpose</label>
           				<select name="purpose" class="form-control">
           					<option value="">Please Choose</option>
           					<option value="IN">IN</option>
           					<option value="OUT">OUT</option>
           				</select>
		            </div>

           		</div>

           		<div class="row">
					<div class="form-group col-md-4">
	                  <label>Section</label>
	                  <select name="section"  class="form-control">
	              		<option value="0">Please Choose</option>
	                    	@foreach ($sections as $section)
								<option value="{{ $section->id }}">{{ strtoupper($section->grade)}} - {{ strtoupper($section->name)}}</option>
	                      	@endforeach
	                  </select>
	                </div>

					<div class="form-group col-md-4">
						<label>From Date</label>
						<div class="input-group">
			                <input type="text" name="from" class="form-control datepicker" autocomplete="off">
			                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
			            </div>
					</div>

					<div class="form-group col-md-4">
						<label>To Date</label>
						<div class="input-group">
			                <input type="text" name="to"  class="form-control datepicker" autocomplete="off">
			                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
			            </div>
					</div>
				</div>	
			

					<button type="submit" class="btn btn-success pull-right ">
			       		Filter Data
			       	</button>
				</form>	

		    </div>
	    </div>
	</div>	

	@if ( Request::isMethod('post') )
  		<div id="printreport" class="col-md-12">
		    <div class="box">
		    	<div class="box-header with-border">
	          		<h3 class="box-title">Student Reports</h3>
	          		<button class="btn btn-warning pull-right no-print" onclick="printDiv()">Print Report</button>
	      		</div>
		      	<div class="box-body">
			        <table  class="table table-bordered table-striped">
			          <thead>
			            <tr>
			              <th>Date</th>
			              <th>Card ID</th>
			              <th>Student ID</th>
<th>Firstname</th>
              <th>Middlename</th>
              <th>Lastname</th>
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
                  <td>{{ strtoupper($report->firstname) }}</td>
                  <td>{{ strtoupper($report->middlename) }}</td>
                  <td>{{ strtoupper($report->lastname) }}</td>
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
 	@endif


</div>
@endsection

@section('script')
<script type="text/javascript">
   	$('.datepicker').datepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true
    });

    function printDiv() {
        var divName= "printreport";

         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }

</script>
@endsection