<?php
/**
 * Created by PhpStorm.
 * User: Pajhli Nengchu
 * Date: 3/24/2019
 * Time: 2:14 PM
 */
include_once "UserInterface.php";

/**
 * @property CreateUniqueId uniqueIdObject
 */
class Admin implements UserInterface
{
    private $id;
    private $adminUsername;
    private $adminFirstName;
    private $adminLastName;
    private $adminEmail;
    private $adminPhone;
    private $password;
    private $uniqueIdObject;
//    private $leadTeamId;


    /**
     * Leader constructor takes no arguments.
     */
    public function _construct(){}

    /**
     * Leader constructor.
     * @param $userName
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phone
     * @param $pwd
     */
    public function __construct($userName, $firstName, $lastName, $email, $phone, $pwd){
        $this->setUsername($userName);
        $this->setAdminFirstName($firstName);
        $this->setAdminLastName($lastName);
        $this->setId($this->adminFirstName);
        $this->setAdminEmail($email);
        $this->setAdminPhone($phone);
        $this->setPassword($pwd);
       // $this->setLeadTeamId($teamId);
    }



    public function setId($userName)
    {
        $this->id = $this->createUniqueId($this->getadminFirstName(), $this->getadminLastName());
    }

    public function setUsername($userName)
    {
        $this->adminUsername = $userName;
    }

    public function setPassword($pass)
    {
        $this->password = password_hash($pass, PASSWORD_DEFAULT);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAdminUsername()
    {
        return $this->adminUsername;
    }

    /**
     * @return mixed
     */
    public function getAdminEmail()
    {
        return $this->adminEmail;
    }

    /**
     * @return mixed
     */
    public function getAdminPhone()
    {
        return $this->adminPhone;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $adminEmail
     */
    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    /**
     * @param mixed $adminPhone
     */
    public function setAdminPhone($adminPhone)
    {
        $this->adminPhone = $adminPhone;
    }

    /**
     * @return mixed
     */
    public function getAdminLastName()
    {
        return $this->adminLastName;
    }

    /**
     * @param mixed $adminLastName
     */
    public function setAdminLastName($adminLastName)
    {
        $this->adminLastName = $adminLastName;
    }

    /**
     * @return mixed
     */
    public function getAdminFirstName()
    {
        return $this->adminFirstName;
    }

    /**
     * @param $adminFirstName
     */
    public function setAdminFirstName($adminFirstName)
    {
        $this->adminFirstName = $adminFirstName;
    }

//    /**
//     * @return mixed leader team id
//     */
//    public function getLeadTeamId()
//    {
//        return $this->leadTeamId;
//    }
//
//    /**
//     * @param mixed $teamId user leader team id input
//    */
//    public function setLeadTeamId($teamId)
//    {
//        $this->leadTeamId = $teamId;
//    }
//
//
//
    private function createUniqueId($firstName, $lastName)
    {
        include_once "../model/CreateUniqueId.php";
        $this->uniqueIdObject = new CreateUniqueId();
        return $this->uniqueIdObject->getUniqueId($firstName, $lastName);
    }


    /**
     * @return array Leader: First Name, Last Name, Username, Email, Phone, TeamId.
     */
    public function _toString(){
        return array($this->getAdminFirstName(),$this->getAdminLastName(),$this->getAdminUsername(),$this->getAdminEmail(),
            $this->getAdminPhone());
    }
} // End of Admin class
