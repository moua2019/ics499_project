<?php
/**
 * Project: ics499_project
 *
 * RepositoryInterface.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-22 16:27
 *
 * Last update by:
 * Last update on:
 */


interface RepositoryInterface
{
    /**
     * @param UserInterface $user Adds user to db
     * @return bool True if user is added to data base, false otherwise.
     */
    public function addUser(UserInterface $user);

    /**
     * @param $userName $userName username to search user
     * @return mixed return UserInterface
     */
    public function getUserByUsername($userName);

    /**
     * @return mixed Return all users in database
     */
    public function getUsers();

} // End of RepositoryInterface interface.