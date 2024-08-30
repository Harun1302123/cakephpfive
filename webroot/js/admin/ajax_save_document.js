$(document).ready(function(){
	$('.set_title').on('click', function(e){
		e.preventDefault();
		var attachment_title = $(this).siblings('.attachment_title').text();
		var input = "<div style='text-align: center' class='content-div form-control mb-2' ><input type='text' value='"+attachment_title+"' class='input_attachment_field form-control mb-2' name='attachment_title' placeholder='Enter Title'><button type='button' class='btn btn-xs btn-primary save_attachment' id='' name='' >Save</button></div>";

		if( $(this).siblings('.content-div').length == 0 ){
			$(this).parent('div').append(input);
		}
	});

	$(document).on('click','.save_attachment',function(){
		var new_title = $(this).siblings('.input_attachment_field').val();
		var id = $(this).parent('.content-div').siblings('a.set_title').attr('id');
		var controller = $(this).parent('.content-div').siblings('a.set_title').attr('controller');
		var title_element = $(this).parent('.content-div').siblings('.attachment_title');
		var input_content = $(this).parent('.content-div');

		$.ajax({
			url: '/admin/'+controller+'/save_title',
			type: 'post',
              headers: {
                    'X-CSRF-TOKEN': csrfToken,
            },
			data: {title:new_title, id:id },
			success: function(data){
				title_element.text(new_title);
				input_content.remove();
			}
		});
	});
});

