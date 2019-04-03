<?php
/**
 * Project: ics499_project
 *
 * UserController.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-22 16:49
 *
 * Last update by:
 * Last update on: 2019-03-19 12:51
 */

include_once "../model/Leader.php";
include_once "../model/LeaderRepository.php";
include_once "../model/RosterRepository.php";
include_once "../model/Player.php";
include_once "../model/PlayerRepository.php";
include_once "../model/CreateUniqueId.php";

class UserController
{
    private $leaderRepository;

    /**
     * Constructor
     */
    public function _construct()
    {
        $this->leaderRepository = new LeaderRepository();
    }


    /**
     * Creates a Leader object from user input to register into database
     * @param $id Leader id
     * @param $first String Leader First Name
     * @param $last String Leader Last Name
     * @param $username String Leader username
     * @param $email String Leader email
     * @param $phone String Leader phone
     * @param $password String Leader password
     * @param $teamId String Leader team id
     * @return bool if user is added then it will display successful message,
     *              otherwise it will display in the Signup form.
     */
    public function registerLeader($id, $first, $last, $username, $email, $phone, $password, $teamId)
    {
        $repository = new LeaderRepository();
        $user = new Leader($id, $username, $first, $last, $email, $phone, $password, $teamId);

        return !($repository->addUser($user)) ? '../view/LeaderSignUp.php' : '../view/SignupConfirmation.php';
    }

    /**
     * Creates a Roster object from user input to register into database
     * @param $roster_id
     * @param $name
     * @param $leader_id
     * @param $numbOfPlayers
     * @param $sport
     * @param $playerArray
     * @return bool if user is added then it will display successful message,
     *              otherwise it will display in the Signup form.
     */
    public function registerRoster($roster_id, $name, $leader_id, $numbOfPlayers, $sport, $playerArray )
    {
        // Creates a Roster object and add it to the database
        $rosterRepo = new RosterRepository();
        $roster = new Roster($roster_id, $name, $numbOfPlayers, $sport, $leader_id);

        $isRosterAdded = false;

        // Add  Roster to db
        if ($rosterRepo->addRoster($roster)) {
            // Add Players
            if ($this->addPlayerArrayToDb($playerArray, $roster_id)) {
                // If Roster registration succeed, add roster_id to leader table
                if ($this->updateLeaderRosterId($leader_id, $roster_id)){
                    $isRosterAdded = true;
                }
            }
        }

        // Redirect User
        return $isRosterAdded ?  '../view/LeaderInterface.php' : '../view/VolleyballRosterRegistration.php' ;
    }


    /**
     * @param $rosterID
     * @return string|null Roster Name if Roster is found, null otherwise
     */
    public function getRosterName($rosterID)
    {
        if (!empty($rosterID)){
            $roster = $this->getRosterById($rosterID);

            return is_null($roster) ? null : $roster->getRosterName();
        } else {
            return null;
        }
    }

    /**
     * @param $rosterID Roster id used to look for Roster
     * @return Roster|null Roster if it is found, null otherwise
     */
    public function getRosterById($rosterID)
    {
        if (!empty($rosterID)){

            $rosterRepo = new RosterRepository();

            return $rosterRepo->getRosterByRosterId($rosterID);
        } else {
            return null;
        }
    }

    /**
     * @param $rosterID String used to look for Roster.
     * @return String|null Sport type if Roster exists, null otherwise
     */
    public function getRosterSportType($rosterID)
    {
        if (!empty($rosterID)){

            $rosterRepo = new RosterRepository();

            return $rosterRepo->getSportType($rosterID);
        } else {
            return null;
        }
    }


    /*
     * @param $plyrArray
     * @param $rosterID
     * @return bool true if all the players are added to db, false otherwise
     */
    private function addPlayerArrayToDb($plyrArray, $rosterID) {
        $isAdded = false;

        foreach ($plyrArray as $item => $value) {
            $isAdded = $this->registerPlayer($value['fname'], $value['lname'], $value['phone'],
                $value['shirt'], $value['position'], $rosterID) ? true : false;
        }

        return $isAdded;
    }

    /**
     * @param $fName
     * @param $lName
     * @param $phone
     * @param $shirt
     * @param $position
     * @param $rosterID
     * @return bool true if player is added to db, false otherwise
     */
    public function registerPlayer($fName, $lName, $phone, $shirt, $position, $rosterID) {
        // Create unique id for player
        $uniqueIdObj = new CreateUniqueId();
        $id = $uniqueIdObj->getUniqueId($fName,$lName);

        // Create PlayerRepository Object
        $plyrRepo = new PlayerRepository();

        // Create a Player object
        $player = new Player($id, $fName, $lName, $phone, $shirt, $position, $rosterID);

        // Add player to Repository and return results
        return $plyrRepo->addUser($player); // True if player is added to db
    }

    /**
     * @param $username String is used to verify if user exist
     * @return bool true if username is found, false otherwise
     */
    public function leaderUsernameExists($username)
    {
        $repository = new LeaderRepository();

        return $repository->getUserByUsername($username) ? true : false;
    }

    /**
     * @param $teamName String Team name to check if roster name exists
     *          under this name
     * @return bool true if roster name is found, false otherwise
     */
    public function teamNameExist($teamName)
    {
        $repository = new RosterRepository();

        return $repository->getRosterByRosterName($teamName) ? true : false;
    }



    /**
     * @param $username String user input
     * @return mixed a Leader type object
     */
    public function getLeader($username){

        $repository = new LeaderRepository();

        $leader = $repository->getUserByUsername($username);

        return $leader;
    }

    /**
     * @param $username String user input
     * @return array with Leader information
     */
    public function getLeaderInfo($username){

        $repository = new LeaderRepository();

        $leader = $repository->getUserByUsername($username);

        return $leader->_toString();
    }

    /**
     * @return array of Leader type objects
     */
    public function getAllLeaders()
    {
        $repository = new LeaderRepository();

        return $repository->getUsers();
    }

    /**
     * @param $username String username input
     * @param $pwd String password input
     * @return bool True if password match password in file, false otherwise
     */
    public function verifyLeaderPass($username, $pwd) {
        $repository = new LeaderRepository();
        return $repository->verifyLeader($username, $pwd);
    }

    /**
     * @param $leaderId
     * @param $rosterId
     * @return bool True if leader roster id is updated, false otherwise
     */
    public function updateLeaderRosterId ($leaderId, $rosterId) {
        if (!(empty($leaderId) and empty($rosterId))) {
            $repository = new LeaderRepository();
            return $repository->updateLeaderRosterId($leaderId, $rosterId);
        } else {
            return false;
        }
    }

    /**
     * @param $rosterId Leader rosterID, used to retrieved Leader's Roster Name
     * @return string Name of the Roster
     */
    public function getTeamNameByRosterId($rosterId){
        if (!empty($rosterId)){
            $rosterRepo = new RosterRepository();

            $roster = $rosterRepo->getRosterByRosterId($rosterId);

            $teamName = !empty($roster) ? $roster->getRosterName() : "No Team Name Found";

            return $teamName;
        } else {
            return null;
        }

    }

    /**
     * @param $username
     * @return String LeaderRoster id if exists, empty string otherwise.
     */
    public function getLeaderTeamId($username)
    {
        $leader = $this->getLeader($username);

        return $leader->getLeadRosterId();
    }

} // End of UserController class.