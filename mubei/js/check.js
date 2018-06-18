mui.init();
    mui.getJSON("manifest.json",null,function(data){
    	var name = data.version.name; 
    	$.ajax({
					url: j_url+"turnin/check",
					type: 'POST',
					dataType: 'jsonp',
					crossDomain: true,
					data:{
						token:'check',
						banben:name
					},
					success: function(result) {
						console.log(result);
						if(result.code==1) {
							alert('请更新版本');
							window.location.href=result.url;
						} 
					},
					fail: function(result) {

					}
				});

    	
    
    });