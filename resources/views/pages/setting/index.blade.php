@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">
  	<div class="col-md-6">
	    <div class="box">
	      <div class="box-header with-border">
	          	<h3 class="box-title">Teachers</h3>
	          	<button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#AddTeacher">
	              <i class="fa fa-fw fa-plus-circle"></i> Add Teacher
	            </button>
	      </div>
	      <div class="box-body">

	        <table  class="table table-bordered table-striped">
	          <thead>
	            <tr>
	              <th>Name</th>
	              <th>Username</th>
	              <th width="10%">Action</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($teachers as $teacher)
	                <tr>
	                  <td>{{ strtoupper($teacher->name) }}</td>
	                  <td>{{ $teacher->username }}</td>
	                  <td><form action="{{ route('setting.destroy', $teacher->id ) }}" class="delete" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field()}}
                        <input type="hidden" name="action" value="teacher">
                      <button type="submit" class="btn btn-md btn-block pull-right btn-danger" ><i class="fa fa-fw fa-trash"></i> Delete</button>
                    </form></td>
	                  </td>
	                </tr>
	            @endforeach
	          </tbody>

	        </table>

	      </div>
	    </div>
  	</div>
  	<div class="col-md-6">
	    <div class="box">
	      <div class="box-header with-border">
	          	<h3 class="box-title">Sections</h3>
	          	<button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#AddSection">
	              <i class="fa fa-fw fa-plus-circle"></i> Add Section
	            </button>
	      </div>
	      <div class="box-body">

	         <table  class="table table-bordered table-striped">
	          <thead>
	            <tr>
	              <th>Section</th>
	              <th width="10%">Action</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($sections as $section)
	                <tr>
	                  <td>{{ strtoupper($section->grade) }} - {{ strtoupper($section->name) }}</td>
	                  <td><form action="{{ route('setting.destroy', $section->id ) }}" class="delete" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field()}}
                        <input type="hidden" name="action" value="section">
                      <button type="submit" class="btn btn-md btn-block pull-right btn-danger" ><i class="fa fa-fw fa-trash"></i> Delete</button>
                    </form></td>
	                </tr>
	            @endforeach
	          </tbody>

	        </table>

	      </div>
	    </div>
  	</div>
</div>

<div class="modal fade" id="AddTeacher">
	<div class="modal-dialog">

		<form  action="{{ route('setting.store') }}" method="POST">
           			{{csrf_field()}}

           <input type="hidden" name="action" value="teacher">

			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      	<span aria-hidden="true">×</span></button>
			       	<h4 class="modal-title">Add Teacher</h4>
			  </div>
			  <div class="modal-body">
		    	
              <div class="form-group">
                <label for="msg">Full Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>
            
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
		       	<button type="submit" class="btn btn-success pull-right ">
		       		Submit
		       	</button>			  
		       	</div>
			</div>
		</form>	
	</div>
</div>


<div class="modal fade" id="AddSection">
	<div class="modal-dialog">

		<form  action="{{ route('setting.store') }}" method="POST">
			{{csrf_field()}}

			<input type="hidden" name="action" value="section">

			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      	<span aria-hidden="true">×</span></button>
			       	<h4 class="modal-title">Add Section</h4>
			  </div>
			  <div class="modal-body">
		      
		      <div class="row">
		      	 <div class="form-group col-md-6">
		     		<label>Grade</label>
		            <select name="grade" class="form-control">
		            	<option value="11"> Grade 11</option>
		            	<option value="12"> Grade 12</option>
		            </select>
		        </div>
		      	 <div class="form-group col-md-6">
	                <label>Name</label>
	                <input type="text" name="name" class="form-control" required>
	              </div>
		      </div>
              
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
		       	<button type="submit" class="btn btn-success pull-right ">
		       		Submit
		       	</button>			  
		       	</div>
			</div>
		</form>	
	</div>
</div>


@endsection

@section('script')

@endsection