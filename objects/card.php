<?php
class Card{

    // database connection and table name
    private $conn;
    private $table_name = "cards";

    // object properties
    public $id;
    public $col1;
    public $testname;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){

        // select all query
        $query = "SELECT * FROM " . $this->table_name ." WHERE deleted=0";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
// create product
    function create(){

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET testname=:testname, col1=:col1";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->testname=htmlspecialchars(strip_tags($this->testname));
        $this->col1=htmlspecialchars(strip_tags($this->col1));

        // bind values
        $stmt->bindParam(":testname", $this->testname);
        $stmt->bindParam(":col1", $this->col1);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }
    // used when filling up the update product form
    function readOne(){

        // query to read single record
        $query = "SELECT testname, col1 FROM " . $this->table_name .   " WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->testname = $row['testname'];
        $this->col1 = $row['col1'];

    }

    function update(){

        // update query
        $query = "UPDATE " . $this->table_name . " SET testname = :testname, col1 = :col1 WHERE id = :id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->testname=htmlspecialchars(strip_tags($this->testname));
        $this->col1=htmlspecialchars(strip_tags($this->col1));


        // bind new values
        $stmt->bindParam(':testname', $this->testname);
        $stmt->bindParam(':col1', $this->col1);
        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    // delete the product
    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function softdelete(){
        $query = "UPDATE " . $this->table_name . " SET deleted = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function activate(){
        $query = "UPDATE " . $this->table_name . " SET statusofcard = 'active' WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function deactivate(){
        $query = "UPDATE " . $this->table_name . " SET statusofcard = 'not active' WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);


        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

}
?>
