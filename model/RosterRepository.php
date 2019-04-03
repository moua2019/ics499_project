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

/**
 * Class RosterRepository
 */
class RosterRepository extends DataBaseConnection
{

    /**
     * @param Roster $roster New Roster object
     * @return bool True if user is added to data base, false otherwise.
     */
    public function addRoster(Roster $roster)
    {
        $stmt = $this->getDbc()->prepare("INSERT INTO Roster (roster_id, roster_name, registration_date, number_of_players, sport_type, leader_id)
                                              VALUES (?, ?, ?, ?, ?,?)");

        $current_date =  date("Y-m-d");

        return !($stmt->execute([$roster->getId(), $roster->getRosterName(), $current_date,
            $roster->getNumberOfPlayers(), $roster->getSportType(),$roster->getLeaderId()])) ? false : true ;
    }

    /**
     * @param $rosterName String to retrieve Roster
     * @return mixed return Roster if exists, empty string otherwise.
     */
    public function getRosterByRosterName($rosterName)
    {
        if (!empty($rosterName)) {
            // Get Roster from database
            $stmt = $this->getDbc()->prepare("SELECT * FROM Roster WHERE roster_name = ?");

            // Execute statement
            $stmt->execute([$rosterName]);

            // Return user if exists
            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    return new Roster($row['roster_id'], $row['roster_name'],$row['number_of_players'],$row['sport_type'],$row['leader_id']);
                }
            }
        }

        return null; // return null if rosterName is empty

    }

    /**
     * @return array|null Array of Roster objects if there are Roster in db, null otherwise.
     */
    public function getRosters()
    {
        // Roster array
        $rosterArray = array();

        // Get Rosters from database
        $stmt = $this->getDbc()->prepare("SELECT * FROM Roster");

        // Execute statement
        $stmt->execute();

        // Return user if exists
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                $rosterArray[] = new Roster($row['roster_id'], $row['roster_name'],$row['number_of_players'],$row['sport_type'],$row['leader_id']);
            }
            return $rosterArray;
        }
        return null; // If Roster table has no Rosters, return null.
    }

    /**
     * @param $rosterId String used to get Roster from database.
     * @return Roster|null Roster object if Roster is found, null otherwise
     */
    public function getRosterByRosterId($rosterId)
    {
        if (!empty($rosterId)){
            // Get Roster from database
            $stmt = $this->getDbc()->prepare("SELECT * FROM Roster WHERE roster_id = ?");

            // Execute statement
            $stmt->execute([$rosterId]);

            // Return user if exists
            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch()) {
                    return new Roster($row['roster_id'], $row['roster_name'],$row['number_of_players'],$row['sport_type'],$row['leader_id']);
                }
            } else {
                return null;
            }
        }

        return null; // If rosterID is empty
    }

    /**
     * @param $rosterID String used to get Roster from database.
     * @return string|null Sport type if roster exists, null otherwise
     */
    public function getSportType($rosterID)
    {
        if (!empty($rosterID)){
            $roster = $this->getRosterByRosterId($rosterID);
            if (is_null($roster)){
                return null;
            } else {
                return $roster->getSportType();
            }
        }

        return null;
    }

} // End of RosterRepository class.