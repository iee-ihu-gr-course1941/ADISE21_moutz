$(document).on('submit', '#sign_up_form', function(){ 
		 $.ajax({url: "/aa/adise2021/routre.php/register", 
			 method: 'POST',
			 dataType: "json",
			 contentType: 'application/json',
			 data: JSON.stringify({username: $('#username').val(), password: $('#password').val(), email: $('#email').val()}),
            success:  window.history.pushState("object or string", "Title", "../page/loginForm.html"),
            error:window.alert("aaa")
	 //     beforeSend: function(jqXHR, settings) {
	 //   document.write(settings.url);
 //    }
});
			 
 
 });
 
 
 
	
 $(document).on('submit', '#login_form', function(){ 
	$.ajax({url: "/aa/adise2021/routre.php/login", 
		method: 'POST',
		dataType: "json",
		contentType: 'application/json',
		data: JSON.stringify({username: $('#username').val(), password: $('#password').val()}),
      success: window.history.pushState("object or string", "Title", "../page/lobby.html"),
		// error:window.alert("aaa")
//     beforeSend: function(jqXHR, settings) {
//   document.write(settings.url);
//    }
	});
		

});
