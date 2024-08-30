$(document).on('click', '#search-reports', function(e) {
	e.preventDefault();

	//check if no search query
	var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
	window.history.pushState({path:newurl},'',newurl);

	var searchQuery = $('#report-form').serialize();
	//if(!searchQuery)
	//return false;

	//get current location & check empty
	var target = window.location.href;

	if(!target)
	return false;

	//make seach query as query string
	target = target+'?'+searchQuery;
    console.log(target)
	// $('#loader').css('display','block');
    const o = document.getElementById("search-reports");
    o.setAttribute("data-kt-indicator", "on")

    $.get(target, function(data) {
	   console.log(data)
	//    $('#loader').css('display','none');
        o.removeAttribute("data-kt-indicator")

        $('.rep_content').html(jQuery(data).find('.rep_content').html());
	},'html');
	return false;

});

$(document).on('click', '#search-reports-exp', function(e) {
	e.preventDefault();

	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//get current location & check empty
	var target = window.location.href;
	if(!target)
	return false;

	flag = true;

	if($('#expired-type').val() != ''){
		if($('#start-date-ex-type').val() == ''){
			$('#start-date-ex-type').css('border-color' , 'red');
			flag = false;
		}else{
			$('#start-date-ex-type').css('border-color' , '#d2d6de');
		}
		if($('#end-date-ex-type').val() == ''){
			$('#end-date-ex-type').css('border-color' , 'red');
			flag = false;
		}else{
			$('#end-date-ex-type').css('border-color' , '#d2d6de');
		}
	}

	if(flag){

		//make seach query as query string
		target = target+'?'+searchQuery;
		$('#loader').css('display','block');
		$.get(target, function(data) {
		   // alert(data);
		   $('#loader').css('display','none');
			$('.rep_content').html(jQuery(data).find('.rep_content').html());
		},'html');
		return false;
	}

});

$(document).on('click', '#create-xl', function(e) {
	e.preventDefault();

	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = webroot+'/admin/reports/excel';

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
	var target = webroot+'/admin/reports/excel_full';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});
$(document).on('click', '#create-xl-employe-exp', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	flag = true;
	if($('#expired-type').val() != ''){
		if($('#start-date-ex-type').val() == ''){
			$('#start-date-ex-type').css('border-color' , '#d2d6de');
			flag = false;
		}else{
			$('#end-date-ex-type').css('border-color' , '#d2d6de');
		}
		if($('#end-date-ex-type').val() == ''){
			$('#end-date-ex-type').css('border-color' , 'red');
			flag = false;
		}else{
			$('#end-date-ex-type').css('border-color' , '#d2d6de');
		}
	}
	if(flag){
		//set current location
		var target = webroot+'/admin/reports/excel_expiry_full';

		//make seach query as query string
		target = target+'?'+searchQuery;
		window.open(target);
		return false;
	}

});

$(document).on('click', '#create-xl-total-fee', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = webroot+'/admin/reports/company_total_fees';

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
	var target = webroot+'/admin/employees/xls';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});


