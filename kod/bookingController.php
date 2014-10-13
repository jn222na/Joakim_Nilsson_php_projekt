<?php
require_once 'bookingModel.php';
require_once 'bookingHtml.php';
require_once 'confirmed/confirmedController.php';
class bookingController {

	private $model;
	private $bookinghtml;
	private $confView;
	private $i;
	public function __construct() {
		$this -> model = new bookingModel();
		$this -> bookinghtml = new bookingHtml();
		$this->confView = new confirmedController();
	}

	public function checkSeat() {
		$fornamn = $this -> bookinghtml -> getfornamn();
		$efternamn = $this -> bookinghtml -> getEfternamn();
		$msg = "";
	
		// $this -> bookinghtml -> createSeats();
		// if($this->bookinghtml->createSeats()){
			// echo "success";
		// }
	
		
		// $i = $this->bookinghtml->getSeatClicked();
		if($this->bookinghtml->getSeatClicked($i)){
			echo "isettrue";
			if($this->bookinghtml->clickedSeat()){
				
				if($this->bookinghtml->confirmSeat()){
					
				}
				
			}
		}
		return $this -> bookinghtml -> bookingEcho($msg);
	}

}
