/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;
	}
}
function loadPopup2(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact_2").fadeIn("slow");
		popupStatus = 1;
	}
}
function loadPopup3(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact_3").fadeIn("slow");
		popupStatus = 1;
	}
}
//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#popupContact").fadeOut("slow");
		$("#popupContact_2").fadeOut("slow");
		$("#popupContact_3").fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContact").height();
	var popupWidth = $("#popupContact").width();
	//centering
	$("#popupContact").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	//only need force for IE6
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
	
}

function centerPopup2(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight2 = $("#popupContact_2").height();
	var popupWidth2 = $("#popupContact_2").width();
	//centering
	$("#popupContact_2").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight2/2,
		"left": windowWidth/2-popupWidth2/2
	});
	//only need force for IE6
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
	
}

function centerPopup3(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight3 = $("#popupContact_3").height();
	var popupWidth3 = $("#popupContact_3").width();
	//centering
	$("#popupContact_3").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight3/2,
		"left": windowWidth/2-popupWidth3/2
	});
	//only need force for IE6
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
	
}


function popInit() {
		
	//LOADING POPUP
	//Click the button event!
	$("#button").click(function(){
		//centering with css
		centerPopup();
		//load popup
		loadPopup();
	});
	$("#buttonPresentazione").click(function(){
		//centering with css
		centerPopup2();
		//load popup
		loadPopup2();
	});
	$("#buttonGenoa03").click(function(){
		//centering with css
		centerPopup3();
		//load popup
		loadPopup3();
	});			
	//CLOSING POPUP
	//Click the x event!
	$("#popupContactClose").click(function(){
		disablePopup();
	});
	$("#popupContactClose_2").click(function(){
		disablePopup();
	});
	$("#popupContactClose_3").click(function(){
		disablePopup();
	});
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});
	
	}

