<?php

class AprilInstituteScheduler_API
{
    var $host = null;
    var $user = null;
    var $pass = null;
    var $name = null;
    var $conn = null;
    var $result = null;

    function __construct() {  //$dbhost, $dbuser, $dbpass, $dbname
        //$this -> host = "147.182.163.120";
        //$this -> user = "sysadmin";
        //$this -> pass = "Blazeit420";
        //$this -> name = "AprilInstituteProd";

        $this -> host = "147.182.163.120";
        $this -> user = "sysadmin";
        $this -> pass = "Blazeit420";
        $this -> name = "test";
    }

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if (mysqli_connect_errno()) {

        } else {

        }

        $this->conn->set_charset("utf8");

    }

    public function disconnect()
    {
        if ($this->conn != null) {
            $this->conn->close();
        }
    }

    public function registerUser($first_name, $last_name, $email, $phone_number, $password)
    {

        $sql = "INSERT INTO users (first_name, last_name, email, phone_number, password)
                VALUES(?, ?, ?, ?, ?)";
        $statement = $this->conn->prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("sssis", $first_name, $last_name, $email, $phone_number, $password);
        $statement->execute();
        $ret = mysqli_insert_id($this->conn);
        if ($ret == 0) {
            return null;
        } else {
            return $ret;
        }
    }

    public function verifyLogIn($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";

        $statement = $this->conn->prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])) {
            return $row;
        }
        else {
            return false;
        }
    }

    public function getEventType($event_id){
        $sql = "SELECT type 
                FROM types
                WHERE events.id = ?
                AND types.id = events.type_id";

        $statement = $this->conn->prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("i", $event_id);
        $statement->execute();
        $result = $statement -> get_result();
        while($row = $result -> fetch_assoc()) {
            $ret = $row;
        }
        return $ret;
    }

    public function getScheduledWith($event_id){
        $sql = "SELECT uid
                FROM users, events
                WHERE uid = user_id
                AND event_id = ?";

        $statement = $this->conn->prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("i", $event_id);
        $statement->execute();
        $result = $statement -> get_result();
        while($row = $result -> fetch_assoc()) {
            $ret[] = $row;
        }
        return $ret;
    }
}