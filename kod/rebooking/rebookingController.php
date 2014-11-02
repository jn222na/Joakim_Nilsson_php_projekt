<?php
require_once 'rebookingView.php';
require_once 'database/Repository.php';

        class rebookingController{
            private $rebookingView;
            private $rep;
            public function __construct(){
			$this -> rebookingView = new rebookingView();
			$this -> rep = new Repository();

		}
        	public function returnRebookForm(){
         $fornamn = $this -> rebookingView -> getFirstname();
		$efternamn = $this -> rebookingView -> getLastname();
		$seatNr = $this -> rebookingView -> getRebookedSeat();
		$unik = $this -> rebookingView -> getUnique();
      //TODO
      $this->rebookingView->fetchMailFromDatabase($seatNr);
		  if($this->rebookingView->checkInput()){
            
		      if($this->rep->checkInformation($fornamn,$efternamn,$unik)){
		          $this->rep->removeBooking($seatNr);
		              $this->rebookingView->relocateToStart($seatNr);
		      }
		  }
				
			return $this -> rebookingView -> echoRebook();
		}
        }