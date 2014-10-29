<?php

require_once 'databaseConnectionSettings.php';

	class Repository{
	 private  $rowFirstname = "firstname";
 	 private  $rowLastname =  "lastname";
	 private  $rowSeat =  "seat";
	 private  $rowUnique ="unik";
	 private  $dbTable = "payedCustomer";
	 private  $dbConnection;
	 public function connection() {
		if ($this -> dbConnection == NULL) {
			$this -> dbConnection = new \PDO(\settings::$DB_CONNECTION, \settings::$DB_USERNAME, \settings::$DB_PASSWORD);
			$this -> dbConnection -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
	 
	public function addPayment($firstname,$lastname,$seat,$unique) {
        //Lägger in för/efternamn i databasen samt sätesplatsen som personen valt.
		try{
    		$this -> connection();
    		$sql = "INSERT INTO ".$this->dbTable."(" . $this->rowFirstname . ", " . $this->rowLastname . ", " . $this->rowSeat . ", " . $this->rowUnique . ") VALUES (?,?,?,?)";
	    //Dubbel kollar om platsen redan är upptagen.
        	$sqlDuplicate = "SELECT * FROM ".$this->dbTable." WHERE " . $this->rowSeat . " = ?";

			$paramsDuplicate = array($seat);

			$queryDuplicate = $this->dbConnection->prepare($sqlDuplicate);

			$queryDuplicate->execute($paramsDuplicate);

			$result = $queryDuplicate->fetch();

			if ($result[$this->rowSeat] === $seat) {
				return false;
			}
			else{
    			$params = array($firstname, $lastname, $seat,$unique);
    			$query = $this -> dbConnection -> prepare($sql);
    			$query -> execute($params);
    			return true;
			}

		} catch (\Exception $e) {
			die("An error occured in the database! addPayment".$e);
	    }
	}
	
		public function fetchCredentials($seatNr){
		    //Kollar om någon plats matchar med någon i databasen.
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
            public function removeBooking($deleteSeat){
		    //Kollar om någon plats matchar med någon i databasen.
		    $this->connection();
		   	$sqlDuplicate = "DELETE FROM ".$this->dbTable." WHERE  " . $this->rowSeat . " = ?";
                		   	
            var_dump($deleteSeat);
			$paramsDuplicate = array($deleteSeat);
            
			$queryDuplicate = $this->dbConnection->prepare($sqlDuplicate);

			$queryDuplicate->execute($paramsDuplicate);
// 		
		
            }
	
}
