<?php
/**
 * Project: ics499_project
 *
 * Player.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-28 22:40
 *
 * Last update by:
 * Last update on:
 */

class Player implements UserInterface
{
    private $plyrID;
    private $plyrFname;
    private $plyrLname;
    private $plyrPhone;
    private $plyrTshirtNumber;
    private $plyrPosition;
    private $roster_id;

    /**
     * Player constructor.
     * @param $plyrID
     * @param $plyrFname
     * @param $plyrLname
     * @param $plyrPhone
     * @param $plyrTshirtNumber
     * @param $plyrPosition
     * @param $roster_id
     */
    public function __construct($plyrID, $plyrFname, $plyrLname, $plyrPhone, $plyrTshirtNumber, $plyrPosition, $roster_id)
    {
        $this->setPlyrID($plyrID);
        $this->setPlyrFname($plyrFname);
        $this->setPlyrLname($plyrLname);
        $this->setPlyrPhone($plyrPhone);
        $this->setPlyrTshirtNumber($plyrTshirtNumber);
        $this->setPlyrPosition($plyrPosition);
        $this->setRosterId($roster_id);
    }


    /**
     * @return mixed
     */
    public function getPlyrID()
    {
        return $this->plyrID;
    }

    /**
     * @param mixed $plyrID
     */
    public function setPlyrID($plyrID)
    {
        $this->plyrID = $plyrID;
    }

    /**
     * @return mixed
     */
    public function getPlyrFname()
    {
        return $this->plyrFname;
    }

    /**
     * @param mixed $plyrFname
     */
    public function setPlyrFname($plyrFname)
    {
        $this->plyrFname = $plyrFname;
    }

    /**
     * @return mixed
     */
    public function getPlyrLname()
    {
        return $this->plyrLname;
    }

    /**
     * @param mixed $plyrLname
     */
    public function setPlyrLname($plyrLname)
    {
        $this->plyrLname = $plyrLname;
    }

    /**
     * @return mixed
     */
    public function getPlyrPhone()
    {
        return $this->plyrPhone;
    }

    /**
     * @param mixed $plyrPhone
     */
    public function setPlyrPhone($plyrPhone)
    {
        $this->plyrPhone = $plyrPhone;
    }

    /**
     * @return mixed
     */
    public function getPlyrTshirtNumber()
    {
        return $this->plyrTshirtNumber;
    }

    /**
     * @param mixed $plyrTshirtNumber
     */
    public function setPlyrTshirtNumber($plyrTshirtNumber)
    {
        $this->plyrTshirtNumber = $plyrTshirtNumber;
    }

    /**
     * @return mixed
     */
    public function getPlyrPosition()
    {
        return $this->plyrPosition;
    }

    /**
     * @param mixed $plyrPosition
     */
    public function setPlyrPosition($plyrPosition)
    {
        $this->plyrPosition = $plyrPosition;
    }

    /**
     * @return mixed
     */
    public function getRosterId()
    {
        return $this->roster_id;
    }

    /**
     * @param mixed $roster_id
     */
    public function setRosterId($roster_id)
    {
        $this->roster_id = $roster_id;
    }


    public function setId($userId)
    {
        // TODO: Implement setId() method.
    }

    public function setUsername($userName)
    {
        // TODO: Implement setUsername() method.
    }

    public function setPassword($pass)
    {
        // TODO: Implement setPassword() method.
    }
} // End of Player class.