<?php
require_once 'bookingModel.php';
require_once 'bookingHtml.php';
		class bookingController{
			
			private $model;
			private $view;
			private $bookinghtml;
			public function __construct(){
				$this->model = new bookingModel();
				$this->bookinghtml = new bookingHtml();
			}
			
			
			
			public function checkSeat(){
					
				if($this->bookinghtml->clickedSeat()){
					echo "controllerreturn";
				}
				

			}
			
			
		}

		
		