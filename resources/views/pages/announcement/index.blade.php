@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
          	<h3 class="box-title">Announcements</h3>
          	<button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#AddAnnouncement">
              <i class="fa fa-fw fa-plus-circle"></i> Make Announcement
            </button>
      </div>
      <div class="box-body">

        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="20%">Created On</th>
              <th width="20%">Section</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody>
          	@foreach ($announcements as $announcement)
                <tr>
                  <td>{{ strtoupper($announcement->created_at->format('Y-m-d h:m a')) }}</td>
                  <td>{{ strtoupper($announcement->sectgrade) }} - {{ strtoupper($announcement->sectname) }} </td>
                  <td>{{ strtoupper($announcement->msg) }}</td>
                  </td>
                </tr>
            @endforeach
          </tbody>
          <tfoot>
           <tr>
              <th width="20%">Created On</th>
              <th width="20%"> Section</th>
              <th>Message</th>
            </tr>
          </tfoot>

        </table>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AddAnnouncement">
	<div class="modal-dialog">

		<form action="#" class="announce" method="POST">

			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      	<span aria-hidden="true">×</span></button>
			       	<h4 class="modal-title">Make Announcement</h4>
			  </div>
			  <div class="modal-body">
		    	
              <div class="form-group">
                <label for="sct_id">Section</label>
                <select id="sct_id" name="sct_id" class="form-control">
	            	  @foreach ($sections as $section)
           				 <option value="{{ $section->id }}"> {{ $section->grade }} - {{ $section->name}} </option>
        			    @endforeach
	            </select>
              </div>

              <div class="form-group">
                <label for="msg">Message</label>
                <textarea id="msg" name="msg" class="form-control" rows="10"></textarea>
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
<script type="text/javascript">
    $(".announce").submit(function (e) {

    e.preventDefault();
    swal.fire({
      title: 'Are you sure?',
      text: 'This is gonna announce the selected group above',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, do it!',
      cancelButtonText: 'No, not yet'
      }).then((result) => {
      if (result.value) {

        var data ={
            '_token' : '{{csrf_token()}}',
            'sct_id' : $('#sct_id').val(),
            'msg' : $('#msg').val()
        }

        console.log(data);

        $.ajax({
          type:"POST",
          url: "{{ route('announcement.store') }}",
          data: data,
          success:function(data){
              console.log(data);
          },error: function(error) {
              console.log(error);
          }
        });

        swal.fire({
            title: 'Sending Announcement To Queue!',
            html: 'This will close in <b></b> seconds.',
            timer: 10000,
            showConfirmButton: false,
            allowOutsideClick: false,
            onBeforeOpen: () => {
              swal.showLoading()
              timerInterval = setInterval(() => {
                swal.getContent().querySelector('b')
                  .textContent = Math.ceil(swal.getTimerLeft() / 1000)
              }, 100);
            },
            onClose: () => {
              clearInterval(timerInterval)
              window.location.reload();
            }
          }).then((result) => {
            if (
              result.dismiss === swal.DismissReason.timer
            ) {
              console.log('I was closed by the timer')
            }
          });



      }else{
        swal.fire('Cancelled','Your data is safe!','error')
      }
    });
  });
</script>
@endsection