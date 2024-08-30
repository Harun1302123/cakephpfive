/************************** check All*******************/
$(document).on('click','.save_alert',function(e){
	  e.preventDefault();
	  $(this).addClass('disabled');
	  if($('#name').val() == ''){
		 alert('Please fill Alert Name?');
		 return false;
	  }
	 
	  $.ajax({
	                type: "POST",
	                url: "/admin/settings/add_alert_type",
					data: {alert_name:$('#name').val()},
	                success: function(data){
	                    if(data =='success'){
							updateAlertType();
						}else{
							alert('Something went wrong.');
						}
	                }
	  });	
});

function updateAlertType(){
	$.get('/admin/settings/add_alert', function(data) {
		$('#alert-type-id').html(jQuery(data).find('#alert-type-id').html());
		
		$('.save_alert').removeClass('disabled');
		$('#alertModel').hide();
		$('.modal-backdrop').hide();
	},'html');
}

/****************** show schedule option ***********/
$(document).on('click','#delivery-1',function(e){
	$('.schedule').show();
});

/****************** hide schedule option ***********/
$(document).on('click','#delivery-0',function(e){
	$('.schedule').hide();
});

$(document).ready(function(){
	$('#delivery-0').prop('checked','checked');
	$('.schedule').hide();
});