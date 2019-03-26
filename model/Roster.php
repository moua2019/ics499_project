<?php
/**
 * Project: ics499_project
 *
 * Roster.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-24 23:22
 *
 * Last update by:
 * Last update on:
 */

class Roster
{
    private $id;
    private $rosterName;
    private $numberOfPlayers;
    private $sportType;
    private $leaderId;

    /**
     * Roster constructor.
     * @param $id Roster id
     * @param $name Roster Name
     * @param $numberOfPlayers Number of Players in a Roster
     * @param $sportType String the sport the roster is being created for
     * @param $leaderId String of Leader that creates the Roster
     */
    public function __construct($id, $name, $numberOfPlayers, $sportType, $leaderId)
    {
        $this->setId($id);
        $this->setRosterName($name);
        $this->setNumberOfPlayers($numberOfPlayers);
        $this->setSportType($sportType);
        $this->setLeaderId($leaderId);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRosterName()
    {
        return $this->rosterName;
    }

    /**
     * @param mixed $name
     */
    public function setRosterName($name)
    {
        $this->rosterName = $name;
    }

    /**
     * @return mixed
     */
    public function getNumberOfPlayers()
    {
        return $this->numberOfPlayers;
    }

    /**
     * @param mixed $numberOfPlayers
     */
    public function setNumberOfPlayers($numberOfPlayers)
    {
        $this->numberOfPlayers = $numberOfPlayers;
    }

    /**
     * @return mixed
     */
    public function getSportType()
    {
        return $this->sportType;
    }

    /**
     * @param mixed $sportType
     */
    public function setSportType($sportType)
    {
        $this->sportType = $sportType;
    }

    /**
     * @return mixed
     */
    public function getLeaderId()
    {
        return $this->leaderId;
    }

    /**
     * @param mixed $leaderId
     */
    public function setLeaderId($leaderId)
    {
        $this->leaderId = $leaderId;
    }


} // End of Roster class.