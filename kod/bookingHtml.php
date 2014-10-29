<?php
require_once 'database/Repository.php';
require_once 'confirmed/confirmedView.php';

class bookingHtml {

	private $row = 15;
	private $array;
	private $rep;
	private $i;
	private $confirmHtml;
	private $jaKnapp;
	private $nejKnapp;
	private $msg;
	private $deleteMsg;
	private $successfullBooking;
	private $fornamn;
	private $efternamn;
	private $usrValue;
	private $form;
	private $bookedSeatMessage = "Välj en plats att boka";
	



	
	public function __construct() {
		$this -> rep = new Repository();
		$this->confirmHtml = new confirmedPageView();
	}
//Skapar bokningsplatser 
	private function createSeats() {
		$array = '';
		for ($i = 1; $i <= $this -> row; $i++) {
    		  if($this->rep->fetchCredentials($i)){
                    $array .= ("<a href='/Lanster/booking.php?seat=$i'  id='btn' name='submit_[$i]' class='btnDisabled' value='Seat$i'>Seat$i</a>");
                }
                else{
                    $array .= ("<a href='/Lanster/booking.php?seat=$i'  id='btn' name='submit_[$i]' class='btnEnabled' value='Seat$i'>Seat$i</a>");
                   
                }
			if ($i % 5 == 0) {
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
    public function sendMail(){
        if(isset($_COOKIE['storedEmail'])){
            
        $to = $_COOKIE['storedEmail'];
        $deleteHash = $_COOKIE['storedSeatNumber'];
        $addSeatToUrl = $_COOKIE['storedSeatNumber'];
        $deleteHash = md5($deleteHash);
        setcookie('storeHash',$deleteHash, time() + 60 * 60 * 24 * 30);
        $subject = 'Bokning';
        $message = 'Hej du har bokat plats '.$addSeatToUrl ."<br>".
         'Vill du avboka platsen klicka på följande länk' . "<br>".
         'http://www.jockepocke.se/Lanster/booking.php?delete='.$deleteHash.$addSeatToUrl.'';
        $headers = 'From: lanster@jockepocke.se' . "\r\n";
    	$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $message, $headers);
    }
    }
    public function checkDelete(){
        if(isset($_GET['delete'])){
           
            //Kollar om urlen är större än
            if(strlen($_GET['delete']) == 34){
                $w = substr($_GET['delete'], -2);
                
            }
            else if(strlen($_GET['delete']) == 33){
                $w = substr($_GET['delete'], -1);
            }
           $this->bookedSeatMessage = "<h3 class='pvit'>Du har avbokat plats nummer $w</h3>";

        for ($x=1; $x<=15; $x++) {
              if(md5($x)."$w" == $_GET['delete']){
                $this->rep->removeBooking($w);
            }
            } 
            
        }
    }
	public function clickedSeat($i) {
			$this -> msg = "<p class='pvit'>Vill du ha plats nr:$i?</p>";
			$this -> nejKnapp = "<a href='/Lanster/booking.php' name='nejKnapp' class ='confStyle' value='Nej'>Nej</a>";
	}

	public function confirmSeat($i) {
			$this -> jaKnapp = "<a href='/Lanster/booking.php?confirmed=".$i."' name='jaKnapp' class ='confStyle' value='Ja'>Ja</a>";
			 return true;
	}
	
	public function setEmailCookie(){
	  setcookie('storedEmail',"yolo", time() + 60 * 60 * 24 * 30);
	}


      public function echoBookedSeat(){
        if(isset($_COOKIE['storedSeatNumber'])){
            $seatNrCookie = $_COOKIE['storedSeatNumber'];
            $this->bookedSeatMessage = "<h3 class='pvit'>Du har bokat plats nummer $seatNrCookie<br>
            Ett mail har blivit skickat till dig med bekräftelse</h3>" ;
            setcookie('storedSeatNumber', "", time() - 3600);
            return true;
          }
	}
 public function removeEmailCookie(){
        if(isset($_COOKIE['storedEmail'])){
	         setcookie('storedEmail', "", time() - 3600);
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

	public function bookingEcho() {
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
						<h3 class='pvit'>$this->bookedSeatMessage</h3>
						<form id='login'   method='post'>
							$array
							$this->msg
							$this->jaKnapp
							$this->nejKnapp
							$this->form
						</form> 
						
					 </div>	
			    </div>
				
			";
	
		return $ret;

	}

}
