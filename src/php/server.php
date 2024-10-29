<?php

class ServerManager {
    private $serverName;
    private $hostServer; // Es: localhost (12.0.0.1) or public ip
    private $serverPort; // Es: 80, 443
    private $adminEmail;
    private $dbConnection;

    // Constructor to set the properties and get the database connection
    public function __construct($serverName, $hostServer, $serverPort, $adminEmail, $dbHost, $dbUser, $dbPassword, $dbName) {
        $this->serverName = $serverName;
        $this->serverPort = $serverPort;
        $this->adminEmail = $adminEmail;

        // Create a new instance of the DatabaseManager class
        $this->dbConnection = DatabaseManager::getInstance($dbHost, $dbUser, $dbPassword, $dbName);
    }

    public isConnected() {
        if ($this->dbConnection->getConnection()) {
            return true;
        }
        return false;
    }

    // Method to execute a select query and return the result
    public function executeSelectQuery($query, $params = []) {
        return $this->dbConnection->executeSelectQuery($query, $params);
    }

    // MNethod to execute a query and return the result
    public function executeQuery($query, $params = []) {
        return $this->dbConnection->executeQuery($query, $params);
    }

    // Method to close the database connection
    public function closeConnection() {
        $this->dbConnection->closeConnection();
    }

    // Method to get the server information
    public function getServerInfo() {
        return [
            'serverName' => $this->serverName.
            'hostServer' => $this->hostServer,
            'serverPort' => $this->serverPort,
            'adminEmail' => $this->adminEmail,
            // Return the database connection info
            'dbConnection' => $this->dbConnection->getDatabaseInfo()
        ];
    }

    // Destructor to close the database connection
    public function __destruct() {
        $this->closeConnection();
    }
}
