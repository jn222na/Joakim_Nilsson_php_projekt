<?php


require_once 'confirmed/confirmedView.php';
error_reporting(E_ALL);

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
		$mail = $this -> confirmhtml -> getEmail();
		
		if($this->confirmhtml->didUserSubmitData()){
	       $this->confirmhtml->storeCookies();
    //skickar med information till databaslagret
    
    
		  if($this->dbActions->addPayment($fornamn,$efternamn,$seatNr,$unik,$mail)){
		      $this->confirmhtml->relocateToBooking();
		 }
		 else{
		     $this->confirmhtml->checkExistingMember();
		 }
		 
		 
		}
				
			return $this -> confirmhtml -> echoConfirmedPage();
		}
		
	}
