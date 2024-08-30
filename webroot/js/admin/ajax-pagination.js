$(document).on('click', '.pagination li a', function(e) {
	//e.preventDefault();
    var target = $(this).attr('href');
	if(!target)
	return false;
	$('#loader').css('display','block');
   //alert(target);
   var searchQuery = $('#searchQuery').val();
   if (typeof(searchQuery) != "undefined" && searchQuery !=''){
		target = target + '?' + 'searchQuery= '+searchQuery;
	}
   $.get(target, function(data) {
	   $('#loader').css('display','none');
       $('.rep_content').html(jQuery(data).find('.rep_content').html());
		url = jQuery(data).find('.next a').attr('href');
	   finalQueryString = url.substring(url.indexOf("?") + 1).replace(/\d+/, jQuery(data).find('.active a').html());
		var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?'+finalQueryString;
		window.history.pushState({path:newurl},'',newurl);
	},'html');
	return false;
});
