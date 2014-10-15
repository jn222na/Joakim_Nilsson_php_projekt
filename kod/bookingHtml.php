<?php
require_once 'bookingModel.php';
class bookingHtml {

	private $row = 10;
	private $linebreak = 5;
	private $array;
	private $model;
	private $button;
	public $i;
	private $jaKnapp;
	private $jaKnapps;
	private $nejKnapp;
	private $msg;
	private $errormsg;
	private $fornamn;
	private $efternamn;
	private $usrValue;
	private $hej;
	public function __construct() {
		$this -> model = new bookingModel();
	}

	private function createSeats() {
		$array = '';
		for ($i = 1; $i <= $this -> row; $i++) {

			$array .= ("<a href='/Projekt/booking.php?seat=$i'  id='btn' onClick='colourGreen()'; name='submit_[$i]' class='btn' value='Seat$i'>Seat$i</a>");

			if ($i == $this -> linebreak) {
				$array .= "<br><br><br> ";
			}

			
		
			
		}
		return $array;
	}

public function getSeat(){
	if(isset($_GET['seat'])){
		return $_GET['seat'];
	}
}

public function getConfirm(){
	if(isset($_GET['confirmed'])){
		echo "fetconfirmed";
		return true;
	}
	else{
		return false;
	}
}

	public function clickedSeat($i) {
			//TODO:Färga knappen
			$this -> msg = "<p class='pvit'>Vill du ha plats nr:$i?</p>";
			$this -> nejKnapp = "<a href='/Projekt/booking.php' name='nejKnapp' value='Nej'>Nej</a>";
	}

	public function confirmSeat($i) {
			//TODO:byt färg på knappen och skriv ut att platsen är bokad
			$this -> jaKnapp = "<a href='/Projekt/booking.php?confirmed=".$i."' name='jaKnapp' value='Ja'>Ja</a>";
			 return true;
	}
	
	
	
	public function echoForm(){
		  $this-> hej ="
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
		  var_dump($this->hej);
	}

	

	//Get funktioner
	public function getfornamn() {
		if (isset($_POST['fornamn'])) {
			return $_POST['fornamn'];
		}
	}

	public function getEfternamn() {
		if (isset($_POST['efternamn'])) {
			return $_POST['efternamn'];
		}
	}

	public function bookingEcho($msg) {
		$ret = "";
		
		$array = $this -> createSeats();
	
	
		$ret = "
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
						<form id='login'   method='post'>
							$array
							$this->msg
							$this->jaKnapp
							$this->nejKnapp
							$this->hej
							$msg
							$this->errormsg
						</form> 
						
					 </div>	
			    </div>
				
			";
	
		return $ret;

	}

}
