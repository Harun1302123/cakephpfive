$('#fileupload').fileupload({
		sequentialUploads:true,
		autoUpload:true,
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true
		formData: {folder: "center"},
		url: '/Attachments/upload'
	}).bind('fileuploadcompleted', function (e, data) {$('#finish_button').removeAttr('disabled')});

	// Enable iframe cross-domain access via redirect option:
	$('#fileupload').fileupload(
		'option',
		'redirect',
		window.location.href.replace(
			/\/[^\/]*$/,
			'/cors/result.html?%s'
		)
	);