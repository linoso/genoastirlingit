/* ------------------
init modal funtion
------------------ 
function modal_init() {

	//var btn_click 
	var modal_backdrop
	var name_modal;
	
	modal_switch();
	//modal_switch('close');

	$('.modal .close').click( function(){
		modal_switch('close');
	});

}

function modal_switch(caseSwich){
	switch(caseSwich) {
		case 'close':
			$('.modal').fadeOut(800);
			$('.modal-backdrop').fadeOut(500,function (){
				$('.modal-backdrop').remove();
			});
		break;
		case 'open':
		default:
			$('.modal').fadeIn(800);
			$('<div/>').attr('class','modal-backdrop').appendTo('body').hide();
			$('.modal-backdrop').fadeIn(500);
  		break;
	}
}
*/