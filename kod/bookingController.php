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
	    
		
		$msg = "";
			
		    $this->bookinghtml->echoBookedSeat();
		if ($this -> bookinghtml -> getSeat()) {
                $this -> bookinghtml -> clickedSeat($this -> bookinghtml -> getSeat());
					if($this->bookinghtml->confirmSeat($this -> bookinghtml -> getSeat())){
				}			
		}
		if($this->bookinghtml->getConfirm()){
			return $this->confView->returnForm();
		}	
		return $this -> bookinghtml -> bookingEcho($msg);
	}

}

