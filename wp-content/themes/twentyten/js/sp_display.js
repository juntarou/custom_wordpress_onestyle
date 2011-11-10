$(function(){
	setOperate();
});
function setOperate(){
	setView();
	var agent = navigator.userAgent;
	if(agent.search(/iPhone/) != -1){
		$("body").addClass("iphone"); //iPhoneには「body class="iphone"」追加
		window.onorientationchange = setView;
	}else if(agent.search(/iPad/) != -1){
		$("body").addClass("ipad"); //iPadには「body class="ipad"」追加
		window.onorientationchange = setView;
	}else if(agent.search(/Android/) != -1){
		$("body").addClass("android"); //Androidには「body class="android"」追加
		window.onresize = setView;
	}else{
		$("body").addClass("other"); //上記以外には「body class="other"」追加
		window.onorientationchange = setView;
	}
}
function setView(){
	var orientation = window.orientation;
	if(orientation === 0){
		$("body").addClass("portrait"); //画面が縦向きの場合は「body class="portrait"」追加
		$("body").removeClass("landscape"); //画面が縦向きの場合は「body class="landscape"」削除
	}else{
		$("body").addClass("landscape"); //画面が横向きの場合は「body class="landscape"」追加
		$("body").removeClass("portrait"); //画面が横向きの場合は「body class="portrait"」削除
	}
}
