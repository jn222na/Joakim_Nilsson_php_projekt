<?php


require_once 'confirmed/confirmedView.php';
require_once 'database/Repository.php';


	class confirmedController{
		
		private $confirmhtml;
		private $dbActions;
		public function __construct(){
			$this -> confirmhtml = new confirmedPageView();
			$this-> dbActions = new Repository();
		}
    //Returnerar betalningsformuläret.
		public function returnForm(){
        
        $fornamn = $this -> confirmhtml -> getFirstname();
		$efternamn = $this -> confirmhtml -> getLastname();
		$seatNr = $this -> confirmhtml -> getConfirmed();
		$unik = $this -> confirmhtml -> getUnique();
		
		if($this->confirmhtml->didUserSubmitData()){
	       $this->confirmhtml->storeCookies();
    //skickar med information till databaslagret
		  if($this->dbActions->addPayment($fornamn,$efternamn,$seatNr,$unik)){
		      $this->confirmhtml->relocateToBooking();
		 }
		 else{
		     $this->confirmhtml->checkExistingMember();
		 }
		 
		 
		}
				
			return $this -> confirmhtml -> echoConfirmedPage();
		}
		
	}
