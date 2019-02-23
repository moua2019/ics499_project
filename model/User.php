<?php
/**
 * Project: ics499_project
 *
 * User.php: Interface provides the main characteristics of system users.
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-22 10:18
 *
 * Last update by:
 * Last update on:
 */

interface User
{
    public function setId($userId);

    public function setUsername($userName);

    public function setPassword($pass);

} // End of User interface.