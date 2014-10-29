<?php

class confirmedPageView {
	private $firstnameValue;
	private $lastnameValue;
	private $emailValue;
	private $errormsg;
	private $seatNumber;
	private $uniqueKey;
	private $regexCardnumber = '/^([0-9]{4})[-|s]*([0-9]{4})[-|s]*([0-9]{4})[-|s]*([0-9]{2,4})$/';
	private $regexMonth = '/^1[0-2]|0[1-9]/';
	private $regexYear = '/^(2014)|(20[1-4][0-9])$/';
	private $regexCvc = '/^([0-9]{3})$/';
	public function __construct() {
	   
	}

	public function getFirstname() {
		if (isset($_POST['firstname'])) {
			return $_POST['firstname'];
		} else {
		}
	}

	public function getLastname() {
		if (isset($_POST['lastname'])) {
			return $_POST['lastname'];
		}
	}

	public function getCardNumber() {
		if (isset($_POST['cardNumber'])) {
			return $_POST['cardNumber'];
		}
	}
	public function getCvc() {
		if (isset($_POST['cvc'])) {
			return $_POST['cvc'];
		}
	}
	public function getExpirationMonth() {
		if (isset($_POST['expirationMonth'])) {
			return $_POST['expirationMonth'];
		}
	}
	public function getExpirationYear() {
		if (isset($_POST['expirationYear'])) {
			return $_POST['expirationYear'];
		}
	}
	public function getEmail(){
	    if(isset($_POST['email'])){
	        return $_POST['email'];
	    }
	}
	public function getUnique(){
	        $this->uniqueKey = md5($this->getConfirmed());
	        $this->uniqueKey.= $this -> getConfirmed();
	        return $this->uniqueKey;
	}
	
public function didUserSubmitData() {
		$fornamn = $this -> getFirstname();
		$efternamn = $this -> getLastname();
		$email = $this->getEmail();
		$kortNr = $this->getCardNumber();
		$cvc = $this->getCvc();
		$month = $this->getExpirationMonth();
		$year = $this->getExpirationYear();
		$this -> seatNumber = $this -> getConfirmed();
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
				$this -> usrLastnameValue = $efternamn;
					return FALSE;
			}
		    else if ($email == ""){
				$this -> firstnameValue = $fornamn;
				$this -> usrLastnameValue = $efternamn;
				$this -> errormsg = "<p class='errorMsg'>Email får inte vara tomt.</p>";
				return FALSE;
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$this -> firstnameValue = $fornamn;
				$this -> usrLastnameValue = $efternamn;
				$this -> errormsg = "<p class='errorMsg'>Ogiltigt email format.</p>";
				return FALSE;
			}
		   	else if($_POST['paymentComp'] ==""){
			    $this -> errormsg = "<p class='errorMsg'>Måste välja tillverkare.</p>";
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> emailValue = $email;
				return FALSE;
			}
			else if(!preg_match($this->regexCardnumber, $kortNr)){
				$this -> errormsg = "<p class='errorMsg'>Kortnummer är tomt/innehåller andra tecken än siffror.</p>";
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> emailValue = $email;
				return FALSE;
			}
			else if(!preg_match($this->regexCvc, $cvc)){
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> emailValue = $email;
				$this -> errormsg = "<p class='errorMsg'>Cvc nummer är tomt/innehåller andra tecken än siffror, måste vara tre tecken.</p>";
				return FALSE;
				
			}
			else if(!preg_match($this->regexMonth, $month)){
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> emailValue = $email;
				$this -> errormsg = "<p class='errorMsg'>Månad måste fyllas i(Format ex. 01-09 10-12)/innehåller andra tecken än siffror.</p>";
				return FALSE;
			}
			else if(!preg_match($this->regexYear, $year)){
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> emailValue = $email;
				$this -> errormsg = "<p class='errorMsg'>År måste fyllas i (Format ex. 2014)/innehåller andra tecken än siffror.</p>";
				return FALSE;
			}
			return TRUE;
		}
	}
	public function checkExistingMember(){
	    if($this->getFirstname() != "" && $this->getLastname() != "" && $this->getCardNumber() != ""   && $this->getCvc() != "" && $this->getExpirationMonth() && $this->getExpirationYear()){
        return $this -> errormsg = "Platsen är redan upptagen var vänliga välj en annan.";
	    }
	   }

	public function getConfirmed() {
		if (isset($_GET['confirmed'])) {
			return $_GET['confirmed'];
		}
	}
		public function storeCookies(){
            setcookie('storedSeatNumber',$this->seatNumber, time() + 60 * 60 * 24 * 30);
            setcookie('storedEmail',$this->getEmail(), time() + 60 * 60 * 24 * 30);
            return true;
        }
        public function relocateToBooking(){
            header("Location: booking.php");
        }
	public function echoConfirmedPage() {

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
					<h3 class='pvit'>Du har valt plats nummer: $this->seatNumber
					<br>
					Fyll i formuläret för att betala för din plats.
	                 $this->errormsg
	    </h3>
					
	<div id='form' class='form'>				
		 <form id='login' class='formAlign'  method='post'>
    		<label for='förnamn'>Förnamn:</label>
    			<br>
    		<input type='text' class='inputStyle'  name='firstname' value='$this->firstnameValue' id='firstname'>
    			<br>
    		<label for='efternamn'>Efternamn:</label>
    			<br>
    		<input type='text'  class='inputStyle' value='$this->lastnameValue' name='lastname' id='lastname'>
    			<br>
    		<label for='email'>Email:</label>
    			<br>
    		<input type='text'  class='inputStyle' value='$this->emailValue' name='email' id='email'>
    			<br>
   	<label>Tillverkare</label>
   	<br>
   	<div id='select' class='styledSelect'>
    	<select name='paymentComp'>
		  <option value=''>Select...</option>
		  <option value='1'>Visa</option>
		  <option  value='2'>Mastercard</option>
		</select>
	</div>
		
    		
		<label>Kort Nummer</label>
			<br>
    	<input type='text' name='cardNumber' class='inputStyle' maxlength='19' autocomplete='off'>
			<br>		
		<label class='form'>CVC</label>
			<br>
		<input type='text' name='cvc' class='inputStyle' maxlength='3'  autocomplete='off'>
			<br>
		<label>Utgångsdatum (MM/YYYY)</label>
			<br>
		<input type='text' name='expirationMonth' class='inputStyle' maxlength='2'>
			<span> / </span>
		<input type='text' name='expirationYear' class='inputStyle' maxlength='4'>	
			<br>
		<input type='submit' name='submitInfo'  value='Köp'/>
			

	    </form>
	
	    </div>
					 </div>	
			    </div>
				
		  ";
		return $ret;
	}

}





