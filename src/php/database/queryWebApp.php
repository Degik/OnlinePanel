<?php

class QueryBuilderWebApp {
    // SELECT CONSTANTS
    public const SELECT_USER_BY_USERNAME = "SELECT * FROM users WHERE username = ?";
    public const SELECT_ALL_USERS = "SELECT * FROM users";
    public const SELECT_USER_BY_EMAIL = "SELECT * FROM users WHERE email = ?";
    
    // CCONSTANTS FOR INSERT
    public const INSERT_NEW_USER = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    
    // CONST FOR UPDATE
    public const UPDATE_USER_PASSWORD = "UPDATE users SET password = ? WHERE username = ?";
    public const UPDATE_USER_EMAIL = "UPDATE users SET email = ? WHERE username = ?";
    
    // CONSTANTS FOR DELETE
    public const DELETE_USER_BY_USERNAME = "DELETE FROM users WHERE username = ?";
    
    //
    public static function getAllQueries() {
        return [
            'SELECT_USER_BY_USERNAME' => self::SELECT_USER_BY_USERNAME,
            'SELECT_ALL_USERS' => self::SELECT_ALL_USERS,
            'SELECT_USER_BY_EMAIL' => self::SELECT_USER_BY_EMAIL,
            'INSERT_NEW_USER' => self::INSERT_NEW_USER,
            'UPDATE_USER_PASSWORD' => self::UPDATE_USER_PASSWORD,
            'UPDATE_USER_EMAIL' => self::UPDATE_USER_EMAIL,
            'DELETE_USER_BY_USERNAME' => self::DELETE_USER_BY_USERNAME
        ];
    }

    // Take a query and return the query with the parameters
    public static function getSelectUsersByStatusQuery($status) {
        return "SELECT * FROM users WHERE status = '" . self::sanitize($status) . "'";
    }

    // To safe the input (SQL injection)
    private static function sanitize($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }
}
