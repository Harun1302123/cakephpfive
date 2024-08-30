$(document).on('click', '.pagination li a', function(e) {
	//e.preventDefault();
    var target = $(this).attr('href');
	if(!target)
	return false;
	$('#loader').css('display','block');
   //alert(target);
   $.get(target, function(data) {
	   // alert(data);
	   $('#loader').css('display','none');
        $('.rep_content').html(jQuery(data).find('.rep_content').html());
    },'html');
	return false;
});

