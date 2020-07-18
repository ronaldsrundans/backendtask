<?php
class Card{
    private $conn;
    private $table_name = "cards";
    public $id;
    public $number;
    public $name;
    public $sum;
    public $expiry;
    public $series;
    public $status;
    public $issue;
    public $period;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * FROM " . $this->table_name ." WHERE deleted=0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, col1=:col1";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->col1=htmlspecialchars(strip_tags($this->col1));

        // bind values
        $stmt->bindParam(":name", $this->name);
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
        $query = "SELECT * FROM " . $this->table_name .   " WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->series = $row['series'];
        $this->period = $row['period'];
        $this->issue = $row['issue'];
        $this->expiry = $row['expiry'];
        $this->status = $row['status'];
        $this->sum = $row['sum'];
        $this->number = $row['number'];
    }

    function update(){

        // update query
        $query = "UPDATE " . $this->table_name . " SET name = :name, col1 = :col1 WHERE id = :id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->col1=htmlspecialchars(strip_tags($this->col1));


        // bind new values
        $stmt->bindParam(':name', $this->name);
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

    function myFunction(){
        //echo $this->id;
        //echo $this->series;
        //echo $this->validateSeries($this->series) & $this->validatePeriod($this->period);
        if($this->validateSeries($this->series) & $this->validatePeriod($this->period)) {
            $query = "SELECT count(*) as total FROM " . $this->table_name . " where series = ? AND period=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->series);
            $stmt->bindParam(2, $this->period);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->total = $row['total'];
            $res = (string)$this->total;
            //echo strlen($res);
            while (strlen($res) < 8) {
                $res = "0" . $res;
            }
            $periodstr = (string)$this->period;
            while (strlen($periodstr) < 2) {
                $periodstr = "0" . $periodstr;
            }
            $this->number = $res;
            $this->name = "PC" . $this->number . $this->series . $periodstr;
        }
        //echo $res2;

       // $result=mysql_query($sql);
        //$data=mysql_fetch_assoc($result);
        //echo $data['total'];
        //$stmt = $this->conn->prepare($query);

        /*if($stmt->execute()){
              return true;
          }

          return false;*/

    }
    function validateSeries($series){
        $validvalues = array("CC","LC","BC");
        if (in_array($series, $validvalues)) {
            return true;
        }
        else return false;
    }
    function validatePeriod($period){
        $validvalues = array(1,6,12);
        if (in_array($period, $validvalues)) {
            return true;
        }
        else return false;
    }

}
?>
