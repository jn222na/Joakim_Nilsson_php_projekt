<?php
require_once 'database/Repository.php';
require_once 'confirmed/confirmedView.php';
error_reporting(E_ALL);
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
	private $valueName;
	private $bookedSeatMessage = "Välj en plats att boka";
	



	
	public function __construct() {
		$this -> rep = new Repository();
		$this->confirmHtml = new confirmedPageView();
	}
//Skapar bokningsplatser 
	public function createSeats() {
		$array = '';
		
		for ($i = 1; $i <= $this -> row; $i++) {
    		  if($this->rep->checkSeatBooked($i)){
    		         $valueName = $this->rep->fetchName($i);
                    $array .= ("<a href='/Lanster/booking.php?seat=$i'  id='btn' name='submit_[$i]' class='btnDisabled' value='seat$i'>seat$i:$valueName</a>");
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
	public function showBookedSeats(){
	    $array = '';
		
		for ($i = 1; $i <= $this -> row; $i++) {
    		  if($this->rep->checkSeatBooked($i)){
    		         $valueName = $this->rep->fetchName($i);
                    $array .= ("<a href='/Lanster/booking.php?rebooked=$i'  id='btn' name='submit_[$i]' class='btnEnabled' value='seat$i'>seat$i:$valueName</a>");
                }
                else{
                    $array .= ("<a href='/Lanster/booking.php?rebooked=$i'  id='btn' name='submit_[$i]' class='btnDisabled' value='Seat$i'>Seat$i</a>");
                   
                }
			if ($i % 5 == 0) {
				$array .= "<br><br><br> ";
			}
            
			
		}
		return $array;
	}


    public function sendMail(){
        
    if(isset($_COOKIE['storedEmail'])){ 
       
        
       
        $förnamn = $_COOKIE['storedFirstname'];
        $efternamn = $_COOKIE['storedLastname'];
        $to = $_COOKIE['storedEmail'];
        $deleteHash = $_COOKIE['storedSeatNumber'];
        $addSeatToUrl = $_COOKIE['storedSeatNumber'];
        $link = "http://jockepocke.se/Lanster/booking.php?rebooked=";
        $link .=$addSeatToUrl;
        $deleteHash = md5($deleteHash);
        setcookie('storeHash',$deleteHash, time() + 60 * 60 * 24 * 30);
        $subject = 'Bokning';
        $message = 'Hej '.$förnamn.' '.$efternamn.'  du har bokat plats '.$addSeatToUrl ."<br>".
         'Vill du avboka platsen? Kopiera följande.<br>
          '.$deleteHash.$addSeatToUrl.'<br>
          Navigera sedan hit<br>
          <a href='.$link.'?'.$to.' target=_blank>Avboka</a><br>
          Mata sedan in förnamn, efternamn samt länken du kopierade. ' . "<br>";
        $headers = 'From: lanster@jockepocke.se' . "\r\n";
    	$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $message, $headers);
    }
    }
    public function checkDelete(){
        if(isset($_COOKIE['rebookedSeat'])){
        $seatNr = $_COOKIE['rebookedSeat'];
        $to = $_COOKIE['rebookedMail'];
     
         $link = "http://jockepocke.se/Lanster/booking.php";    
        $subject = 'Avbokning';
        $message = 'Du har avbokat plats '.$seatNr." och dina pengar är tillbaka satta på ditt konto.<br>".
         'Vill du boka ny plats?<br>
          <a href='.$link.' target=_blank>Boka</a><br>';
        $headers = 'From: lanster@jockepocke.se' . "\r\n";
    	$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $message, $headers);
            
        
        //     //Kollar om urlen har fått 0-9 eller 10 + 
        //     if(strlen($_GET['delete']) == 34){
        //         $w = substr($_GET['delete'], -2);
                
        //     }
        //     else if(strlen($_GET['delete']) == 33){
        //         $w = substr($_GET['delete'], -1);
        //     }
        
           $this->bookedSeatMessage = "<h3 class='pvit'>Du har avbokat plats nummer $seatNr<br>Ett bekräftelse mail har skickats till dig</h3>";
            
            
        // for ($x=1; $x<=15; $x++) {
        //       if(md5($x)."$w" == $_GET['delete']){
        //         $this->rep->removeBooking($w);
        //     }
          } 
            
        // }
    }
  
	public function getRebookedSeat(){
	if(isset($_GET['rebooked'])){
		return $_GET['rebooked'];
	}
}
    public function checkRebooking(){
        if(isset($_GET['rebooking'])){
            return true;
        }else{
            return false;
        }
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
	   
			$this -> msg = "<p class='pvit'>Vill du ha plats nr:$i?</p>";
			$this -> nejKnapp = "<a href='/Lanster/booking.php' name='nejKnapp' class ='confStyle' value='Nej'>Nej</a>";
	}

	public function confirmSeat($i) {
			$this -> jaKnapp = "<a href='/Lanster/booking.php?confirmed=".$i."' name='jaKnapp' class ='confStyle' value='Ja'>Ja</a>";
			 return true;
	}
	
	public function setCookies(){
	  setcookie('storedEmail',"Email", time() + 60 * 60 * 24 * 30);
	  setcookie('storedFirstname',"Firstname", time() + 60 * 60 * 24 * 30);
      setcookie('storedLastname',"Lastname", time() + 60 * 60 * 24 * 30);
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
 public function removeCookies(){
        if(isset($_COOKIE['storedEmail'])){
	         setcookie('storedEmail', "", time() - 3600); 
	         setcookie('storedFirstname',"", time() -3600);
            setcookie('storedLastname',"", time() -3600);
            setcookie('storeHash',"", time() -3600);

        }
        
 }
   public function removeRebookedSeatCookies(){
        setcookie('rebookedSeat', "", time() - 3600); 
        setcookie('rebookedMail',"", time() - 3600);
    }
        
	
	

	public function bookingEcho() {
		$ret = "";
		
		if($this->checkRebooking()){
		    $array = $this -> showBookedSeats();
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
						<h3 class='pvit'>Välj en plats att avboka.</h3>
						<form id='login'   method='post'>
							$array
							$this->msg
							$this->jaKnapp
							$this->nejKnapp
							$this->form
						</form> 
						<h4 class='pvit'><a href='?booking' class='confStyle'>Tillbaka</a><h4>
					 </div>	
			    </div>";
				return $ret;
		}
		else{
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
                    <h4 class='pvit'>Eller avboka här<a href='?rebooking' class='confStyle'>Avboka</a><h4>
					 </div>	
			    </div>
				
			";
	
		return $ret;
}
	}
	

}
