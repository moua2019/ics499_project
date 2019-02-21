<?php
/**
 * Project: ics499_project
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-19 16:24
 *
 * Last update by:
 * Last update on:
 */
include "../model/DataBaseConnection.php";
define("NO_MATCH_FOUND", "No match found");
define("NO_TEAM_ID", "");

class Leader extends DataBaseConnection {
    private $db;
    private $leaderId;
    private $leaderUserName;
    private $leaderFirstName;
    private $leaderLastName;
    private $leaderEmail;
    private $leaderPhone;
    private $leaderPass;

    public function __construct() {
        $this->db = new DataBaseConnection();
    }

    /**
     * @return array  with each leader in database
     */
    public function getAllLeaders(){
        $leaders_array = array();
        $stmt = $this->db->getDbc()->prepare("SELECT * FROM Leader");

        $stmt->execute();


        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                $leaders_array[] = $this->leaderFirstName . " " . $row['leader_lastName'];
            }
        }
        return $leaders_array;
    }

    /**
     * @param $leaderUserName
     * @return string Leader username
     */
    public function getLeaderUserName($leaderUserName) {
        $cleanUserName = $this->getVarClean($leaderUserName);
        if ((!is_null($cleanUserName)) and (!Empty($cleanUserName))) {
            $uName = $leaderUserName;

            $stmt = $this-> getDbc()->prepare("SELECT leader_username FROM Leader WHERE leader_username = ?");

            $stmt->execute([$uName]);

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    $this->leaderUserName = $row['leader_username'];
                    return $this->leaderUserName;
                }
            } else {
                    return NO_MATCH_FOUND;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $leader_pass
     * @return bool True if leader credentials are valid, false otherwise.
     */
    public function verifyLeader($leader_pass) {
        $cleaned_pass = $this->getVarClean($leader_pass);

        if ((!is_null($cleaned_pass)) and (!Empty($cleaned_pass))) {
            $stmt = $this->getDbc()->prepare("SELECT leader_username FROM Leader WHERE leader_pass = ?");

            $stmt->execute([$cleaned_pass]);

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    $this->leaderUserName = $row['leader_username'];
                    return $this->leaderUserName;
                }
            } else {
                return NO_MATCH_FOUND;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $leader_username
     * @return bool
     */
    public function getLeaderTeamId($leader_username){
        $cleaned_username = $this->getVarClean($leader_username);

        if ((!is_null($cleaned_username)) and (!Empty($cleaned_username))) {
            $stmt = $this->getDbc()->prepare("SELECT leader_team_id FROM Leader WHERE leader_username = ?");

            $stmt->execute([$cleaned_username]);

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    return $row['leader_team_id'];
                }
            } else {
                return NO_TEAM_ID;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $leader_username
     * @param $leader_fName
     * @param $leader_lName
     * @param $leader_email
     * @param $leader_phone
     * @param $leader_pass
     */
    public function createLeader($leader_username, $leader_fName, $leader_lName, $leader_email, $leader_phone, $leader_pass){
        // Todo: Create a class that takes leader first name and last name to create a unique leader id
        $this->leaderUserName = $leader_username;
        $this->leaderFirstName = $leader_fName;
        $this->leaderLastName = $leader_lName;
        $this->leaderEmail = $leader_email;
        $this->leaderPhone = $leader_phone;
        $this->leaderPass = $leader_pass;

        // TODO: insert data into database using these leader attributes
    }

    /*
     * To clean input data
     */
    private function getVarClean($input){
        if (!empty($input)){
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        } else {
            return null;
        }
    }

} // End of Leader class.