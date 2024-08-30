$('#username').on('focusout', function() {
  		var val = $(this).val();
  		$.ajax({
                type: "POST",
                url: "/admin/centers/checkUsername/",
				data: 'username=' + val,
                success: function(data){
                    if(data != 0){
						$("#usrname_error").show();
						$('#username').val('');
					}else{
						$("#usrname_error").hide();
					}
                }
  		});
  	});

$('#email').on('change', function() {
	  var val = $(this).val();

	  $.ajax({
					type: "POST",
					url: "/Centers/checkEmail/",
					data: {email: val,type:'center'},
					success: function(data){
						if(data != 0){
							$("#email_error").show();
							$('#email').val('');
						}else{
							$("#email_error").hide();
						}
					}
	  });

	});
	
  