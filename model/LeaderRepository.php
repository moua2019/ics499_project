<?php
/**
 * Project: ics499_project
 *
 * Repository.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-22 16:29
 *
 * Last update by: Franklin
 * Last update on: 2019-03-19 14:30
 */
include_once "DataBaseConnection.php";
include_once "RepositoryInterface.php";

class LeaderRepository extends DataBaseConnection implements RepositoryInterface
{
//    private $leader;
    public function _construct(){
    }

    /**
     * @param UserInterface $leader Add user to db
     * @return bool True if user is added to data base, false otherwise.
     */
    public function addUser(UserInterface $leader)
    {
        $stmt = $this->getDbc()->prepare("INSERT INTO Leader (leader_id, leader_username, leader_firstName, leader_lastName, leader_email, leader_phone, leader_pass)
                                              VALUES (?, ?, ?, ?, ?, ?, ?)");


        return !($stmt->execute([$leader->getId(), $leader->getLeadUsername(),
            $leader->getLeadFirstName(), $leader->getLeadLastName(),
            $leader->getLeadEmail(), $leader->getLeadPhone(),
            $leader->getPassword()])) ? false : true;
    }


    /**
     * @param Leader $userName Uses username to search user from Leader db
     * @return mixed return UserInterface if exists, empty string otherwise.
     */
    public function getUserByUsername($userName)
    {
        $emptyStr = "";
        if (!empty($userName)) {
            // Get leader from database
            $stmt = $this->getDbc()->prepare("SELECT * FROM Leader WHERE leader_username = ?");

            // Execute statement
            $stmt->execute([$userName]);

            // Return user if exists
            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    $leader = new Leader($row['leader_username'],$row['leader_firstName'],$row['leader_lastName'],$row['leader_email'],$row['leader_phone'], $row['leader_pass'], $row['leader_team_id']);

                    return $leader;
                }

            } else {
                return $emptyStr;
            }

        } else {
            return $emptyStr;
        }
    }

    /**
     * @return mixed Return all leaders from database.
     */
    public function getUsers()
    {
        // Get all leaders from db
        // Get leader from database
        $stmt = $this->getDbc()->prepare("SELECT * FROM Leader ORDER BY leader_lastName");

        // Execute statement
        $stmt->execute();

        // Leader array
        $leaderArray = array();

        // Return user if exists
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                $leaderArray [] = new Leader($row['leader_id'],$row['leader_username'],$row['leader_firstName'],$row['leader_lastName'],$row['leader_email'],$row['leader_phone'], $row['leader_team_id']);
            }

        }

        return $leaderArray;

    }

    /**
     * @param String $username username input
     * @param String $pwd user's password input
     * @return bool True if user's password match password_in_file, false otherwise
     */
    public function verifyLeader($username, $pwd) {
        // If username and pwd are not empty
        if (!empty($username) and !empty($pwd)) {
            // Prepare statement
            $stmt = $this->getDbc()->prepare("SELECT leader_pass FROM Leader WHERE leader_username = ?");

            // Execute statement
            $stmt->execute([$username]);

            // If password for username exists, then verify if password_in_file match $pwd
            if ($stmt->rowCount()) {
                // Password in db
                $pwdInFile = "";

                // Get password from db
                while ($row = $stmt->fetch()) {
                    $pwdInFile = $row['leader_pass'];
                }

                // Verify if password match
                return password_verify($pwd, $pwdInFile);
            } else {
                return false;
            }

        } else { // If username or password are empty return false
            return false;
        }
    }

    /**
     * @param String $username used to update Leader team id
     * @param String $teamId Team Id to insert into db
     * @return bool True if update is successful, false otherwise.
     */
    public function updateLeaderTeamId ($username, $teamId) {
        if (!is_null($teamId)){
            // Prepare statement
            $stmt = $this->getDbc()->prepare("UPDATE Leader SET leader_team_id = ? WHERE leader_username = ?");

            // Execute statement / add teamId to Leader table
            return !($stmt->execute([$teamId, $username])) ? false : true;

        }
    }


} // End of Repository class.