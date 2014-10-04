<?php
require_once 'bookingModel.php';
require_once 'bookingHtml.php';
class bookingController {

	private $model;
	private $bookinghtml;
	public function __construct() {
		$this -> model = new bookingModel();
		$this -> bookinghtml = new bookingHtml();
	}

	public function checkSeat() {
		$förnamn = $this -> bookinghtml -> getFörnamn();
		$efternamn = $this -> bookinghtml -> getEfternamn();
		$msg = "";
		$förnamn = $this -> bookinghtml -> getFörnamn();
		$efternamn = $this -> bookinghtml -> getEfternamn();
		if ($this -> bookinghtml -> createSeats()) {
			if ($this -> bookinghtml -> confirmSeat()) {
				if ($this -> bookinghtml -> didUserSubmitData()) {
					if ($this -> model -> seatStatus($förnamn, $efternamn)) {
					}
				} else {
					$msg = "Felaktiga uppgifter";
				}

			}
		}
		return $this -> bookinghtml -> bookingEcho($msg);
	}

}
