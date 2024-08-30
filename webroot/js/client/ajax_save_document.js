$(document).ready(function(){
	$('.set_title').on('click', function(e){
		e.preventDefault();
		var attachment_title = $(this).siblings('.attachment_title').text();
		var input = "<div class='input_content' ><input type='text' value='"+attachment_title+"' class='input_attachment_field' name='attachment_title' placeholder='Enter Title'><button type='button' class='btn btn-xs btn-primary save_attachment' id='' name='' >Save</button></div>";
		
		if( $(this).siblings('.input_content').length == 0 ){
			$(this).parent('div').append(input);
		}
	});

	$(document).on('click','.save_attachment',function(){
		var new_title = $(this).siblings('.input_attachment_field').val();
		var id = $(this).parent('.input_content').siblings('a.set_title').attr('id');
		var controller = $(this).parent('.input_content').siblings('a.set_title').attr('controller');
		var title_element = $(this).parent('.input_content').siblings('.attachment_title');
		var input_content = $(this).parent('.input_content');

		$.ajax({
			url: '/client/'+controller+'/save_title',
			type: 'post',
			data: {title:new_title,id:id },
			success: function(data){
				title_element.text(new_title);
				input_content.remove();
			}
		});

	});

});

