<?php

class AltisLifeQueryBuilder {
    // Query for the `players` table
    public const SELECT_PLAYER_BY_PID = "SELECT * FROM players WHERE pid = ?";
    public const INSERT_NEW_PLAYER = "INSERT INTO players (pid, name, cash, bankacc, coplevel, mediclevel, civ_alive) VALUES (?, ?, ?, ?, ?, ?, ?)";
    public const UPDATE_PLAYER_CASH = "UPDATE players SET cash = ? WHERE pid = ?";
    public const DELETE_PLAYER_BY_PID = "DELETE FROM players WHERE pid = ?";

    // Query for the `vehicles` table
    public const SELECT_VEHICLES_BY_PLAYER = "SELECT * FROM vehicles WHERE pid = ?";
    public const INSERT_NEW_VEHICLE = "INSERT INTO vehicles (pid, side, classname, type, plate, color) VALUES (?, ?, ?, ?, ?, ?)";
    public const UPDATE_VEHICLE_STATUS = "UPDATE vehicles SET alive = ?, active = ? WHERE id = ?";
    public const DELETE_DEAD_VEHICLES = "DELETE FROM vehicles WHERE alive = 0";

    // Query for the `wanted` table
    public const SELECT_WANTED_BY_NAME = "SELECT * FROM wanted WHERE wantedName = ?";
    public const INSERT_WANTED_PERSON = "INSERT INTO wanted (wantedID, wantedName, wantedCrimes, wantedBounty, active) VALUES (?, ?, ?, ?, ?)";
    public const UPDATE_WANTED_BOUNTY = "UPDATE wanted SET wantedBounty = ? WHERE wantedID = ?";
    public const DELETE_INACTIVE_WANTED = "DELETE FROM wanted WHERE active = 0";

    // Query for the `containers` table
    public const SELECT_CONTAINER_BY_OWNER = "SELECT * FROM containers WHERE pid = ?";
    public const INSERT_NEW_CONTAINER = "INSERT INTO containers (pid, classname, inventory, gear) VALUES (?, ?, ?, ?)";
    public const UPDATE_CONTAINER_STATUS = "UPDATE containers SET active = ?, owned = ? WHERE id = ?";
    public const DELETE_UNOWNED_CONTAINERS = "DELETE FROM containers WHERE owned = 0";

    // Query for the `gangs` table
    public const SELECT_GANG_BY_OWNER = "SELECT * FROM gangs WHERE owner = ?";
    public const INSERT_NEW_GANG = "INSERT INTO gangs (owner, name, members, bank) VALUES (?, ?, ?, ?)";
    public const UPDATE_GANG_BANK = "UPDATE gangs SET bank = ? WHERE id = ?";
    public const DELETE_INACTIVE_GANGS = "DELETE FROM gangs WHERE active = 0";

    // Query for the `houses` table
    public const SELECT_HOUSE_BY_OWNER = "SELECT * FROM houses WHERE pid = ?";
    public const INSERT_NEW_HOUSE = "INSERT INTO houses (pid, pos, owned, garage) VALUES (?, ?, ?, ?)";
    public const UPDATE_HOUSE_OWNERSHIP = "UPDATE houses SET owned = ? WHERE id = ?";
    public const DELETE_UNOWNED_HOUSES = "DELETE FROM houses WHERE owned = 0";

    // Query for the `interpol` table (Only for the programmer script)
    public const SELECT_INTERPOL_RECORD = "SELECT * FROM interpol WHERE nom = ? AND prenom = ?";
    public const INSERT_INTERPOL_RECORD = "INSERT INTO interpol (prenom, nom, naissance, adresse, ville, yeux, details) VALUES (?, ?, ?, ?, ?, ?, ?)";
    public const DELETE_INTERPOL_RECORD = "DELETE FROM interpol WHERE id = ?";

    // Query for the `players` table (dynamic queries)
    public static function getSelectPlayersWithCashAbove($amount) {
        return "SELECT * FROM players WHERE cash > " . intval($amount);
    }

    // Query for the `vehicles` table (dynamic queries)
    public static function getSelectVehiclesByType($type) {
        return "SELECT * FROM vehicles WHERE type = '" . self::sanitize($type) . "'";
    }

    // Query for the `wanted` table (dynamic queries)
    private static function sanitize($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    // Method to get all the queries
    public static function getAllQueries() {
        return [
            'SELECT_PLAYER_BY_PID' => self::SELECT_PLAYER_BY_PID,
            'INSERT_NEW_PLAYER' => self::INSERT_NEW_PLAYER,
            'UPDATE_PLAYER_CASH' => self::UPDATE_PLAYER_CASH,
            'DELETE_PLAYER_BY_PID' => self::DELETE_PLAYER_BY_PID,
            'SELECT_VEHICLES_BY_PLAYER' => self::SELECT_VEHICLES_BY_PLAYER,
            'INSERT_NEW_VEHICLE' => self::INSERT_NEW_VEHICLE,
            'UPDATE_VEHICLE_STATUS' => self::UPDATE_VEHICLE_STATUS,
            'DELETE_DEAD_VEHICLES' => self::DELETE_DEAD_VEHICLES,
            'SELECT_WANTED_BY_NAME' => self::SELECT_WANTED_BY_NAME,
            'INSERT_WANTED_PERSON' => self::INSERT_WANTED_PERSON,
            'UPDATE_WANTED_BOUNTY' => self::UPDATE_WANTED_BOUNTY,
            'DELETE_INACTIVE_WANTED' => self::DELETE_INACTIVE_WANTED,
            'SELECT_CONTAINER_BY_OWNER' => self::SELECT_CONTAINER_BY_OWNER,
            'INSERT_NEW_CONTAINER' => self::INSERT_NEW_CONTAINER,
            'UPDATE_CONTAINER_STATUS' => self::UPDATE_CONTAINER_STATUS,
            'DELETE_UNOWNED_CONTAINERS' => self::DELETE_UNOWNED_CONTAINERS,
            'SELECT_GANG_BY_OWNER' => self::SELECT_GANG_BY_OWNER,
            'INSERT_NEW_GANG' => self::INSERT_NEW_GANG,
            'UPDATE_GANG_BANK' => self::UPDATE_GANG_BANK,
            'DELETE_INACTIVE_GANGS' => self::DELETE_INACTIVE_GANGS,
            'SELECT_HOUSE_BY_OWNER' => self::SELECT_HOUSE_BY_OWNER,
            'INSERT_NEW_HOUSE' => self::INSERT_NEW_HOUSE,
            'UPDATE_HOUSE_OWNERSHIP' => self::UPDATE_HOUSE_OWNERSHIP,
            'DELETE_UNOWNED_HOUSES' => self::DELETE_UNOWNED_HOUSES,
            'SELECT_INTERPOL_RECORD' => self::SELECT_INTERPOL_RECORD,
            'INSERT_INTERPOL_RECORD' => self::INSERT_INTERPOL_RECORD,
            'DELETE_INTERPOL_RECORD' => self::DELETE_INTERPOL_RECORD
        ];
    }
}