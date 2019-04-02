<?php
/**
 * Project: ics499_project
 *
 * PlayerController.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-04-02 15:49
 *
 * Last update by:
 * Last update on:
 */


include_once "../model/Admin.php";
include_once "../model/AdminRepository.php";

class PlayerController
{
    private $playerRepository;
    // Player Constructor ($plyrID, $plyrFname, $plyrLname, $plyrPhone, $plyrTshirtNumber, $plyrPosition, $roster_id)


    /**
     * Constructor
     */
    public function _construct()
    {
        $this->playerRepository = new PlayerRepository();
    }


//    public function registerLeader($first, $last, $username, $email, $phone, $password, $teamId)
//    {
//        $repository = new LeaderRepository();
//        $user = new Leader($username, $first, $last, $email, $phone, $password, $teamId);
//
//        return !($repository->addUser($user)) ? '../view/LeaderSignUp.php' : '../view/SignupConfirmation.php';
//    }

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
        echo "username:" . $username;
        $repository = new AdminRepository();

        $admin = $repository->getUserByUsername($username);

        return $admin->_toString();
    }

    /**
     * @param $rosterID String roster id  to look players on Roster
     * @return mixed an array of Leader type objects
     */
    public function getAllPlayersByRosterId($rosterID)
    {
        $repository = new PlayerRepository();
        $playerArray = $repository->getAllPlayersByRosterId($rosterID);

        return $playerArray;
    }

//    /**
//     * @param $username String username input
//     * @param $pwd String password input
//     * @return bool True if password match password in file, false otherwise
//     */
//    public function verifyAdminPass($username, $pwd) {
//        $repository = new AdminRepository();
//        return $repository->verifyAdmin($username, $pwd);
//    }

} // End of PlayerController class.

