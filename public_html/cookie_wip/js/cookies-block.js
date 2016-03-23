
var wipWidgets = window.wipWidgets || {};

wipWidgets.cookiesWidget = (function(doc,win) {

		// ----------- ISTANZIAZIONE

		_jQChecker();
		var widgetH;

		// controllo esistenza jquery, in caso inserimento
		function _jQChecker(){
			if(typeof jQuery =='undefined') {
			    var headTag = document.getElementsByTagName("head")[0];
			    var jqTag = document.createElement('script');
			    jqTag.type = 'text/javascript';
			    jqTag.src = 'cookie_wip/js/jquery.min.js';
			    headTag.appendChild(jqTag);
			    jqTag.onload = _init();
			} else {
				_init();
			}
		}

		// ----------- METODI PRIVATI

		function _init(){
			setTimeout(function(){
				widgetH = jQuery('#cookies-wip-block').outerHeight();
				jQuery( document ).ready(function() {
					if(_readCookie('cookie_acceptance')!='accepted') {
						_initAnimation();
						_removeCookieBlock();
						_openBlock();
						_accordion();
					 }
				});
			}, 500);
		}


		function _initAnimation(){
				jQuery( "#cookies-wip-block.block-cookies" ).css({
					 'display':'block'
					,'margin-top':-widgetH
				});
				jQuery( "#cookies-wip-block.block-cookies" ).animate({
				  'margin-top':0,
				}, 1500);

		}

		function _createCookie(cookieName, howlong, value){
			var expiring = new Date();
		  	var now = new Date();
		  	var howmanyminutes = howlong// 525948: one year
		  	expiring.setTime(now.getTime() + (parseInt(howmanyminutes) * 60000));
		  	document.cookie = cookieName + '= '+ value +'; expires=' + expiring.toGMTString() + '; path=/';
		}

		function _readCookie(cookieName){
			if (document.cookie.length > 0) {
			  var inizio = document.cookie.indexOf(cookieName + "=");
			  if (inizio != -1) {
			    inizio = inizio + cookieName.length + 1;
			    var fine = document.cookie.indexOf(";",inizio);
			    if (fine == -1) fine = document.cookie.length;
			    return unescape(document.cookie.substring(inizio,fine));
			  }else{
			     return "";
			  }
			}
			return "";
		}


		function _removeCookieBlock(){
			jQuery('#cookies-wip-block .btn-cookies-close').click(function(){
				_createCookie('cookie_acceptance', 525948, 'accepted');
				jQuery('.cookies-body').slideUp('fast', function(){
					jQuery( "#cookies-wip-block.block-cookies" ).animate({
				    'margin-top':-widgetH,
				  	}, 300, function(){
			  			jQuery(this).hide();
				  	});
				});
			});
		}

		function _openBlock(){
			jQuery('#cookies-wip-block  a.open-cookies-body').click( function(){
				if(jQuery(this).hasClass('clicked')){
					jQuery(this).removeClass('clicked');
					jQuery('.cookies-body').slideUp('slow');
				} else {
					jQuery(this).addClass('clicked');
					jQuery('.cookies-body').slideDown('slow');
				}
				
			});
		}

		function _accordion(){
			var closedPanels = jQuery('#cookies-wip-block .cookies-accordion > dd:not(.active)').hide();

			jQuery('#cookies-wip-block .cookies-accordion > dt > h4 > span.cookies-info-label').html('Espandi');
			jQuery('#cookies-wip-block .cookies-accordion > dd.active').prev().find('span.cookies-info-label').html('Comprimi');

			jQuery('#cookies-wip-block .cookies-accordion > dt >.cookies-label').click(function(){


				obj = jQuery(this);
				target = obj.parent().next();
				target.toggleClass('active');

				if (obj.parent().parent().hasClass("main")) {
					var allPanels = jQuery('#cookies-wip-block .cookies-accordion > dd');
				}else{
					var allPanels = jQuery('#cookies-wip-block .cookies-accordion .cookies-accordion > dd');
				}


				if(target.hasClass('active')){
					jQuery('#cookies-wip-block .cookies-accordion .cookies-info-label').html('Espandi');
					obj.find('.cookies-info-label').html('Comprimi');
					allPanels.removeClass('active').slideUp('slow');
					target.addClass('active').slideDown('slow');
				}else{
					jQuery('#cookies-wip-block .cookies-accordion .cookies-info-label').html('Espandi');
					allPanels.removeClass('active').slideUp('slow');
					target.removeClass('active').slideUp('slow');

				}

				return false;
			});
		}




})(document, window);	



