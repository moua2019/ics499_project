<?php
/**
 * Project: ics499_project
 *
 * CreateUniqueId.php: Creates a unique id using first three letters of first name,
 *      2 digit month, 2 digit day, 2 digit year, 2 digit minutes, 2 digit seconds,
 *      and first three letters of last name. A total of 16 characters.
 *      e.g. John Smith - ID: joh0221190840smi
 *
 *
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-21 20:23
 *
 * Last update by:
 * Last update on:
 */

// Default time set to Central Time
date_default_timezone_set("America/Belize");

class CreateUniqueId
{
    private $uniqueId;

    public function _CreateUniqueId(){

    }

    /**
     * @param $firstName
     * @param $lastName
     * @return mixed
     */
    public function getUniqueId($firstName, $lastName){
        $this->setUniqueId($firstName, $lastName);
        return $this->uniqueId;
    }

    private function setUniqueId($firstName, $lastName){
        $sub_3_fname = $this->getFirstThreeChar($firstName);
        $sub_3_lname = $this->getFirstThreeChar($lastName);
        $date_str = $this->getCurrentDateAndTime();

        $this->uniqueId = $sub_3_fname . $date_str . $sub_3_lname;
    }


    private function getFirstThreeChar($name)
    {
        $three = "";
        for ($i = 0; $i < 2; $i++){
            $letter = substr($name, $i, $i + 1);
            if (!($letter == " ")){
                $three .= trim($letter);
            }
        }
        switch (sizeof($three)) {
            case 2:
                $one = rand(0,9);
                $three .= $three . $one;
                break;
            case 1:
                $two = rand(0,9) . rand(0,9);
                $three .= $three . $two;
                break;
        }

        return $three;
    }

    /*
     * getCurrentDateAnTime() returns a string of current date and time e.g.
     * 02-21-19 08:40 = 0221190840
     */
    private function getCurrentDateAndTime()
    {
        // mdyis = [m=mm, d=dd, y=yy, i=2digit minute, s=2digit seconds]
        return date('mdyis');
    }


} // End of CreateUniqueId class.