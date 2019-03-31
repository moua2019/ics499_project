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
include_once "../utilities/CleanData.php";

class CreateUniqueId
{
    private $uniqueId;

    public function _CreateUniqueId()
    {

    }

    /**
     * @param $firstName
     * @param $lastName
     * @return mixed
     */
    public function getUniqueId($firstName, $lastName)
    {
        $this->setUniqueId($firstName, $lastName);
        return $this->uniqueId;
    }

    private function setUniqueId($firstName, $lastName)
    {
        $clean = new CleanData();

        $first = $clean->getVarClean($firstName);
        $last = $clean->getVarClean($lastName);

        $sub_3_fname = $this->getThreeChar($first);
        $sub_3_lname = $this->getThreeChar($last);
        $date_str = $this->getCurrentDateAndTime();

        $this->uniqueId = $sub_3_fname . $date_str . $sub_3_lname;
    }

    /*
     * Return three characters taken from the first three letters of $name.
     * If name has blank spaces in between it will be replaced with the next letter
     * or if $name is less than length of 3, then missing letters will be generated
     * randomly.
     */
    private function getThreeChar($name)
    {

        // If name is empty return Three random numbers
        if (empty(trim($name))) {
            return $this->getLetter(rand(0, 51)) . $this->getLetter(rand(0, 51)) . $this->getLetter(rand(0, 51));
        }  else {
            $three = "";

            for ($i = 0; $i < 3; $i++) {
                $c = trim(substr($name, $i - 1, $i ));

                $letter = is_numeric($c) ? $this->getLetter(rand(0,51)) : $c;

                $three .= filter_var($letter, FILTER_SANITIZE_STRING );

            }

            switch (strlen($three)) {
                case 2:
                    return $three . $this->getLetter(rand(0, 51));
                    break;
                case 1:
                    return $three . $this->getLetter(rand(0, 51)) . $this->getLetter(rand(0, 51));
                    break;
                case 0:
                    return $this->getLetter(rand(0, 51)) . $this->getLetter(rand(0, 51)) . $this->getLetter(rand(0, 51));;
                default:
                    return $three;
                    break;
            }
        }
    }

    /*
     * Return a letter using number to get letter from alphabet array
     */
    private function getLetter($number){
        // Generate Alphabet upper and lower case
        $alphabet = array_merge(range('A', 'Z'), range('a', 'z'));

        return $alphabet[$number];
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