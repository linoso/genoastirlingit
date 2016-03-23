<?php
/* =========================================================
 * [tocss.php]
 * Project:			vetroelite_1.0.0
 * Description:   compiler and compress less to css
 * Start on:    14/10/2013
 * Copyright:   2013 Wip Italia S.r.l. 
 * Author URI:    http://www.wipitalia.it/ 
 * ========================================================= *
 * this file is minifized and inport by script.html include
 * ========================================================= */
?>
<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (!$_GET['file'] && !$_POST['file']) {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>ATTENTION need to get filename to compile</title>
			<link rel='shortcut icon' type='image/png' href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAoklEQVQ4ja2TMQ7CMBAER9Ag0YBoaBNRI6iTFFT5/0OSLyzNRTLWOgkQSydZ673x+WxDNgStYBQMWYyCNvfnybVAC1GXkqsVyVNUv+zsKxH0ZvFhtMZoPdGgVDwF+JZoXVJt6h0cQIJzmO+CV8x3xlcEfHRbcCl4ZgHNiiYXAV0kHgo9mQU8zZknyNUB3DXujXa01/j3Q9rkKW/ymRLIV9/5DV+BbmvD2DmTAAAAAElFTkSuQmCC'>
		</head>
		<body>
			<p>ATTENTION need to get filename to compile</p></body>
			<p>
				http://localhost/sgm.git/dev_asset/less/tocss.php?file=default<br>
				http://localhost/sgm.git/dev_asset/less/tocss.php?file=smaller<br>
				http://localhost/sgm.git/dev_asset/less/tocss.php?file=wider<br>
				http://localhost/sgm.git/dev_asset/less/tocss.php?file=ie7
			</p>
			<p>p.s.: just file name not estension like <i>?file=default</i> or  <i>?file=smaller</i>.</p>
		</body>
	</html>
	

<?php
} elseif ($_GET['file']) {
		$fileName=$_GET['file']
?>
	<!DOCTYPE html>
	<html>
			<meta charset="utf-8">
			 <head>
					<title>WIP LESS COMPILER</title>
					<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
					<link rel='shortcut icon' type='image/png' href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAtklEQVQ4jcWRTQrCMBCFv2P4h+DPRtK0CF5AENy79YzFZlqvo7aKQi9RNwpNWkvtQh/MZvK+eckE/qEgYdsZ1kKmhcI7MOsCp1oo3uUZdq1hT7iUYS2ktsGwakg+O3BmGyL06yAv9/2QkRZOFmy42nDM3pmeAwQxQ6dfaOFWvV7ExjWqmHElWSh8YVL7RnWkV5NmV8K0ccuLkP4nuPWfLw0DZ2F3ZZi3gmuGPL4Cy1KGdWf453oC0FyEF/4/YeUAAAAASUVORK5CYII='>
			</head>
			
			<body>        
			<script src="less-1.6.3.min.js" type="text/javascript"></script>
			<script type="text/javascript">
			$(document).ready(function(){

					/* ---------------- DA CONFIGRARE: ----------------------------------- */

					/* pathToLess: percorso da questo file alla cartella dei sorgenti less */
					/* serve al configuratore per gli @import che trova nello style.less */
					var pathToLessFolder = '';
					

					// lessFile: la sorgente da compilare: importerà in @import tutti gli altri less 
					var lessFile = pathToLessFolder+'<?php echo $fileName?>.less';

					// cssFile: il percorso di salvataggio del file finale compilato e minifizzato  
					var cssFile = '../../css/<?php echo $fileName?>';   //output css SOLO il nome del file senza il formnato .css

					/* ------------------------------------------------------------------- */

					var checkDelay = 1000;
					var adesso = new Date(Date.now()).toISOString();
					var saverFile = 'tocss.php'



					var getMTime = function() {
							 var check = $.ajax({
											url: lessFile,
											type: "GET",
											cache: false,
											success: function (data, status) {
													var modifica = new Date(check.getResponseHeader('Last-Modified')).toISOString();
													if(modifica > adesso ) {
														//console.log('oggi:'+adesso+' - ora: '+modifica);
														//creo il css compilato e minifizzato
														var lessCode = data, parser = new less.Parser({
															paths: [pathToLessFolder],
														});
														parser.parse(lessCode, function (error, root) { 
															if (error) {
																//informo del mancato parsing
																$('title').text('ATTENZIONE! LESS IN ERRORE.');
																$('#rev').html('<i>Errore: </i><span>'+error.message+'</span><br/><i>Alla linea: </i><span>'+error.line+'</span>');
																setFavicon('error');                      
															} else {
																// inizializzo l'ajax che lo salva
																saveCss(root.toCSS({compress:true,comments:true}));
															}
														});

														//riciclo la data modifica
														adesso = modifica;
													}
											},
											error: function (xhr, err) {
											},
											complete: function(){
											}
							 });
					}


					var saveCss = function(compiledCode){
							 var saver = $.ajax({
											url: saverFile,
											type: "POST",
											data: {file: cssFile, content: compiledCode},
											cache: false,
											success: function (data, status) {
												$('title').text('<?php echo $fileName?> - OK! LESS COMPILATO.');
												$('#rev').html('<i>Il file è compresso ma non viene salvato con estensione .min.css // File compilato: </i><span>'+adesso+'</span>');
												setFavicon('confirm');  
											},
											error: function (xhr, err) {
												//informo del mancato salvataggio
												$('title').text('ATTENZIONE! CSS NON SALVATO.');
												$('#rev').html('<i>Errore: </i><span>Non è riuscito il salvataggio del file <?php echo $fileName?>.css.</span>');
												setFavicon('error');                      
											},
											complete: function(){
											}
							 });
					}


					var setFavicon = function(status){
						switch(status) {
								case 'error':
									$('link[rel="shortcut icon"]').attr('href','data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAoklEQVQ4ja2TMQ7CMBAER9Ag0YBoaBNRI6iTFFT5/0OSLyzNRTLWOgkQSydZ673x+WxDNgStYBQMWYyCNvfnybVAC1GXkqsVyVNUv+zsKxH0ZvFhtMZoPdGgVDwF+JZoXVJt6h0cQIJzmO+CV8x3xlcEfHRbcCl4ZgHNiiYXAV0kHgo9mQU8zZknyNUB3DXujXa01/j3Q9rkKW/ymRLIV9/5DV+BbmvD2DmTAAAAAElFTkSuQmCC');
									$('body').css('background','white');
								break;
								case 'confirm':
									$('link[rel="shortcut icon"]').attr('href','data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAtklEQVQ4jcWRTQrCMBCFv2P4h+DPRtK0CF5AENy79YzFZlqvo7aKQi9RNwpNWkvtQh/MZvK+eckE/qEgYdsZ1kKmhcI7MOsCp1oo3uUZdq1hT7iUYS2ktsGwakg+O3BmGyL06yAv9/2QkRZOFmy42nDM3pmeAwQxQ6dfaOFWvV7ExjWqmHElWSh8YVL7RnWkV5NmV8K0ccuLkP4nuPWfLw0DZ2F3ZZi3gmuGPL4Cy1KGdWf453oC0FyEF/4/YeUAAAAASUVORK5CYII=');
									var bgcolor= '#'+((1<<24)*Math.random()|0).toString(16);
									$('body').css('background',bgcolor);
								break;              
						}
					}

					var init = function(){
								// intervallo di verifica, ogni N millisecondi
							var lesschecker = self.setInterval(function(){
								getMTime();
							},checkDelay);

							window.onerror = function(msg) {
								$('title').text('ATTENZIONE! CONSOLE IN ERRORE');
								$('#rev').html('<i>Errore: </i><span>'+msg+'</span><br/>Qualcosa e\' andato storto, probabilmente un mixin less usato con parametri a cazzo oppure una variabile less usata ma non valorizzata inizialmente.</span>');
								setFavicon('error');                      
							}
					}

					function changeColInUri(data,colfrom,colto) {
							// create fake image to calculate height / width
							var img = document.createElement("img");
							img.src = data;
							img.style.visibility = "hidden";
							document.body.appendChild(img);

							var canvas = document.createElement("canvas");
							canvas.width = img.offsetWidth;
							canvas.height = img.offsetHeight;

							var ctx = canvas.getContext("2d");
							ctx.drawImage(img,0,0);

							// remove image
							img.parentNode.removeChild(img);

							// do actual color replacement
							var imageData = ctx.getImageData(0,0,canvas.width,canvas.height);
							var data = imageData.data;

							var rgbfrom = hexToRGB(colfrom);
							var rgbto = hexToRGB(colto);

							var r,g,b;
							for(var x = 0, len = data.length; x < len; x+=4) {
									r = data[x];
									g = data[x+1];
									b = data[x+2];

									if((r == rgbfrom.r) &&
										 (g == rgbfrom.g) &&
										 (b == rgbfrom.b)) {

											data[x] = rgbto.r;
											data[x+1] = rgbto.g;
											data[x+2] = rgbto.b;

									} 
							}

							ctx.putImageData(imageData,0,0);

							return canvas.toDataURL();
					}

					
					//  An additional function is required to convert hex colors to RGB (for correct matching)

					function hexToRGB(hexStr) {
							var col = {};
							col.r = parseInt(hexStr.substr(1,2),16);
							col.g = parseInt(hexStr.substr(3,2),16);
							col.b = parseInt(hexStr.substr(5,2),16);
							return col;
					}



					init();



			});
			</script>

			<div id="rev">START</div>
			</body>
	</html>
<?php
} elseif (!$_GET['file'] && $_POST['file']) {
		$date = date('m/d/Y h:i:s a', time());
		$file = $_POST["file"].'.css';
		$content = "@charset 'utf-8';
/* =========================================================
 * Project:			SGM
 * Last change:		".$date."
 * Copyright:		2014 Wip Italia S.r.l.
 * Author URI:		http://www.wipitalia.it/
 * ---------------------------------------------------------
 * this file is minifized from .less extension files
 * ---------------------------------------------------------
 * ========================================================= */
".$_POST["content"];

		$fp = fopen($file, 'w');
		$fw = fwrite($fp, $content);
	//	$fw = fwrite($fp, stripslashes($content));
		fclose($fp);
	} else {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>OPS</title>
			<link rel='shortcut icon' type='image/png' href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAoklEQVQ4ja2TMQ7CMBAER9Ag0YBoaBNRI6iTFFT5/0OSLyzNRTLWOgkQSydZ673x+WxDNgStYBQMWYyCNvfnybVAC1GXkqsVyVNUv+zsKxH0ZvFhtMZoPdGgVDwF+JZoXVJt6h0cQIJzmO+CV8x3xlcEfHRbcCl4ZgHNiiYXAV0kHgo9mQU8zZknyNUB3DXujXa01/j3Q9rkKW/ymRLIV9/5DV+BbmvD2DmTAAAAAElFTkSuQmCC'>
		</head>
		<body>
			<p>OPS</p></body>
		</body>
	</html>
<?php
	}
?>
