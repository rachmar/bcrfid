@extends('layouts.admin')

@section('page-title', 'General Announcement')

@section('content')
<div class="row">
  	<div class="col-md-6">
    	<div class="box box-primary">
	      	<div class="box-header with-border">
       			 <h3 class="box-title">General Announcement</h3>
	      	</div>
	        <form action="{{ route('announcement.store') }}" method="POST">
	        	{{csrf_field()}}
			    <div class="box-body">
		            <div class="row">
		              <div class="form-group col-md-12">
		                <label for="from">Year Level</label>
		                <select id="from" class="form-control" name="from">
		                  <option value="college">College</option>
		                </select>
		              </div>
		              <div class="form-group col-md-12">
		                <label for="subject">Subject</label>
		                <input type="text" id="subject" class="form-control" name="subject" required>
		              </div>
		              <div class="form-group col-md-12">
		                <label for="message">Message</label>
		                <textarea id="message" class="form-control" name="message" rows="10" required></textarea>
		              </div>
		            </div>
		        </div>
		        <div class="box-footer "> 
		            <button  type="submit" class="btn btn-primary pull-right">Send Announcement</button>
		        </div>
	        </form>
	    </div>
  	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection