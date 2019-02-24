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
include "../model/CreateUniqueId.php";
include "../model/User.php";


define("NO_MATCH_FOUND", "No match found");
define("USER_NAME_TAKEN", DUPLICATE_KEY_ENTRY);
define("NO_TEAM_ID", "");

class Leader extends DataBaseConnection implements User {
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


    public function setId($userId)
    {
        $this->leaderId = $userId;
    }

    public function setUsername($userName)
    {
        // Make sure username doesn't exist
        if ($this->getLeaderUserNameIfExists($userName) === NO_MATCH_FOUND){
            $this->leaderUserName = $userName;
        }
    }

    public function setPassword($pass)
    {
        $this->leaderPass = $pass;
    }

    /**
     * @return array  with each Leader first name in database
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
     * @return mixed
     */
    public function getLeaderUserName() {
        return $this->leaderUserName;
    }

    /**
     * @param $leaderUserName
     * @return string Leader username
     */
    public function getLeaderUserNameIfExists($leaderUserName) {
        $cleanUserName = $this->getVarClean($leaderUserName);
        if ((!is_null($cleanUserName)) and (!Empty($cleanUserName))) {
            $stmt = $this-> getDbc()->prepare("SELECT leader_username FROM Leader WHERE leader_username = ?");

            $stmt->execute([$cleanUserName]);

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    return $row['leader_username'];
                }
            } else {
                    return NO_MATCH_FOUND;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $leader_username
     * @param $leader_pass
     * @return bool True if Leader credentials are valid, false otherwise.
     */
    public function verifyLeader($leader_username, $leader_pass) {
        $cleaned_username = $this->getVarClean($leader_username);
        $cleaned_pass = $this->getVarClean($leader_pass);

        if ((!is_null($cleaned_pass)) and (!Empty($cleaned_pass)) and (!Empty($cleaned_username)) and (!Empty($cleaned_username))) {
            $stmt = $this->getDbc()->prepare("SELECT leader_pass FROM Leader WHERE leader_username = ?");

            // Get password from db using valid username
            $stmt->execute([$cleaned_username]);

            // If Leader exists verify password
            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    $pwdInFile = $row['leader_pass'];
                    return password_verify($cleaned_pass, $pwdInFile) ? true : false;
                }
            } else {
                return false;
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
            $stmt = $this->getDbc()->prepare("SELECT leader_team_id FROM leader WHERE leader_username = ?");

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
     * @return bool|string True if user is added to database, false otherwise. If
     *                     username is taken, it returns USER_NAME_TAKEN which is
     *                     MYSQL_DUPLICATE_KEY (code: 1062).
     */
    public function createLeader($leader_username, $leader_fName, $leader_lName, $leader_email, $leader_phone, $leader_pass){
        $temp_username = $this->getVarClean($leader_username);

        // Create new Leader if username has not been taken yet
        if ($this->getLeaderUserNameIfExists($temp_username) === NO_MATCH_FOUND) {
            $uniqueIdObj = new CreateUniqueId();
            $this->setUsername($temp_username);
            $this->leaderFirstName = $this->getVarClean($leader_fName);
            $this->leaderLastName = $this->getVarClean($leader_lName);
            $this->leaderEmail = $this->getVarClean($leader_email);
            $this->leaderPhone = $this->getVarClean($leader_phone);

            // Secure passwords
            $leaderPass = password_hash($this->getVarClean($leader_pass), PASSWORD_DEFAULT);

            // Create unique id
            do {
                // Create a unique id
                $tempUniqueId = $uniqueIdObj->getUniqueId($this->leaderFirstName, $this->leaderLastName);

                // Verify if tempUniqueId is unique
                $tempStmt = $this->getDbc()->prepare("SELECT leader_id FROM Leader WHERE leader_id = ?");
                $tempStmt->execute([$tempUniqueId]);

                // If tempUniqueId is unique set it to Leader id, otherwise repeat process.
                if ($tempStmt->rowCount()) {
                    $isIdUnique = false;
                } else {
                    $isIdUnique = true;
                    $this->setId($tempUniqueId);
                }
            } while (!$isIdUnique);

            // Inserting new Leader into database using these Leader attributes
            $stmt = $this->getDbc()->prepare("INSERT INTO Leader (leader_id, leader_username, leader_firstName, leader_lastName, leader_email, leader_phone, leader_pass)
                                              VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$this->leaderId, $this->getLeaderUserName(), $this->leaderFirstName, $this->leaderLastName, $this->leaderEmail, $this->leaderPhone, $leaderPass])){
                return true;
            } else {
                return false;
            }
        } else {
            return USER_NAME_TAKEN;
        }

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