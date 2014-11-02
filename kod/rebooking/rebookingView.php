<?php

error_reporting(E_ALL);
require_once 'database/Repository.php';
    class rebookingView{
        private $rep;
        private $row = 15;
        private $errormsg;
        private $lastnameValue;
        private $firstnameValue;
        private $uniqueValue;
        public function __construct(){
             $this -> rep = new Repository();
        }
public function relocateToStart($seatNr){
    setcookie('rebookedSeat',"$seatNr", time() + 60 * 60 * 24 * 30);
    header("Location: ?booking.php");
}

public function checkInput() {
    	$fornamn = $this -> getFirstname();
		$efternamn = $this -> getLastname();
		$unik = $this -> getUnique();
  	if (isset($_POST['submitInfo'])) {

			if ($fornamn == "") {
				$this -> firstnameValue = $fornamn;
				$this -> errormsg = "<p class='errorMsg'>Förnamn är tomt.</p>";
				return FALSE;
			}
			//Använder strcspn då det är snabbare än regex.
			else if (strcspn($fornamn, '0123456789') != strlen($fornamn)){
				$this -> firstnameValue = $fornamn;
				$this -> errormsg = "<p class='errorMsg'>Förnamnet får inte innehålla siffror.</p>";
				return FALSE;
			}
			else if (strlen($fornamn) < 3 || strlen($fornamn) > 15) {
			    $this -> errormsg = "<p class='errorMsg'>Förnamnet måste innehålla fler än 3 bokstäver och mindre än 15.</p>";
				$this -> firstnameValue = $fornamn;
				$this -> usrLastnameValue = $efternamn;
					return FALSE;
			}
			else if ($efternamn == "") {
				$this -> errormsg = "<p class='errorMsg'>Efternamn är tomt.</p>";
				$this -> firstnameValue = $fornamn;
				$this -> usrLastnameValue = $efternamn;
				return FALSE;
			}
			else if (strcspn($efternamn, '0123456789') != strlen($efternamn)){
				$this -> firstnameValue = $fornamn;
				$this -> usrLastnameValue = $efternamn;
				$this -> errormsg = "<p class='errorMsg'>Efternamnet innehåller siffror.</p>";
				return FALSE;
			}
			else if (strlen($efternamn) < 3 || strlen($efternamn) > 15) {
			    $this -> errormsg = "<p class='errorMsg'>Efternamnet måste innehålla fler än 3 bokstäver och mindre än 15.</p>";
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
					return FALSE;
			}
			else if(strlen($unik) != 33 and strlen($unik) != 34){
			    $this -> errormsg = "<p class='errorMsg'>Felaktig länk.</p>";
			    $this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
			    return FALSE;
			}
			return true;
  	}
}
public function fetchMailFromDatabase($seatNr){
    $mail = $this->rep->fetchMail($seatNr);
        setcookie('rebookedMail',"$mail", time() + 60 * 60 * 24 * 30);
}
	public function getFirstname() {
		if (isset($_POST['firstname'])) {
		$_POST['firstname'] = ucfirst($_POST['firstname']);
			return $_POST['firstname'];
		} 
	}

	public function getLastname() {
		if (isset($_POST['lastname'])) {
		    $_POST['lastname'] = ucfirst($_POST['lastname']);
			return $_POST['lastname'];
		}
	}
		public function getUnique() {
		if (isset($_POST['unique'])) {
			return $_POST['unique'];
		}
	}
	public function getRebookedSeat(){
	    if(isset($_GET['rebooked'])){
	        return $_GET['rebooked'];
	    }
	}
	

        public function echoRebook(){
          	$echoSeatNumber = $this->getRebookedSeat();
          	$ret = "
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
					<h3 class='pvit'>Du har valt att avboka säte: $echoSeatNumber<br>
					Mata in ditt namn och efternamn samt länken ifrån ditt mail
					$this->errormsg </h3>
				<div id='form' class='form'>				
		 <form id='sendata' class='formAlign'  method='post'>
		 	<label for='förnamn'>Förnamn:</label>
    			<br>
    		<input type='text' class='inputStyle'  name='firstname' value='$this->firstnameValue' id='firstname'>
    			<br>
    		<label for='efternamn'>Efternamn:</label>
    			<br>
    		<input type='text'  class='inputStyle' value='$this->lastnameValue' name='lastname' id='lastname'>
    			<br>
    		<label for='unique'>Länk:</label>
    			<br>
    	    <input type='text'  class='inputStyle' value='$this->uniqueValue' name='unique' id='unique'>
    	    <br>
            <input type='submit' name='submitInfo'  value='Avboka'/>
	    </form>
					

			    </div>
				
		  ";
		return $ret;
        }
    }