@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">
	

  		<div id="printreport" class="col-md-12">
		    <div class="box">
		    	<div class="box-header with-border">
	          		<h3 class="box-title">Logs</h3>
	          		<button class="btn btn-warning pull-right no-print" onclick="printDiv()">Print Report</button>
	      		</div>
		      	<div class="box-body">
			        <table  class="table table-bordered table-striped">
			          <thead>
			            <tr>
			              <th>Date</th>
			              <th>Message</th>
			            </tr>
			          </thead>
			          <tbody>
			          	@foreach ($logs as $log)
			                <tr>
			                  <td>{{ $log->created_at->format('Y/m/d - h:i a')}}</td>                  
			                  <td>{{ strtoupper($log->msg) }}</td>
			                </tr>
			            @endforeach
			          </tbody>
			          <tfoot>
			        </table>
			    </div>
		    </div>
		</div>


</div>
@endsection

@section('script')
<script type="text/javascript">
 
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