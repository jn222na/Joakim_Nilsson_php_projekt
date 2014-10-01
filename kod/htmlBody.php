<?php
require_once 'bookingController.php';
	class htmlBody{
		private $controller; 
		public function __construct(){
			$this->controller = new bookingController();
		}
		
		public function echoHTML(){
			
			// if(isset($_GET['lanpics'])){    
    		        // $this->controller->presentPage();
			// }
			
			
				echo "
				<!DOCTYPE html>
				<html>
				<head>
				<link rel='stylesheet' type='text/css' href='mystyle.css'>
					<meta charset=UTF-8>
					<title>Lanster</title>
				</head>
				<body>
				<img src='bilder/2.png' name='BG' width='1680' height='1080' id='BG'>
			
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
						<iframe width='725' height='408' src='http://www.youtube.com/embed/tPalCVAGW4o?feature=player_detailpage' frameborder='0' allowfullscreen></iframe>
					 </div>	
					</div>
					
				</body>
				</html>
		";
			}
			 
		
		}

		
	
