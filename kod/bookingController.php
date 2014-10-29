<?php
require_once  'bookingHtml.php';
require_once 'confirmed/confirmedController.php';
require_once 'database/Repository.php';

class bookingController {
	private $bookinghtml;
	private $confView;
	private $repository;
	private $i;
	public function __construct() {
		$this -> bookinghtml = new bookingHtml();
		$this -> confView = new confirmedController();
		$this -> repository = new Repository();
	}

	public function checkSeat() {
	    //Kollar om användaren har valt att avboka.
		  $this->bookinghtml->checkDelete();
		//Kollar om användaren har bokat en plats har han det skriv ut att platsen blivit bokad.	
	    if($this->bookinghtml->echoBookedSeat()){
	        $this->bookinghtml->sendMail();
	    }
	    //Hämtar platsen som användaren klickat på
		if ($this -> bookinghtml -> getSeat()) {
		//Skickar in vald plats och presenterar alternativ för användaren
                $this -> bookinghtml -> clickedSeat($this -> bookinghtml -> getSeat());
					if($this->bookinghtml->confirmSeat($this -> bookinghtml -> getSeat())){
				}			
		}
		//Om användaren väljer ja byt kontroller och visa betalningsformulär
		if($this->bookinghtml->getConfirm()){
		    $this->bookinghtml->setEmailCookie();
			return $this->confView->returnForm();
		}	
		 $this->bookinghtml->removeEmailCookie();
		return $this -> bookinghtml -> bookingEcho();
	}

}

