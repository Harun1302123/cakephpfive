// AJAX call for autocomplete 
$(document).ready(function(){
	$("#search-name").keyup(function(){
		$.ajax({
		type: "POST",
		url: "/admin/companies/suggestions",
		data:{keyword:$(this).val(),forWhom:$('#for-whom').val()},
		beforeSend: function(){
			$("#suggesstion-box").hide();
			//$("#search-name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			//$("#search-name").css("background","#FFF");
		}
		});
	});
   
    $(document).on('click','#name-list li',function(){
			//alert($(this).attr('data-name'));
			$("#search-name").val($(this).attr('data-name'));
			$("#suggesstion-box").hide();
		
	});

	/************* function for show and hide********/
	 $(document).on('change','.status select',function(){
			console.log($(this).val());
			if($(this).val() =='3'){
				console.log($(this).parent().parent().parent().next('.completion-date-block').html());
				$(this).parent().parent().parent().next('.completion-date-block').show();
			}else{
				$(this).parent().parent().parent().next('.completion-date-block').hide();
			}
		
	});
});