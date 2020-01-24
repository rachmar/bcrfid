@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
          	<h3 class="box-title">Students</h3>
          	<button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#AddStudent">
              <i class="fa fa-fw fa-plus-circle"></i> Add student
            </button>
      </div>
      <div class="box-body">

        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Card ID</th>
              <th>Student ID</th>
              <th>Photo</th>
              <th>Firstname</th>
              <th>Middlename</th>
              <th>Lastname</th>
              <th>Section</th>
              <th>Parent</th>
              <th>Phone</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
          	@foreach ($students as $student)
                <tr>
                  <td>{{ strtoupper($student->crd_id) }}</td>
                  <td>{{ strtoupper($student->std_id) }}</td>
                  <td><img  src="{{asset('storage/'.$student->photo)}}"  width="50" height="50"></td>
                  <td>{{ strtoupper($student->firstname) }}</td>
                  <td>{{ strtoupper($student->middlename) }}</td>
                  <td>{{ strtoupper($student->lastname) }}</td>
                  <td>{{ strtoupper($student->sectgrade) }} - {{ strtoupper($student->sectname) }} </td>
                  <td>{{ strtoupper($student->parent) }}</td>
                  <td>{{ strtoupper($student->phone) }}</td>
                  </td>
                  <td width="10%">
                    <button type="button" 
                            class="btn btn-md btn-warning  btn-block pull-right"
                            data-id="{{ $student->id }}"
                            data-std_id="{{ $student->std_id }}"
                            data-crd_id="{{ $student->crd_id }}"
                            data-firstname="{{ $student->firstname }}"
                            data-middlename="{{ $student->middlename }}"
                            data-lastname="{{ $student->lastname }}"
                            data-sct_id="{{ $student->sct_id }}"
                            data-parent="{{ $student->parent }}"
                            data-phone="{{ $student->phone }}"
                            data-toggle="modal" data-keyboard="false" data-backdrop="static"  data-target="#EditStudent"> <i class="fa fa-fw fa-edit"></i> Edit
                    </button>
                  </td>
                  <td width="10%">
                    <form action="{{ route('student.destroy', $student->id ) }}" class="delete" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field()}}
                      <button type="submit" class="btn btn-md btn-block pull-right btn-danger" ><i class="fa fa-fw fa-trash"></i> Delete</button>
                    </form>
                  </td>
                </tr>
            @endforeach
          </tbody>
          <tfoot>
           <tr>
              <th>Card ID</th>
              <th>Student ID</th>
              <th>Photo</th>
              <th>Firstname</th>
              <th>Middlename</th>
              <th>Lastname</th>
              <th>Section</th>
              <th>Parent</th>
              <th>Phone</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </tfoot>

        </table>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AddStudent">
	<div class="modal-dialog">
		<form  action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      	<span aria-hidden="true">×</span></button>
			       	<h4 class="modal-title">Add student</h4>
			  </div>
			  <div class="modal-body">
		    	
		    	<div class="row">
		    		<div class="form-group col-md-6">
		     			<label>Card ID (*)</label>
		            	<input type="text"  name="crd_id" class="form-control" autocomplete="off" required>
			        </div>
		    		<div class="form-group col-md-6">
			     		<label>Student ID (*)</label>
			            <input type="text"  name="std_id" class="form-control" autocomplete="off" required>
			        </div>
		    	</div>

		    	<div class="row">
		    		<div class="form-group col-md-6">
			     		<label>Firstname (*)</label>
			            <input type="text" name="firstname" class="form-control" autocomplete="off" required>
			        </div>
			        <div class="form-group col-md-6">
			     		<label>Lastname (*)</label>
			            <input type="text" name="lastname" class="form-control" autocomplete="off" required>
			        </div>
		    	</div>

		    	<div class="row">
			        <div class="form-group col-md-6">
			     		<label>Middlename </label>
			            <input type="text" name="middlename" class="form-control"  autocomplete="off" required>
			        </div>
		    		<div class="form-group col-md-6">
			     		<label>Section</label>
			            <select name="sct_id" class="form-control">
			            	@foreach ($sections as $section)
	               				<option value="{{ $section->id }}"> {{ $section->grade }} - {{ $section->name}} </option>
	            			@endforeach
			            </select>
			        </div>
		    	</div>
		    	<div class="row">
			        <div class="form-group col-md-6">
			     		<label>Parent(*)</label>
			            <input type="text" name="parent"  class="form-control" autocomplete="off" required>
			        </div>
			        <div class="form-group col-md-6">
			     		<label>Phone Num (*)</label>
			            <input type="number"  min="11" name="phone"  class="form-control"  autocomplete="off"required>
			        </div>
		    	</div>
		    	<div class="row">
			        <div class="form-group col-md-12">
			     		<label>Photo(*)</label>
			            <input type="file" name="photo"  class="form-control" autocomplete="off" required>
			        </div>
		    	</div>


			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
			    <button type="submit" class="btn btn-success">Submit</button>
			  </div>
			</div>
		</form>	
	</div>
</div>

<div class="modal fade" id="EditStudent">
	<div class="modal-dialog">
		<form  action="{{ route('student.update', 'update' ) }}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
        	{{ method_field('PUT') }}
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      	<span aria-hidden="true">×</span></button>
			       	<h4 class="modal-title">Edit Student</h4>
			  </div>
			  <div class="modal-body">
				
				<input type="hidden" id="id" name="id" class="form-control" >

				<div class="row">
		    		<div class="form-group col-md-6">
			     		<label>Card ID</label>
			            <input type="text"  id="crd_id" name="crd_id" class="form-control" required>
			        </div>
		    		<div class="form-group col-md-6">
			     		<label>Student ID</label>
			            <input type="text"  id="std_id" name="std_id" class="form-control" required>
			        </div>
			    </div>

		        <div class="row">
		    		<div class="form-group col-md-6">
			     		<label>Firstname</label>
			            <input type="text" id="firstname" name="firstname" class="form-control" autocomplete="off" required>
			        </div>
			        <div class="form-group col-md-6">
			     		<label>Lastname</label>
			            <input type="text"  id="lastname" name="lastname" class="form-control" autocomplete="off" required>
			        </div>
		    	</div>

		    	<div class="row">
			        <div class="form-group col-md-6">
			     		<label>Middlename</label>
			            <input type="text" id="middlename" name="middlename" class="form-control"  autocomplete="off" required>
			        </div>
		    		<div class="form-group col-md-6">
			     		<label>Section</label>
			            <select id="sct_id" name="sct_id" class="form-control">
			            	@foreach ($sections as $section)
	               				<option value="{{ $section->id }}"> {{ $section->grade }} - {{ $section->name}} </option>
	            			@endforeach
			            </select>
			        </div>
		    	</div>
		    	<div class="row">
			        <div class="form-group col-md-6">
			     		<label>Parent(*)</label>
			            <input type="text" id="parent" name="parent"  class="form-control" autocomplete="off" required>
			        </div>
			        <div class="form-group col-md-6">
			     		<label>Phone Num (*)</label>
			            <input type="number"   id="phone" min="11" name="phone"  class="form-control"  autocomplete="off"required>
			        </div>
		    	</div>
		    	<div class="row">
			        <div class="form-group col-md-12">
			     		<label>Change Photo(*)</label>
			            <input type="file" name="photo"  class="form-control">
			        </div>
		    	</div>
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
			    <button type="submit" class="btn btn-success">Submit</button>
			  </div>
			</div>
		</form>	
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $('#EditStudent').on('show.bs.modal',function (e) {

        var id= $(e.relatedTarget).data('id');
        var crd_id= $(e.relatedTarget).data('crd_id');
        var std_id= $(e.relatedTarget).data('std_id');
        var firstname= $(e.relatedTarget).data('firstname');
        var middlename= $(e.relatedTarget).data('middlename');
        var lastname= $(e.relatedTarget).data('lastname');
        var sct_id= $(e.relatedTarget).data('sct_id');
        var parent= $(e.relatedTarget).data('parent');
        var phone= $(e.relatedTarget).data('phone');

        $(e.currentTarget).find('input[id="id"]').val(id);
        $(e.currentTarget).find('select[id="sct_id"]').val(sct_id);
        $(e.currentTarget).find('input[id="firstname"]').val(firstname);
        $(e.currentTarget).find('input[id="middlename"]').val(middlename);
        $(e.currentTarget).find('input[id="lastname"]').val(lastname);
        $(e.currentTarget).find('input[id="parent"]').val(parent);
        $(e.currentTarget).find('input[id="phone"]').val(phone);
        $(e.currentTarget).find('input[id="std_id"]').val(std_id);
        $(e.currentTarget).find('input[id="crd_id"]').val(crd_id);

    });
</script>
@endsection