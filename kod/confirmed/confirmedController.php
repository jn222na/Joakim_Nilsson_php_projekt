<?php


require_once 'confirmedView.php';


	class confirmedController{
		
		private $confirmhtml;
		
		public function __construct(){
			$this->confirmhtml = new confirmedPageView();
		}
		
		public function hej(){
			
			if ($this -> confirmhtml -> didUserSubmitData()) {
				 // if($this->dbActions->addUser()){
						// }
				}
			return $this->confirmhtml->echoConfirmedPage();
		}
		
	}
