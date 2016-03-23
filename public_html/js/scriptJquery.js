function init2(){

	$('#quadro div').hide();
	
	showImg(0);
		
	$('.menu_2 li a').click(function() {
		$('#quadro div').hide();
		$("li").removeClass("acceso");
		var indice = jQuery(".menu_2 li a").index(this);
		showImg(indice);		
		return false;			
	});	
	
	function showImg(val){
		$('.menu_2 li:eq('+val+')').addClass("acceso");
		$('#quadro div:eq('+val+')').fadeIn();
	}
}


function initMenu(paginaAttuale) {
			$('.menu li a').each(function(){
				if (this.href.indexOf(paginaAttuale) != -1) {
					$(this).addClass('active');
				} 
			});

	}

