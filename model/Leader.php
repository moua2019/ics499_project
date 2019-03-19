<?php
/**
 * Project: ics499_project
 *
 * Leader.php
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-22 15:54
 *
 * Last update by:
 * Last update on:
 */

include_once "UserInterface.php";

class Leader implements UserInterface
{
    private $id;
    private $leadUsername;
    private $leadFirstName;
    private $leadLastName;
    private $leadEmail;
    private $leadPhone;
    private $password;
    private $uniqueIdObject;
    private $leadTeamId;


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
     * @param $teamId
     */
    public function __construct($userName, $firstName, $lastName, $email, $phone, $pwd, $teamId){
        $this->setUsername($userName);
        $this->setLeadFirstName($firstName);
        $this->setLeadLastName($lastName);
        $this->setId($this->leadFirstName);
        $this->setLeadEmail($email);
        $this->setLeadPhone($phone);
        $this->setPassword($pwd);
        $this->setLeadTeamId($teamId);
    }



    public function setId($userName)
    {
        $this->id = $this->createUniqueId($this->getLeadFirstName(), $this->getLeadLastName());
    }

    public function setUsername($userName)
    {
        $this->leadUsername = $userName;
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
    public function getLeadUsername()
    {
        return $this->leadUsername;
    }

    /**
     * @return mixed
     */
    public function getLeadEmail()
    {
        return $this->leadEmail;
    }

    /**
     * @return mixed
     */
    public function getLeadPhone()
    {
        return $this->leadPhone;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $leadEmail
     */
    public function setLeadEmail($leadEmail)
    {
        $this->leadEmail = $leadEmail;
    }

    /**
     * @param mixed $leadPhone
     */
    public function setLeadPhone($leadPhone)
    {
        $this->leadPhone = $leadPhone;
    }

    /**
     * @return mixed
     */
    public function getLeadLastName()
    {
        return $this->leadLastName;
    }

    /**
     * @param mixed $leadLastName
     */
    public function setLeadLastName($leadLastName)
    {
        $this->leadLastName = $leadLastName;
    }

    /**
     * @return mixed
     */
    public function getLeadFirstName()
    {
        return $this->leadFirstName;
    }

    /**
     * @param mixed $leadFirstName
     */
    public function setLeadFirstName($leadFirstName)
    {
        $this->leadFirstName = $leadFirstName;
    }

    /**
     * @return mixed leader team id
     */
    public function getLeadTeamId()
    {
        return $this->leadTeamId;
    }

    /**
     * @param mixed $teamId user leader team id input
     */
    public function setLeadTeamId($teamId)
    {
        $this->leadTeamId = $teamId;
    }



    private function createUniqueId($firstName, $lastName)
    {
        include_once "../model/CreateUniqueId.php";
        $this->uniqueIdObject = new CreateUniqueId();
        return $this->uniqueIdObject->getUniqueId($firstName, $lastName);
    }
} // End of Leader class.