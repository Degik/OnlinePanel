<?php

class DatabaseManager {
    private $host;
    private $user;
    private $password;
    private $database;
    private $connection;
    private static $instance;

    // Constructor to connect to the database and set the properties
    private function __construct($host, $user, $password, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    // Method used to connect to the database
    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection error to database: " . $this->connection->connect_error);
        }
    }

    //Static method to create an instance of the class
    public static function getInstance($host, $user, $password, $database) {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection($host, $user, $password, $database);
        }
        return self::$instance;
    }

    // Method to get the connection
    public function getConnection() {
        return $this->connection;
    }

    // Method to close the connection
    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
            self::$instance = null;
        }
    }

    // Method to execute a select query
    public function executeSelectQuery($query, $params = []) {
        $stmt = $this->connection->prepare($query);

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to execute a query (insert, update, delete)
    public function executeQuery($query, $params = []) {
        $stmt = $this->connection->prepare($query);

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows;
    }

    public function getDatabaseInfo() {
        return [
            'host' => $this->host,
            'user' => $this->user,
            'database' => $this->database
        ];
    }
}
