<?php

class bookingModel {
	public function __construct() {

	}

	public function seatStatus($fornamn, $efternamn) {
		echo "seatstatys";
		if ($this -> $fornamn != "" && $this -> $efternamn != "") {
			echo "giltigt fornamnn";
			return TRUE;
		} else {
			return FALSE;
		}

	}

}
