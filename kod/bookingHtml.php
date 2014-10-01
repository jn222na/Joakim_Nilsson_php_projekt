<?php

	 class bookingHtml{
	 	
		
		private $row = 10;
		private $column = 6;
		private $linebreak = 5;
		public function createSeats(){
			$array = '';
			for ($i=1; $i <= $this->row; $i++) {
		
			$array .= "<a href='?bokning$i'><img src='bilder/availableseat.png' alt='' title='Seat $i'>";
				
				if($i == $this->linebreak){
					$array .= "<br><br><br> ";
				}
				
			}
		
			return $array;
		}
		
		public function clickedSeat(){
			if(isset($_GET['?bokning1'])){
					echo "säte";
				}
			else{
				echo "inget säte";
			}
		}
		
		public function bookingEcho(){
			$array = $this->createSeats();
			
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
							<a img href='?bokning'><img src='bilder/bokning.png'/></a>
							<a img href='?om_oss'><img src='bilder/om_oss.png'/></a>
							<a img href='?kontakt'><img src='bilder/kontakt.png'/></a>
						</div>
						<div id='container'>
						<tr>
						<td>
							$array
						</td>
						</tr>
						
					 </div>	
						
						
						
			    </div>
					
				</body>
				</html>
		";
		}
	 }