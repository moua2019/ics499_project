<?php
/**
 * Project: ics499_project
 *
 * PlayerRepository.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-28 23:20
 *
 * Last update by:
 * Last update on:
 */


include_once "DataBaseConnection.php";
include_once "RepositoryInterface.php";

class PlayerRepository extends DataBaseConnection implements RepositoryInterface
{

    /**
     * @param UserInterface $player
     * @return bool True if user is added to data base, false otherwise.
     */
    public function addUser(UserInterface $player)
    {
        $stmt = $this->getDbc()->prepare("INSERT INTO Player(player_id, player_firstName, player_lastName, player_phone, tshirt_number, position, roster_id)
                                              VALUES (?, ?, ?, ?, ?, ?, ?)");


        return !($stmt->execute([$player->getPlyrID(),
            $player->getPlyrFname(), $player->getPlyrLname(),
            $player->getPlyrPhone(), $player->getPlyrTshirtNumber(),
            $player->getPlyrPosition(), $player->getRosterId()])) ? false : true;
    }

    /**
     * @param String $userName It is looked by PlayerId (username = playerId
     * @return mixed return UserInterface
     */
    public function getUserByUsername($userName)
    {
        $emptyStr = "";
        if (!empty($userName)) {
            // Get leader from database
            $stmt = $this->getDbc()->prepare("SELECT * FROM Player WHERE player_id = ?");

            // Execute statement
            $stmt->execute([$userName]);

            // Return user if exists
            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    $player = new Player($row['player_id'], $row['player_firstName'], $row['player_lastName'], $row['player_phone'], $row['tshirt_number'], $row['position'], $row['roster_id']);

                    return $player;
                }

            } else {
                return $emptyStr;
            }

        } else {
            return $emptyStr;
        }
    }

    /**
     * @return mixed Return all players in database
     */
    public function getUsers()
    {
        // Get all leaders from db
        // Get leader from database
        $stmt = $this->getDbc()->prepare("SELECT * FROM Player ORDER BY player_lastName");

        // Execute statement
        $stmt->execute();

        // Leader array
        $playerArray = array();

        // Return user if exists
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) { //
                $playerArray [] = new Player($row['player_id'], $row['player_firstName'], $row['player_lastName'], $row['player_phone'], $row['tshirt_number'], $row['position'], $row['roster_id']);
            }

        } else {
            $playerArray = "";

            return $playerArray;
        }
    } // End of getUsers()

} // End of PlayerRepository class.

