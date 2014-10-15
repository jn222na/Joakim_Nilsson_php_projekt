<?php



	class confirmedPageView{
		private $usrValue;
		private $errormsg;
		private $msg;
		
		public function __construct(){
		
		}
		public function echoConfirmedPage(){
			$ret ="";
			
	  $ret ="
				<!DOCTYPE html>
				<html>
				<head>
				<link rel='stylesheet' type='text/css' href='mystyle.css'>
					<meta charset=UTF-8>
					<title>Lanster</title>
				</head>
				<body>
				<img src='bilder/2.png' name='BG' width='1680' height='1080' id='BG'>
				
				
				</body>
				</html>
				<div id='mainsection'>
				<div id='header'>
				<img src='bilder/header.png'>
				</div>
				<div id ='menu'>
							<a img href='index.php'><img src='bilder/hem.png'/></a>
							<a img href='?lanpics'><img src='bilder/lanpics.png'/></a>
							<a img href='booking.php'><img src='bilder/bokning.png'/></a>
							<a img href='?om_oss'><img src='bilder/om_oss.png'/></a>
							<a img href='?kontakt'><img src='bilder/kontakt.png'/></a>
				</div>
						<div id='container'>
						
		 <form id='loginn' class='pvit'  method='post'>
    		<label for='förnamn'>Förnamn:</label>
    			<br>
    		<input type='text'  name='förnamn' value='$this->usrValue' id='förnamn'>
    			<br>
    		<label for='efternamn'>Efternamn:</label>
    			<br>
    		<input type='efternamn'   name='efternamn' id='efternamn'>
    			<br>
    		<input type='submit' name='submitInfo'  value='Submit'/>
	    </form>
	    $this->errormsg
	    $this->msg
					 </div>	
			    </div>
				
		  ";
		return $ret;
	}
	}
