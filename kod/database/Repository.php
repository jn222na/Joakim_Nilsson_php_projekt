<?php

require_once 'databaseConnectionSettings.php';

	class Repository{
	 private  $rowFirstname = "firstname";
 	 private  $rowLastname =  "lastname";
	 private  $rowSeat =  "seat";
	 private  $rowUnique ="unik";
	 private  $rowMail = "mail";
	 private  $dbTable = "payedCustomer";
	 private  $dbConnection;
	 public function connection() {
		if ($this -> dbConnection == NULL) {
			$this -> dbConnection = new \PDO(\settings::$DB_CONNECTION, \settings::$DB_USERNAME, \settings::$DB_PASSWORD);
			$this -> dbConnection -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
	 
	public function addPayment($firstname,$lastname,$seat,$unique,$mail) {
        //Lägger in för/efternamn i databasen samt sätesplatsen som personen valt.
		try{
    		$this -> connection();
    		$sql = "INSERT INTO ".$this->dbTable."(" . $this->rowFirstname . ", " . $this->rowLastname . ", " . $this->rowSeat . ", " . $this->rowUnique . ", " . $this->rowMail . ") VALUES (?,?,?,?,?)";
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
    			$params = array($firstname, $lastname, $seat,$unique,$mail);
    			$query = $this -> dbConnection -> prepare($sql);
    			$query -> execute($params);
    			return true;
			}

		} catch (\Exception $e) {
			die("An error occured in the database! addPayment".$e);
	    }
	}
	
		public function checkSeatBooked($seatNr){
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
                		   	
			$paramsDuplicate = array($deleteSeat);
            
			$queryDuplicate = $this->dbConnection->prepare($sqlDuplicate);

			$queryDuplicate->execute($paramsDuplicate);
            }
            
              
            public function fetchName($seatNr){
                $this->connection();
		   	$sqlDuplicate = "SELECT  firstname, lastname FROM ".$this->dbTable."  WHERE " . $this->rowSeat . " = ?";
            
			$paramsDuplicate = array($seatNr);
            
			$queryDuplicate = $this->dbConnection->prepare($sqlDuplicate);

			$queryDuplicate->execute($paramsDuplicate);
			$result = $queryDuplicate->fetchAll();
            
          foreach($result[0] as $key) {
            	return $key;
        }
        return true;
    }
    public function fetchMail($seatNr){
                $this->connection();
		   	$sqlDuplicate = "SELECT  mail FROM ".$this->dbTable."  WHERE " . $this->rowSeat . " = ?";
            
			$paramsDuplicate = array($seatNr);
            
			$queryDuplicate = $this->dbConnection->prepare($sqlDuplicate);

			$queryDuplicate->execute($paramsDuplicate);
			$result = $queryDuplicate->fetchAll();
            
          foreach($result[0] as $key) {
            	return $key;
        }
        return true;
    }
            
            public function checkInformation($firstname,$lastname,$unique){
            try{
                $this->connection();

        $query = $this -> dbConnection -> prepare
        ("SELECT "
                . $this->rowFirstname . ", "
                . $this->rowLastname . ","
                . $this->rowUnique ."
                FROM ".$this->dbTable."
                WHERE " . $this->rowFirstname . "=:" . $this->rowFirstname . "
                AND "   . $this->rowLastname  . "=:" . $this->rowLastname . "
                AND "   . $this->rowUnique    . "=:" . $this->rowUnique . "");
                
        
		$query->bindParam(':' . $this->rowFirstname . '', $firstname, PDO::PARAM_STR);
        $query->bindParam(':' . $this->rowLastname  . '', $lastname, PDO::PARAM_STR);
        $query->bindParam(':' . $this->rowUnique    . '', $unique, PDO::PARAM_STR);
		
		$query->execute();
		 $user_id = $query->fetchColumn();
		  if($user_id == false)
        {
				return false;
        }else{
        return true;
        }
            }catch(\Exception $e){
		   die("An error occured in the database! checkInformation: $e");
		}
            }
            
}











