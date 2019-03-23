<?php
/**
 * Project: ics499_project
 *
 * FormatPhone.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-22 22:43
 *
 * Last update by:
 * Last update on:
 */

class FormatPhone
{
    private $formatted_number;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getFormattedNumber()
    {
        return $this->formatted_number;
    }

    /**
     * setFormattedNumber() creates a string of a 10 digit phone number in the following format
     *  - (area code) three numbers - four numbers
     *      (123) 123-1234
     * @param mixed $number_to_format
     */
    public function setFormattedNumber($number_to_format)
    {
        $stripped_number = $this->stripNonNumbers($number_to_format);
        $this->formatted_number = $stripped_number;

        // Formatting a 10 number phone
        if (strlen($stripped_number) === 10) {
            $this->formatted_number = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $stripped_number);
        } else {
            $this->formatted_number = null;
        }
    }



    /*
     * stripNonNumbers() strip everything but numbers.
     */
    private function stripNonNumbers($number_str)
    {
        return preg_replace("/[^0-9]/", "", $number_str);
    }
} // End of FormatPhone class.