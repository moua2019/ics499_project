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


    public function registerLeader($first, $last, $username, $email, $phone, $password, $teamId)
    {
        $repository = new LeaderRepository();
        $user = new Leader($username, $first, $last, $email, $phone, $password, $teamId);

        return !($repository->addUser($user)) ? '../view/LeaderSignUp.php' : '../view/SignupConfirmation.php';
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
     * @param $username String user input
     * @return mixed a Leader type object
     */
    public function getLeader($username){

        $repository = new LeaderRepository();

        $leader = $repository->getUserByUsername($username);

        return $leader;
    }

    /**
     * @return mixed an array of Leader type objects
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
     * @param String $username Leader username
     * @param String $teamId used to update Leader team id
     * @return bool True if leader team id is updated, false otherwise
     */
    public function updateLeaderTeamId ($username, $teamId) {
        if (!(empty($username) and empty($teamId))) {
            $repository = new LeaderRepository();
            return $repository->updateLeaderTeamId($username, $teamId);
        } else {
            return false;
        }
    }

} // End of UserController class.