<?php

require_once 'bookingBody.php';
require_once 'bookingController.php';
		  $bookingCntrl = new bookingController();
		     $bookingBodyEcho = $bookingCntrl->checkSeat();
			 
			 
	     	 $body = new bookingBody();
		 	 $body->echoBody($bookingBodyEcho);