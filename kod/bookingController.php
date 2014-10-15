<?php
require_once 'bookingModel.php';
require_once  'bookingHtml.php';
require_once 'confirmed/confirmedController.php';


class bookingController {

	private $model;
	private $bookinghtml;
	private $confView;
	private $i;
	public function __construct() {
		$this -> model = new bookingModel();
		$this -> bookinghtml = new bookingHtml();
		$this -> confView = new confirmedController();
	}

	public function checkSeat() {
		$fornamn = $this -> bookinghtml -> getfornamn();
		$efternamn = $this -> bookinghtml -> getEfternamn();
		$msg = "";


		if ($this -> bookinghtml -> getSeat()) {
			$this -> bookinghtml -> clickedSeat($this -> bookinghtml -> getSeat());
					if($this->bookinghtml->confirmSeat($this -> bookinghtml -> getSeat())){
							//??		
				}			
		}
		if($this->bookinghtml->getConfirm()){
			return $this->confView->returnForm();
		}	
		return $this -> bookinghtml -> bookingEcho($msg);
	}

}

