@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">

  <div class="col-md-6">
    <div class="box box-default">
      <div class="box-header with-border">
          <h3 class="box-title">Add Item</h3>
      </div>
      <div class="box-body">
        <form action="#" class="announce" method="POST">

              <div class="form-group">
                <label for="sct_id">Section</label>
                <select id="sct_id" name="sct_id" class="form-control">
	            	@foreach ($sections as $section)
           				<option value="{{ $section->id }}"> {{ $section->grade }} - {{ $section->name}} </option>
        			@endforeach
	            </select>
              </div>

              <div class="form-group">
                <label for="subj">Subject</label>
                <input type="text" id="subj" name="subj" class="form-control" required>
              </div>

              <div class="form-group">
                <label for="msg">Message</label>
                <textarea id="msg" name="msg" class="form-control" rows="10"></textarea>
              </div>
            
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-block pull-right ">
                	<i class="fa fa-fw fa-plus-circle"></i> Announce Now </button>
              </div>

            </form>
        </form>
      </div>
    </div>
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
            'subj' : $('#subj').val(),
            'msg' : $('#msg').val()
        }

        console.log(data);

        swal.fire({
            title: 'Sending Announcement!',
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