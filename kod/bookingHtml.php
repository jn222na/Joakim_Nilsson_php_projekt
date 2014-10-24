<?php
require_once 'database/Repository.php';
require_once 'confirmed/confirmedView.php';
class bookingHtml {

	private $row = 10;
	private $linebreak = 5;
	private $array;
	private $model;
    private $confirmhtml;
	public $i;
	private $jaKnapp;
	private $nejKnapp;
	private $msg;
	private $successfullBooking;
	private $fornamn;
	private $efternamn;
	private $usrValue;
	private $form;
	
	private $test = "asdsad";
	private $hej;
	public function __construct() {
		$this -> model = new Repository();
		$this->confirmhtml = new confirmedPageView();
	}

	private function createSeats() {
		$array = '';
		for ($i = 1; $i <= $this -> row; $i++) {

    		//????
    		  if($this->model->fetchCredentials($i)){
                    $array .= ("<a href='/Lanster/booking.php?seat=$i'  id='btn' onClick='colourGreen()'; name='submit_[$i]' class='btnDisabled' value='Seat$i'>Seat$i</a>");
                }
                else{
                    $array .= ("<a href='/Lanster/booking.php?seat=$i'  id='btn' onClick='colourGreen()'; name='submit_[$i]' class='btnEnabled' value='Seat$i'>Seat$i</a>");
                   
                }
		

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
		return true;
	}
	else{
		return false;
	}
}

	public function clickedSeat($i) {
			//TODO:Färga knappen
			$this -> msg = "<p class='pvit'>Vill du ha plats nr:$i?</p>";
			$this -> nejKnapp = "<a href='/Lanster/booking.php' name='nejKnapp' class ='confStyle' value='Nej'>Nej</a>";
	}

	public function confirmSeat($i) {
			//TODO:byt färg på knappen och skriv ut att platsen är bokad
			$this -> jaKnapp = "<a href='/Lanster/booking.php?confirmed=".$i."' name='jaKnapp' class ='confStyle' value='Ja'>Ja</a>";
			 return true;
	}
	
	


      public function echoBookedSeat(){
        if(isset($_COOKIE['cookieNewUsername'])){
            $s = $_COOKIE['cookieNewUsername'];
            $this->hej = "<h3 class='pvit'>Du har bokat plats nummer $s</h3>" ;
            setcookie('cookieNewUsername', "", time() - 3600);
          }
	}

	public function echoForm(){
		  $this-> form ="
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
	    $this->msg
					 </div>	
			    </div>
				
		  ";
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
							$this->echoBookedSeat
							$this->msg
							$this->jaKnapp
							$this->nejKnapp
							$this->form
							$msg
							<br>
							<br>
                            $this->hej
						</form> 
						
					 </div>	
			    </div>
				
			";
	
		return $ret;

	}

}
