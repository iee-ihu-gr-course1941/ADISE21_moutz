$(document).on('submit', '#sign_up_form', function(){ 
	$.ajax({url: "/ADISE21_moutz/routre.php/register", 
		method: 'POST',
		dataType: "json",
		contentType: 'application/json',
		data: JSON.stringify({username: $('#username').val(), password: $('#password').val(), email: $('#email').val()}),
	   success:  function(result) {
		   window.history.pushState("object or string", "Title", "../page/loginForm.html");
		   location.reload(true);
		   alert('Successful sign up. Please login');	
	   },
	   error: function(xhr, resp, text){
		   alert('Unable to sign up. Please contact admin');
	   }
   });

   return false;

});
		






$(document).on('submit', '#login_form', function(){ 
$.ajax({url: "/ADISE21_moutz/routre.php/login", 
   method: 'POST',
   dataType: "json",
   contentType: 'application/json',
   data: JSON.stringify({username: $('#username').val(), password: $('#password').val()}),
   success:  function(result) {
	   setCookie("jwt", result.jwt, 1);
		window.history.pushState("object or string", "Title", "../page/lobby.html");
		location.reload(true);

   },
   error: function(xhr, resp, text){
	   alert('Unable to login. Please contact admi1n');
   }
});

return false;

});

$(document).ready(function(){ 
var jwt = getCookie('jwt');  
$.ajax({url: "/ADISE21_moutz/routre.php/validate", 
   method: 'POST',
   dataType: "json",
   contentType: 'application/json',
   data: JSON.stringify({jwt:jwt}),
   success:  function(result) {
	   
	   $( ".username-main-span" ).append( "<p>"+ result.data.username +"</p>" );
	   
	   //  window.history.pushState("object or string", "Title", "../page/lobby.html");
	   // location.reload(true);

   },
   error: function(xhr, resp, text){
	   alert('Unable to login. Please contact admi1n');
   }
});

return false;

});




function setCookie(cname, cvalue, exdays) {
var d = new Date();
d.setTime(d.getTime() + (exdays*24*60*60*1000));
var expires = "expires="+ d.toUTCString();
document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
   // error:window.alert("aaa")
function getCookie(cname){
var name = cname + "=";
var decodedCookie = decodeURIComponent(document.cookie);
var ca = decodedCookie.split(';');
for(var i = 0; i <ca.length; i++) {
   var c = ca[i];
   while (c.charAt(0) == ' '){
	   c = c.substring(1);
   }

   if (c.indexOf(name) == 0) {
	   return c.substring(name.length, c.length);
   }
}
return "";
}