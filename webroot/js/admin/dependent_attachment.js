
/*
 * This script is used for upload file attachment from "Manage Dependent" page.
 *
 */

$(document).ready(function(){
	$("#upload-model").on("hidden.bs.modal", function(){
		$('.dependent-id').val('');
		$('#attachment-title').val('');
		$('#attachment-file').val('');
	});

	$(document).on('click','.attach_for_upload_modal', function(){
		var dependent_id = $(this).attr('data-attach-modal');
		$('.dependent-id').val(dependent_id);
		$('#upload-model').modal('show');
	});

});

$(document).on('click', '#search-reports', function(e) {
	e.preventDefault();

	var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
	window.history.pushState({path:newurl},'',newurl);

	//check if no search query
	var searchQuery = $('#report-form').serialize();
	//if(!searchQuery)
	//return false;

	//get current location & check empty
	var target = window.location.href;
	if(!target)
	return false;

	//make seach query as query string
	target = target+'?'+searchQuery;
	$('#loader').css('display','block');
    $.get(target, function(data) {
	   // alert(data);
	   $('#loader').css('display','none');
		$('.rep_content').html(jQuery(data).find('.rep_content').html());
	},'html');
	return false;

});

$(document).on('click', '#create-xls-dependents', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = webroot+'/admin/dependents/xls';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});
