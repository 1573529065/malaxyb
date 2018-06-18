$(document).ready(function() {
	checkLogin();

});

function checkLogin() {

	if(localStorage.lastname) {
		//							window.location.href = '../index.html';
	} else {
		window.location.href = 'login.html';
	}

}



