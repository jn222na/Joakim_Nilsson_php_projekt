<?php

class bookingModel {
	public function __construct() {

	}

	public function seatStatus($förnamn, $efternamn) {
		echo "seatstatys";
		if ($this -> $förnamn != "" && $this -> $efternamn != "") {
			echo "giltigt förnamnn";
			return TRUE;
		} else {
			return FALSE;
		}

	}

}
