<?php
class Card{
    private $conn;
    private $table_name = "cards";
    public int $id;
    public string $number;
    public string $name;
    public int $sum;
    public string $expiry;
    public string $series;
    public string $status;
    public string $issue;
    public int $period;

    public function __construct($db){
        $this->conn = $db;
    }
    public function list(){
        $query = "SELECT * FROM " . $this->table_name ." WHERE deleted=0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function item(){
        $query = "SELECT * FROM " . $this->table_name ." WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
       /* $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->series = $row['series'];
        $this->period = $row['period'];
        $this->issue = $row['issue'];
        $this->expiry = $row['expiry'];
        $this->status = $row['status'];
        $this->sum = $row['sum'];
        $this->number = $row['number'];*/
    }
    public function delete(){
        $query = "UPDATE " . $this->table_name . " SET deleted = 1, status='not active' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function activate(){
        $query = "UPDATE ".$this->table_name ." SET status = 'active' WHERE deleted = 0 and id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function deactivate(){
        $query = "UPDATE " . $this->table_name . " SET status = 'not active' WHERE deleted=0 and id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function expire(){
        $query = "UPDATE " . $this->table_name . " SET status = 'expired' WHERE deleted=0 and id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function create(){
        if($this->validateSeries($this->series) & $this->validatePeriod($this->period)) {
            $query = "SELECT count(*) as total FROM " . $this->table_name . " where series = ? AND period=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->series);
            $stmt->bindParam(2, $this->period);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->total = $row['total'];
            $result = (string)$this->total;
            while (strlen($result) < 8) {
                $result = "0" . $result;
            }
            $periodstr = (string)$this->period;
            while (strlen($periodstr) < 2) {
                $periodstr = "0" . $periodstr;
            }
            $this->number = $result;
            $this->name = "PC" . $this->number . $this->series . $periodstr;

            $query = "INSERT INTO " . $this->table_name . " SET name=:name, series=:series, number=:number, period=:period, sum=:sum, issue=:issue, expiry=:expiry";
            $stmt = $this->conn->prepare($query);

            $this->issue=date('Y-m-d');
            $this->expiry=date('Y-m-d', strtotime("+$this->period months", strtotime(date('Y-m-d'))));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':period', $this->period);
            $stmt->bindParam(':series', $this->series);
            $stmt->bindParam(':number', $this->number);
            $stmt->bindParam(':sum', $this->sum);
            $stmt->bindParam(':issue',  $this->issue);
            $stmt->bindParam(':expiry', $this->expiry);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        else
        {
            echo "Not valid period or series value.";
        }
    }
    private function validateSeries($series){
        $validvalues = array("CC","LC","BC");
        if (in_array($series, $validvalues)) {
            return true;
        }
        else return false;
    }
    private function validatePeriod($period){
        $validvalues = array(1,6,12);
        if (in_array($period, $validvalues)) {
            return true;
        }
        else return false;
    }
}
?>
