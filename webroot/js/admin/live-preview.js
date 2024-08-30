/**
 *function for live preview
 *
 */
$(document).on('click','#live_preview',function(){
	var content = CKEDITOR.instances['template'].getData();
	if (content  === '') {
		alert('Please fill some text!');
		return false;
	}
	var form = $("<form/>",{ action:'/admin/certificates/livePreview' 
						  }
            );
	 $(form).attr("method", "POST");
	form.append( 
		$("<input>", 
			 { type:'text', 
			   placeholder:'Keywords', 
			   name:'content',
			   value:content,
			   }
		 )
	);



$("body").append(form);
	form.submit();
	
	$('#live-content').html(content);
	//$('#live-preiview').modal('show');
			
});