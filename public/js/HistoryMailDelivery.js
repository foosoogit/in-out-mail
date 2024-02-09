function ShowSendingTo(mail_serial){
	$.ajax({
		url: 'ajax_get_mail_sending_to',
		type: 'post',
		dataType: 'text',
		scriptCharset: 'utf-8',
		frequency: 10,
		cache: false,
		async : false,
		data: {'mail_serial': mail_serial},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		   }
	}).done(function (data) {
		alert("送信先：\n"+data);
	}) .fail(function (XMLHttpRequest, textStatus, errorThrown) {
		//alert(XMLHttpRequest.status);
		//alert(textStatus);
		//alert(errorThrown);	
		alert('検索できませんでした。');
	});
}