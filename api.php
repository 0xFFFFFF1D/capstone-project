<?php

/**
 * An API for the backend for the AprilScheduler MySQL Server.
 * 
 * This class contains every function required for for generating queries
 * to interface with the MySQL Server. 
 */
class AprilInstituteScheduler_API
{
    var $host = null;
    var $user = null;
    var $pass = null;
    var $name = null;
    var $conn = null;
    var $result = null;

    /**
     * Constructor for the API object
     */
    function __construct() {  //$dbhost, $dbuser, $dbpass, $dbname
        //$this -> host = ***REMOVED***
        //$this -> user = ***REMOVED***
        //$this -> pass = ***REMOVED***
        //$this -> name = ***REMOVED***

        $this -> host = ***REMOVED***
        $this -> user = ***REMOVED***
        $this -> pass = ***REMOVED***
        $this -> name = ***REMOVED***
    }

    /**
     * Connects to the SQL database using mysqli()
     */
    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if (mysqli_connect_errno()) {

        } else {

        }

        $this->conn->set_charset("utf8");

    }

    /**
     * Disconnects from the database.
     */
    public function disconnect()
    {
        if ($this->conn != null) {
            $this->conn->close();
        }
    }

    /**
     * Registers a user given that user's information.
     * 
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param int $phone_number
     * @param string $password
     * @return int $ret
     * @throws Exception
     */
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


    /**
     * Verifies user login.
     * 
     * @param string $email
     * @param string $password
     * @return array $row
     * @throws Exception
     */
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

    /**
     * Gets the name of an event type given the type id.
     * 
     * @param int $type_id
     * @return array $ret
     * @throws Exception
     */
    public function getTypeFromTypeID($type_id){
        $sql = "SELECT type 
                FROM types
                WHERE types.id = ?";

        $statement = $this->conn->prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("i", $type_id);
        $statement->execute();
        $result = $statement -> get_result();
        while($row = $result -> fetch_assoc()) {
            $ret = $row;
        }
        return $ret;
    }

    /**
     * Gets the admin associated with a given event
     * 
     * @param int $event_id
     * @return array
     * @throws Exception
     */
    public function getScheduledWith($event_id){
        $sql = "SELECT users.*
                FROM admins, xref_users_events, users
                WHERE admins.uid = user_id
                AND admins.uid = users.uid
                AND event_id = ?";

        $statement = $this->conn->prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("i", $event_id);
        $statement->execute();
        $result = $statement -> get_result();

        return $result -> fetch_assoc();
    }

    /**
     * Given all fields, adds an appointment for a user and subtracts one
     * credit.
     * 
     * @param int $type
     * @param int $is_virtual
     * @param string $date
     * @param string $description
     * @param string $address
     * @param int $uid
     * @return int $ret     Value of the AUTO_INCREMENT field updated
     * @throws Exception
     */
    public function addAppointment($type, $scheduled_with, $is_virtual, $date, $description, $address, $uid) {
        if($is_virtual == 1) {
            $address = "https://us02web.zoom.us/j/3847814790";
        }

        $sql = "INSERT INTO events (type_id, is_virtual, date, address, description)
                VALUES(?, ?, ?, ?, ?)";

        $sql2 = "UPDATE users
                SET credits = credits - 1
                WHERE uid = ?";

        $statement = $this -> conn -> prepare($sql);
        $statement2 = $this -> conn -> prepare($sql2);

        if (!$statement) {
            throw new Exception($statement->error);
        }
        if (!$statement2) {
            throw new Exception($statement2->error);
        }

        $statement -> bind_param("iisss", $type, $is_virtual, $date, $address, $description);
        $statement2 -> bind_param("i", $uid);
        $statement -> execute();
        $ret = mysqli_insert_id($this->conn);

        $statement2 -> execute();
        $result = $statement -> get_result();

        $this -> addXref($uid, $ret);
        $this -> addXref($scheduled_with, $ret);
        echo "xref added" . $ret;

        return $ret;
    }

    /**
     * Given all fields, updates an event's fields.
     * 
     * @param int $event_id
     * @param string $scheduled_with    This parameter is never used
     * @param string $date
     * @param string $description
     * @param int $is_virutal           Is only 1/0
     * @param string $address
     * @return mysqli_object $result
     * @throws Exceptions 
     */
    public function updateEvent($event_id, $scheduled_with, $date, $description, $is_virtual, $address) {
        $sql_event = "UPDATE events SET date=IFNULL(?, date), description=IFNULL(?, description), 
                  is_virtual=IFNULL(?, is_virtual), address=IFNULL(?, address) WHERE id=?";
        // $sql_xref = "UPDATE xref_users_events SET user_id = ? WHERE "
        // The above needs to be worked on to make sure that $scheduled_with actually works
        $stmt = $this -> conn -> prepare($sql_event);

        if (!$stmt) {
            throw new Exception($stmt->error);
        }

        $stmt -> bind_param("ssisi", $date, $description, $is_virtual, $address, $event_id);
        $stmt -> execute();
        $result = $stmt -> get_result();

        return $result;
    }

    /**
     * Adds a cross-reference in xref_users_events given a user id and event id.
     * 
     * @param int $uid
     * @param int $event_id
     * @return mysqli_object $result
     * @throws Exception
     */
    public function addXref($uid, $event_id) {
        $sql = "INSERT INTO xref_users_events (user_id, event_id)
                VALUES(?, ?)";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement -> bind_param("ii", $uid, $event_id);
        $statement -> execute();
        $result = $statement -> get_result();

        return $result;
    }

    /**
     * Given an event_id, returns the number of users registered
     * for that event.
     * 
     * @param int $event_id
     * @return int
     * @throws Exception
     */
    public function getNumUsersInEvent($event_id) {
        $sql = "SELECT * FROM xref_users_events WHERE event_id = ?";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement -> bind_param("i", $event_id);
        $statement -> execute();
        $result = $statement -> get_result();

        return $result -> num_rows;
    }

    /**
     * Creates an event given all event parameters.
     * 
     * @param int $isVirtual     Is only 1/0
     * @param string $date
     * @param string $address
     * @param string $description
     * @param int $capacity
     * @param string $name
     * @param int $price
     * @return int $ret         Value of the AUTO_INCREMENT field updated
     * @throws Exception
     */
    public function createEvent($isVirtual, $date, $address, $description, $capacity, $name, $price = 100) {
        if($isVirtual == 1) {
            $address = "https://us02web.zoom.us/j/3847814790";
        }

        $sql = "INSERT INTO events (type_id, is_virtual, date, address, description, capacity, name, price)
                VALUES(2, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement -> bind_param("isssisi", $isVirtual, $date, $address, $description, $capacity, $name, $price);
        $statement -> execute();
        $result = $statement -> get_result();
        $ret = mysqli_insert_id($this->conn);

        return $ret;
    }

    /**
     * Adds a user to an event given their uid and the event id.
     * 
     * @param int $event_id
     * @param int $uid
     * @return int $uid
     */
    public function addToEvent($event_id, $uid) {
        $sql = "INSERT INTO xref_users_events (user_id, event_id)
                VALUES(?, ?)";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement -> bind_param("ii", $uid, $event_id);
        $statement -> execute();
        $result = $statement -> get_result();

        return $uid;
    }

    /**
     * Gets all of xref_users_events, and then filters out the ones with
     * $admin_id, and then filters by only the events that $admin_id
     * is managing
     * 
     * @param int $admin_id
     * @return mysqli_object $result
     * @throws Exception
     */
    public function getUsersScheduledWithAdmin($admin_id) {
        $sql = "SELECT DISTINCT x.user_id, u.first_name, u.last_name
            FROM
                xref_users_events AS x,
                users AS u
            WHERE
                x.user_id != ?
                AND x.user_id = u.uid
                AND x.event_id IN (SELECT event_id FROM xref_users_events AS x WHERE x.user_id = ?)
            ORDER BY u.last_name, u.first_name;";
		
        $statement = $this -> conn -> prepare($sql);

        if (!$statement) throw new Exception($statement->error);

        $statement -> bind_param("ii", $admin_id, $admin_id);
        $statement -> execute();
        $result = $statement -> get_result();

        return $result;
    }

    /**
     * Adds an amount of credits to a user given their uid.
     * 
     * @param int $uid      User's uid
     * @param int $amount   Amount to be added to credits field
     * @return int $result
     * @throws Exception
     */
    public function addCredits($uid, $amount) {
        $sql = "UPDATE users
                SET credits = credits + ?
                WHERE uid = ?";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) throw new Exception($statement->error);

        $statement -> bind_param("ii", $amount, $uid);
        $statement -> execute();
        $result = $statement -> affected_rows;

        return $result;
    }

    /**
     * Gets a row from table users given a uid.
     * 
     * @param int $uid
     * @return array $ret;
     * @throws Exception
     */
    public function getUserFromUID($uid) {
        $sql = "SELECT *
                FROM users
                WHERE uid = ?";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("i", $uid);
        $statement->execute();
        $result = $statement -> get_result();
        while($row = $result -> fetch_assoc()) {
            $ret = $row;
        }
        return $ret;
    }

    /**
     * Updates the number of credits a user has given a uid
     * and a new credit amount.
     * 
     * @param int $uid
     * @param int $newAmt
     * @return int $result
     * @throws Exception
     */
    public function updateUserCredits($uid, $newAmt) {
        $sql = "UPDATE users
                SET credits = ?
                WHERE uid = ?";
        
        $statement = $this -> conn -> prepare($sql);

        if (!$statement) throw new Exception($statement->error);

        $statement -> bind_param("ii", $newAmt, $uid);
        $statement -> execute();
        $result = $statement -> affected_rows;

        return $result;
    }

    /**
     * Gets a row from users given a search string. 
     * Row returned contains uid, first_name, last_name, email, and credits.
     * Should probably be renamed.
     * 
     * @param String $searchString
     * @return mysqli_result $result
     * @throws Exception
     * @author Riley Kim <rileykim257@gmail.com>
     */
    public function getUserCredits($searchString) {
        $sql = "SELECT uid, first_name, last_name, email, credits 
                FROM users
                WHERE CONCAT(first_name, ' ', last_name) LIKE CONCAT( '%',?,'%')
                ORDER BY last_name, first_name";
        
        $statement = $this -> conn -> prepare($sql);
        $statement->bind_param("s", $searchString);
        $statement->execute();
        $result = $statement -> get_result();
        
        return $result;
    }
        
    /**
     * Deletes event from table event given an id.
     * 
     * @param int $id
     * @return int $id
     * @throws Exception
     */
    public function deleteEvent($id) {
        $sql = "DELETE
                FROM events
                WHERE id = ?;";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }

        $statement->bind_param("i", $id);
        $statement->execute();
        $this -> deleteXrefs($id);
        return $id;
    }

    /**
     * Deletes all cross-references given an event id from 
     * the table xref_users_events.
     * 
     * @param int $id
     * @return int $id
     * @throws Exception
     */
    public function deleteXrefs($id) {
        $sql = "DELETE 
                FROM xref_users_events
                WHERE event_id = ?";

        $statement = $this -> conn -> prepare($sql);

        if (!$statement) {
            throw new Exception($statement->error);
        }


        $statement->bind_param("i", $id);
        $statement->execute();
        return $id;
    }


    /**
     * @param $datetime
     * @return bool
     * @throws Exception
     *
     *
     * Validates a time, given a date and time.
     * A time is valid if it is between 9am and 6pm
     * and also if it does not interfere with any previously scheduled
     * appointments.
     */
    public function validateTime($datetime) {
        $time_arr = explode(":", explode("T", $datetime)[1]);
        $hour_before = explode("T", $datetime)[0] . "T" . intval($time_arr[0]) - 1 . ":" . $time_arr[1];
        $hour_after = explode("T", $datetime)[0] . "T" . intval($time_arr[0]) + 1 . ":" . $time_arr[1];


        $sql = "SELECT * FROM events WHERE type_id = 1 AND date >= ? AND date <= ?";

        $statement = $this -> conn -> prepare($sql);

        if(!$statement) {
            throw new Exception($statement->error);
        }

        $statement -> bind_param("ss", $hour_before, $hour_after);
        $statement -> execute();
        return $statement -> get_result() -> num_rows === 0 && intval($time_arr[0]) >= 9 && intval($time_arr[0]) <= 18;
    }
}