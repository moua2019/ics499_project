<?php
/**
 * Created by PhpStorm.
 * User: Pajhli Nengchu
 * Date: 3/24/2019
 * Time: 9:44 AM
 */
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

include_once "../model/Admin.php";
include_once "../model/AdminrRepository.php";

class AdminController
{
    private $adminRepository;

    /**
     * Constructor
     */
    public function _construct()
    {
        $this->adminRepository = new adminRepository();
    }

/*
    public function registerLeader($first, $last, $username, $email, $phone, $password, $teamId)
    {
        $repository = new LeaderRepository();
        $user = new Leader($username, $first, $last, $email, $phone, $password, $teamId);

        return !($repository->addUser($user)) ? '../view/LeaderSignUp.php' : '../view/SignupConfirmation.php';
    }*/

    /**
     * @param $username String is used to verify if user exist
     * @return bool true if username is found, false otherwise
     */
    public function adminUsernameExists($username)
    {
        $repository = new adminRepository();

        return $repository->getUserByUsername($username) ? true : false;
    }

    /**
     * @param $username String user input
     * @return mixed a Leader type object
     */
    public function getAdmin($username){

        $repository = new adminRepository();

        $admin = $repository->getUserByUsername($username);

        return $admin;
    }

    /**
     * @param $username String user input
     * @return array with Leader information
     */
    public function getAdminInfo($username){

        $repository = new AdminRepository();

        $admin = $repository->getUserByUsername($username);

        return $admin->_toString();
    }

    /**
     * @return mixed an array of Leader type objects
     */
    public function getAllLeaders()
    {
        $repository = new AdminRepository();

        return $repository->getUsers();
    }

    /**
     * @param $username String username input
     * @param $pwd String password input
     * @return bool True if password match password in file, false otherwise
     */
    public function verifyAdminPass($username, $pwd) {
        $repository = new AdminRepository();
        return $repository->verifyLeader($username, $pwd);
    }

    /**
     * @param String $username Leader username
     * @param String $teamId used to update Leader team id
     * @return bool True if leader team id is updated, false otherwise
     */
    /*public function updateLeaderTeamId ($username, $teamId) {
        if (!(empty($username) and empty($teamId))) {
            $repository = new adminRepository();
            return $repository->updateLeaderTeamId($username, $teamId);
        } else {
            return false;
        }
    }*/

    /**
     * @param $teamId Leader teamID, used to retrieved Leader's Team Name
     * @return string Name of the Team
     */
    /*public function getTeam($teamId){
        return "--Getting Team Name in Process--";*/
    }

}

// End of AdminController class.

}