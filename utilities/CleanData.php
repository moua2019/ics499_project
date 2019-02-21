<?php
/**
 * Project: ics499_project
 *
 * CleanData.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-20 17:11
 *
 * Last update by:
 * Last update on:
 */

class CleanData
{
    public function _construct(){
    }

    public function getVarClean($input){
        if (!empty($input)){
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        } else {
            return null;
        }
    }
} // End of CleanData class.