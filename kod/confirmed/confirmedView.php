<?php

class confirmedPageView {
	private $firstnameValue;
	private $lastnameValue;
	private $a;
	private $errormsg;
	private $msg;
	private $seatNumber;
	public function __construct() {
	}

	public function getFirstname() {
		if (isset($_POST['firstname'])) {
			echo "isset";
			return $_POST['firstname'];
		} else {
			echo "issetnot";
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
	
public function didUserSubmitData() {
		$fornamn = $this -> getFirstname();
		$efternamn = $this -> getLastname();
		$kortNr = $this->getCardNumber();
		$cvc = $this->getCvc();
		$month = $this->getExpirationMonth();
		$year = $this->getExpirationYear();
		$this -> seatNumber = $this -> getConfirmed();
		var_dump($fornamn);
		if (isset($_POST['submitInfo'])) {

			if ($fornamn == "") {
				$this -> firstnameValue = $fornamn;
				$this -> errormsg = "<p class='pvit'>Förnamn är tomt.</p>";
				return FALSE;
			} else if ($efternamn == "") {
				$this -> errormsg = "<p class='pvit'>Efternamn är tomt.</p>";
				$this -> firstnameValue = $fornamn;
				$this -> usrLastnameValue = $efternamn;
				return FALSE;
			}
			else if($kortNr == ""){
				$this -> errormsg = "<p class='pvit'>Kortnummer är tomt.</p>";
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				return FALSE;
			}
			else if($cvc == ""){
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> errormsg = "<p class='pvit'>Cvc nummer är tomt.</p>";
				return FALSE;
				
			}
			else if($month == ""){
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> errormsg = "<p class='pvit'>Månad måste fyllas i.</p>";
				return FALSE;
			}
			else if(!isset($_POST['paymentComp'])){
			  $this -> errormsg = "<p class='pvit'>Måste välja brand.</p>";
			}
			else if($year == ""){
				$this -> firstnameValue = $fornamn;
				$this -> lastnameValue = $efternamn;
				$this -> errormsg = "<p class='pvit'>År måste fyllas i.</p>";
				return FALSE;
			}
			
			
			return TRUE;
		}
	}
	

	public function getConfirmed() {
		if (isset($_GET['confirmed'])) {
			return $_GET['confirmed'];
		}
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
					Fyll i formuläret annars jävlar.</h3>
					
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
   	<label>Brand</label>
   	<br>
   	<div id='select' class='styledSelect'>
    	<select name='paymentComp'>
		  <option value=''>Select...</option>
		  <option name='visa' value='Visa'>Visa</option>
		  <option name='mastercard' value='Mastercard'>Mastercard</option>
		</select>
	</div>
		
    		
		<label>Card Number</label>
			<br>
    	<input type='text' name='cardNumber' class='inputStyle' size='20' autocomplete='off'>
 			<br>
		<span>Enter the number without spaces or hyphens.</span>	
			<br>		
		<label class='form'>CVC</label>
			<br>
		<input type='text' name='cvc' class='inputStyle' size='4' autocomplete='off'>
			<br>
		<label>Expiration (MM/YYYY)</label>
			<br>
		<input type='text' name='expirationMonth' class='inputStyle' size='2'>
			<span> / </span>
		<input type='text'  class='inputStyle' size='4'>	
			<br>
		<input type='submit' name='submitInfo'  value='Submit'/>
			
			
	    </form>
	    $this->errormsg
	    $this->msg
	   
	    </div>
					 </div>	
			    </div>
				
		  ";
		return $ret;
	}

}





