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


$(document).on('click', '#create-xl', function(e) {
	e.preventDefault();

	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = '/client/reports/excel';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});

$(document).on('click', '#create-xl-employe', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = '/client/reports/excel_full';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});

$(document).on('click', '#create-xl-total-fee', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = '/client/reports/company_total_fees';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});

$(document).on('click', '#create-xls-employees', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = '/client/employees/xls';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});


