<?php

require_once 'bookingHtml.php';
require_once 'bookingController.php';
		  $bookingCntrl = new bookingController();
		  $bookingCntrl->checkSeat();
	      $body = new bookingHtml();
		  $body->bookingEcho();