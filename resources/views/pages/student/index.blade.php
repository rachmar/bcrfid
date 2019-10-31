@extends('layouts.admin')

@section('page-title', 'Track List')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Student</th>
              <th>Details</th>         
            </tr>
          </thead>
          <tbody>
          	<!-- FOR LOOP -->
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Student</th>
              <th>Details</th>          
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
      $('#datatable').DataTable();
    });
</script>
@endsection