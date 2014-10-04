<?php
require_once 'bookingModel.php';
class bookingHtml {

	private $row = 10;
	private $linebreak = 5;
	private $array;
	private $model;
	private $button;
	private $i;
	private $jaKnapp;
	private $nejKnapp;
	private $msg;
	private $errormsg;
	private $förnamn;
	private $efternamn;
	private $usrValue;
	public function __construct() {
		$this -> model = new bookingModel();
	}

	public function createSeats() {
		$array = '';
		for ($i = 1; $i <= $this -> row; $i++) {

			$array .= ("<input type='submit'   name='submit_[$i]' class='btn' value='Seat$i'><href='?bokning$i>");

			if ($i == $this -> linebreak) {
				$array .= "<br><br><br> ";
			}

			if ($this -> clickedSeat($i)) {
				$this -> i = $i;
			}
		}

		return $array;
	}

	public function clickedSeat($i) {

		if (isset($_POST['submit_'][$i])) {
			//TODO:Färga knappen
			// $knapp =  $_POST['submit'][$i];
			$this -> msg = "<p class='pvit'>Vill du ha plats nr:$i?</p>";
			$this -> jaKnapp = "<input type='submit' name='jaKnapp' value='Ja'>";
			$this -> nejKnapp = "<input type='submit' name='nejKnapp' value='Nej'>";

		} else {
			return FALSE;
		}
	}

	public function confirmSeat() {
		if (isset($_POST['jaKnapp'])) {
			//TODO:byt färg på knappen och skriv ut att platsen är bokad
			echo "jaknapp";
			return TRUE;
			
		}
		if (isset($_POST['nejKnapp'])) {
			echo "nej";
			return FALSE;
		}

	}
	
	
	
	public function didUserSubmitData() {
		
		
		if (isset($_POST['submit_x'])) {
			$förnamn = $_POST['förnamn'];
		$efternamn = $_POST['efternamn'];
			echo "buttonset";
			
			if ($förnamn == "") {
				$this -> usrValue = $förnamn;
				$this -> errormsg = "Förnamn är tomt.";
			}

			if ($förnamn != "" && $efternamn == "") {
				$this -> errormsg = "Efternamn är tomt.";
				$this -> usrValue = $förnamn;
			}

			if ($förnamn != "" && $efternamn != "Password") {
				$this -> usrValue = $förnamn;
			}
			
			return TRUE;
		}
		return FALSE;

	}
	
		//Get funktioner
	public function getFörnamn(){
	    if(isset($_POST['förnamn'])){
	        return  $_POST['förnamn'];
	    }
	}
	public function getEfternamn(){
	    if(isset($_POST['efternamn'])){
	        return  $_POST['efternamn'];
	    }
	}

	public function bookingEcho($msg) {
		$ret = "";
		$array = $this -> createSeats();
		if ($this -> confirmSeat()) {
			
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
						
		 <form id='loginn'  method='post' class='pvit' >
    		<label for='förnamn'>Förnamn:</label>
    			<br>
    		<input type='text'  name='förnamn' value='$this->usrValue' id='förnamn'>
    			<br>
    		<label for='efternamn'>Efternamn:</label>
    			<br>
    		<input type='text'   name='efternamn' id='efternamn'>
    			<br>
    		<input type='submit' name='submit_x'  value='Submit'/>
	    </form>
	    $this->errormsg
	    $msg
	    <div>
					 </div>	
			    </div>
				
		  ";
		  return $ret;
		  }
				
			
		
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
						</form> 
						
					 </div>	
			    </div>
				
			";
		
		
			return $ret;
		
	}

	

}
