<?php
/**
 * Project: ics499_project
 *
 * RosterRepository.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-24 23:08
 *
 * Last update by:
 * Last update on:
 */

include_once "DataBaseConnection.php";
include_once "RepositoryInterface.php";
include "Roster.php";

class RosterRepository extends DataBaseConnection
{

    /**
     * @param Roster $roster New Roster object
     * @return bool True if user is added to data base, false otherwise.
     */
    public function addRoster(Roster $roster)
    {
        $stmt = $this->getDbc()->prepare("INSERT INTO TempRoster (temp_roster_id, temp_roster_name, number_of_players, sport_type, leader_id)
                                              VALUES (?, ?, ?, ?, ?)");

        echo 'roster leader id:' . $roster->getLeaderId();

        return !($stmt->execute([$roster->getId(), $roster->getRosterName(),
            $roster->getNumberOfPlayers(), $roster->getSportType(),$roster->getLeaderId()])) ? false : true ;
    }

    /**
     * @param $rosterName String to retrieve Roster
     * @return mixed return Roster if exists, empty string otherwise.
     */
    public function getRosterByRosterName($rosterName)
    {
        $roster = "";
        if (!empty($rosterName)) {
            // Get leader from database
            $stmt = $this->getDbc()->prepare("SELECT * FROM Roster WHERE roster_name = ?");

            // Execute statement
            $stmt->execute([$rosterName]);

            // Return user if exists
            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    $roster = new Roster($row['roster_id'], $row['roster_name'],$row['number_of_players'],$row['sport_type'],$row['leader_id']);

                }

                return $roster;

            } else {
                return $roster;
            }

        } else {
            return $roster;
        }
    }

    /**
     * @return mixed Return all Rosters existing in database
     */
    public function getRosters()
    {
        // TODO: Implement getUsers() method.
    }
} // End of RosterRepository class.