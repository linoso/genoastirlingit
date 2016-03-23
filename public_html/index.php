<?
 $host = $_SERVER['HTTP_HOST']; 
 if($host == "www.genoastirling.com" || $host == "genoastirling.com") {
	Header( "HTTP/1.1 301 Moved Permanently" ); 
	Header( "Location: http://www.genoastirling.com/eng/" ); 
 } else {
	Header( "HTTP/1.1 301 Moved Permanently" ); 
	Header( "Location: http://www.genoastirling.it/ita/" ); 
 }
?> 