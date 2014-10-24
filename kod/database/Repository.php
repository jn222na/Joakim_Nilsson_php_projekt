<?php

require_once 'databaseConnectionSettings.php';

	class Repository{
	 private  $rowFirstname = "firstname";
 	 private  $rowLastname =  "lastname";
	 private  $rowSeat =  "seat";
	 private  $dbTable = "payedCustomer";
	 public function connection() {
		if ($this -> dbConnection == NULL) {
			$this -> dbConnection = new \PDO(\settings::$DB_CONNECTION, \settings::$DB_USERNAME, \settings::$DB_PASSWORD);
			$this -> dbConnection -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
	 
	public function addPayment($firstname,$lastname,$seat) {
// 		$firstname = $_POST['firstname'];
// 		$lastname = $_POST['lastname'];
// 		$seat = $_GET['confirmed'];
		try{
    		$this -> connection();
    		$sql = "INSERT INTO ".$this->dbTable."(" . $this->rowFirstname . ", " . $this->rowLastname . ", " . $this->rowSeat . ")
    		VALUES (?, ?, ?)";
    		
	    //Kollar om platsen är upptagen
        	$sqlDuplicate = "SELECT * FROM ".$this->dbTable." WHERE " . $this->rowSeat . " = ?";

			$paramsDuplicate = array($seat);

			$queryDuplicate = $this->dbConnection->prepare($sqlDuplicate);

			$queryDuplicate->execute($paramsDuplicate);

			$result = $queryDuplicate->fetch();

			if ($result[$this->rowSeat] === $seat) {
				return false;
			}
			else{
    			$params = array($firstname, $lastname, $seat);
    			$query = $this -> dbConnection -> prepare($sql);
    			$query -> execute($params);
    			return true;
			}

		} catch (\Exception $e) {
			die("An error occured in the database! addPayment".$e);
	    }
	}
	
		public function fetchCredentials($seatNr){
		    
		    $this->connection();
		   	$sqlDuplicate = "SELECT * FROM ".$this->dbTable." WHERE " . $this->rowSeat . " = ?";
            
			$paramsDuplicate = array($seatNr);
            
			$queryDuplicate = $this->dbConnection->prepare($sqlDuplicate);

			$queryDuplicate->execute($paramsDuplicate);
			$result = $queryDuplicate->fetchAll();
            
          foreach($result as $key) {
            	if ($key[$this->rowSeat] === $seatNr) {
				return false;
			} else{
			    return true;
			}
            }
		
            }
	
}
