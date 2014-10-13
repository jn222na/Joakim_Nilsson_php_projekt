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
	private $nejKnapp;
	private $msg;
	private $errormsg;
	private $fornamn;
	private $efternamn;
	private $usrValue;
	public function __construct() {
		$this -> model = new bookingModel();
	}

	public function createSeats() {
		$array = '';
		for ($i = 1; $i <= $this -> row; $i++) {

			$array .= ("<a href='/Projekt/booking.php?seat$i'  id='btn' onClick='colourGreen()'; name='submit_[$i]' class='btn' value='Seat$i'>Seat$i</a>");

			if ($i == $this -> linebreak) {
				$array .= "<br><br><br> ";
			}

			
		$this->getSeatClicked($i);
			
		}

		return $array;
	}
public function getSeatClicked($i){
	// echo "$i";
	 if(isset($_GET['seat'.$i])){
	 	$this->i = $i;
	 	echo "hej$i";
		return true;
		
	}

}
	public function clickedSeat() {

		
			//TODO:Färga knappen
			// $knapp =  $_POST['submit'][$i];
			// $this -> i = $i;
			$this -> msg = "<p class='pvit'>Vill du ha plats nr:$this->i?</p>";
			$this -> jaKnapp = "<a href='?btn".$this->i."' name='jaKnapp' value='Ja'>Ja</a>";
			$this -> nejKnapp = "<a href='/Projekt/booking.php' name='nejKnapp' value='Nej'>Nej</a>";
		
	}

	public function confirmSeat() {
		
		if (isset($this->jaKnapp)) {
			//TODO:byt färg på knappen och skriv ut att platsen är bokad
			echo "satt";
			 return true;
		}
		
		return false;
	}

	public function didUserSubmitData() {

		if (isset($_POST['submit_x'])) {
			$fornamn = $_POST['fornamn'];
			$efternamn = $_POST['efternamn'];

			if ($fornamn == "") {
				$this -> usrValue = $fornamn;
				$this -> errormsg = "<p class='pvit'>Förnamn är tomt.</p>";
				return FALSE;
			} else if (efternamn == "") {
				$this -> errormsg = "<p class='pvit'>Efternamn är tomt.</p>";
				$this -> usrValue = $fornamn;
				return FALSE;
			}

			return TRUE;
		}

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
							$msg
							$this->errormsg
						</form> 
						
					 </div>	
			    </div>
				
			";
	
		return $ret;

	}

}
