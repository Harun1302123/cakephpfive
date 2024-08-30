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
	$('#loader').css('display','block');
    $.get(target, function(data) {
	   // alert(data);
	   $('#loader').css('display','none');
		$('.rep_content').html(jQuery(data).find('.rep_content').html());
	},'html');
	return false;
	
});



$(document).on('click', '#create-xl-transaction', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location 
	var target = '/client/companies/xls_transaction';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;
	
});
