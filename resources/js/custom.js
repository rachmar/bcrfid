$( document ).ready(function() {

  $('#datatable').DataTable({
  	  "scrollX": true
  });

  $(".delete").submit(function (e) {
  	
	e.preventDefault();

	swal.fire({
	    title: 'Are you sure?',
	    text: 'You will not be able to recover this data!',
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonText: 'Yes, delete it!',
	    cancelButtonText: 'No, keep it'
	    }).then((result) => {
	    if (result.value) {
	      $(this).closest(".delete").off("submit").submit();
	    }else{
	      swal.fire('Cancelled','Your data is safe!','error')
	    }
	});

 });


});
