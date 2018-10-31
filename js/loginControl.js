$(document).ready(function(){
	
	var url = document.location.href;
	var urlExp = new RegExp("[?]logged=true$");
	if(urlExp.test(url)) {
		$(".loginGabekoak").remove();
	}
	else {
		$(".loginekoak").remove();
	}

});

$(document).ready(function(){
$("a").click(function(e){
	
	if(e.target.href != history.go(-1)) {
		e.preventDefault();
		var url = document.location.href;
		var urlExp = new RegExp("[?]logged=true$");
		if(urlExp.test(url)) {
			location.href = e.target.href + "?logged=true";
		}
		else {
			location.href = e.target.href;
		}
	}
	
});
});