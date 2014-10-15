<?php


require_once 'confirmed/confirmedView.php';



	class confirmedController{
		
		private $confirmhtml;
		
		public function __construct(){
			$this -> confirmhtml = new confirmedPageView();
		}
		
		public function returnForm(){


		if($this->confirmhtml->didUserSubmitData()){
		
		}
				 // if($this->dbActions->addUser()){
					// }
			return $this -> confirmhtml -> echoConfirmedPage();
		}
		
	}
