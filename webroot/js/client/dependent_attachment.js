
/*
 * This script is used for upload file attachment from "Manage Dependent" page.
 *
 */

$(document).ready(function(){
	$("#upload-model").on("hidden.bs.modal", function(){
		$('.dependent-id').val('');
		$('#attachment-title').val('');
		$('#attachment-file').val('');
		$('#attac_upload').parsley().destroy();
	});

	$(document).on('click','.attach_for_depet', function(){
		$('#attac_upload').parsley();
		var dependent_id = $(this).attr('data-attach-depet');
		$('.dependent-id').val(dependent_id);
		$('#upload-model').modal('show');

	});

});


$(document).on('click', '#search-reports', function(e) {
	e.preventDefault();
	
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//get current location & check empty
	var target = window.location.href;
	if(!target)
	return false;

	//make seach query as query string
	target = target+'?'+searchQuery;
	const o = document.getElementById("search-reports");
    o.setAttribute("data-kt-indicator", "on")
    $.get(target, function(data) {
	   // alert(data);
		o.removeAttribute("data-kt-indicator")
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
	var target = '/client/dependents/xls';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;
	
});
