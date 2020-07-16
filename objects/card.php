<?php
class Card{
  
    // database connection and table name
    private $conn;
    private $table_name = "cards";
  
    // object properties
    public $id;
    public $cardnumber;
    public $carseries;
    public $cardperiod;
    public $cardname;
    public $cardname;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
	function read(){
  
        $query = "SELECT * FROM " . $this->table_name;
    	$stmt = $this->conn->prepare($query);
  	
    	// execute query
    	$stmt->execute();
  	
    	return $stmt;
	}


}
?>
