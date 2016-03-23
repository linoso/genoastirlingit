            <?php
			$pagina = $_SERVER['REQUEST_URI'];
			if ($pagina == "/" || $pagina == "/index.php") {
				$stile = "style='background:none; margin:0;'";
				}
			?>


	<div class="footer" <?php print $stile ;?> >
                I nostri riferimenti: <br />
                <div id="genoa">Genoastirling S.r.l.</div> <br />
                Corso Buenos Aires 75 - 20124  Milano<br />
                P. Iva e C.F.  06780080963 - Cap. soc. € 10.000,00 i.v.<br />
                Tel: 02/26306344 - Fax: 02/26306780 - <a href="javascript:mail_no_spam('info','genoastirling.it')">email</a><br />
								<a href="cookie-policy.php">Cookie policy</a>
     </div>
