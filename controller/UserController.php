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
     * @param $id
     * @param $name
     * @param $leader_id
     * @param $numbOfPlayers
     * @param $sport
     * @param $playerArray
     * @return bool if user is added then it will display successful message,
     *              otherwise it will display in the Signup form.
     */
    public function registerRoster($id, $name, $leader_id, $numbOfPlayers, $sport, $playerArray )
    {
        // Creates a Roster object and add it to the database
        $rosterRepo = new RosterRepository();
        $roster = new Roster($id, $name, $numbOfPlayers, $sport, $leader_id);

        // Crete a leader object

        $isValid = !($rosterRepo->addRoster($roster)) ? false : true;

        // Creates a Player object for each member of player array and adds
        // it to the database
        // TODO: create player object and add to db, make sure isValid checks success action

        // If Roster registration succeed, add roster_id to leader table
        $isValid = $this->updateLeaderRosterId($leader_id, $id) ? true : false;

        // TODO:

        return $isValid ?  '../view/LeaderInterface.php' : '../view/RosterRegistration.php' ;
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
    public function getTeam($rosterId){
        //TODO: get data from team table. For now return Team in Process
        return "--Getting Team Name in Process--";
    }

} // End of UserController class.