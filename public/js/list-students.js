function change_status(student_serial,status){
	console.log("student_serial="+student_serial);
    console.log("status="+status.value);
    $.ajax({
		url: 'ajax_change_status',
		type: 'post',
		dataType: 'text',
		scriptCharset: 'utf-8',
		frequency: 10,
		cache: false,
		async : true,
		data: {'student_serial': student_serial,'status': status.value},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		   }
	}).done(function (data) {
		//console.log("Res="+data);
		if(data==1){
			alert("修正しました。");
		}else{
			alert("修正できませんでした。再度お試しください。");
		}
	}) .fail(function (XMLHttpRequest, textStatus, errorThrown) {
		//alert(XMLHttpRequest.status);
		//alert(textStatus);
		//alert(errorThrown);	
		alert('検索できませんでした。');
	});
}