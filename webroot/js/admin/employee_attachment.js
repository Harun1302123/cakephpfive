
/*
 * This script is used for upload file attachment from "Manage Employee" page.
 *
 */

$(document).ready(function(){
	$("#upload-model").on("hidden.bs.modal", function(){
		$('.employee-id').val('');
		$('#attachment-title').val('');
		$('#attachment-file').val('');
		$( '#attac_upload' ).parsley().destroy();
	});

	$(document).on('click','.attach_for_upload_modal', function(){
		var employee_id = $(this).attr('data-attach-modal');
		$('.employee-id').val(employee_id);
		$('#upload-model').modal('show');

	});

});
