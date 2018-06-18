function getUrlParam(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if(r != null) return decodeURI(r[2]);
	return null;
}

var u_id=localStorage.getItem('lastname')
var last_order=localStorage.getItem('last_order')
var last_price=localStorage.getItem('last_price')