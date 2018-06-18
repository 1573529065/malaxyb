function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }

    var tab = getQueryString('tab');

    function back(){
        window.location.href="../index.html?tab="+tab+"";
    }
    
    function back_jiaoyi(){
        window.location.href="../jiaoyi.html?tab="+tab+"";
    }
    
function back_go(){
	window.history.go(-1);
}


