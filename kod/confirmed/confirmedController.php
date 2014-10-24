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

		public function returnForm(){
 
        $fornamn = $this -> confirmhtml -> getFirstname();
		$efternamn = $this -> confirmhtml -> getLastname();
		$seatNr = $this -> confirmhtml -> getConfirmed();
		
		if($this->confirmhtml->didUserSubmitData()){
		    $this->confirmhtml->setNewUsernameCookie();
		  if($this->dbActions->addPayment($fornamn,$efternamn,$seatNr)){
		      header("Location: booking.php");
		 }
		 else{
		     $this->confirmhtml->checkExistingMember();
		 }
		 
		 
		}
				
			return $this -> confirmhtml -> echoConfirmedPage($exists);
		}
		
	}
