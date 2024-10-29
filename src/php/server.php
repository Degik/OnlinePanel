<?php

class Server {
    // Server properties
    private $serverName;
    private $serverPort;
    private $adminEmail;

    // Database properties
    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbName;
    private $connection;

    // Create a new server object and connect to the database
    public function __construct($serverName, $serverPort, $adminEmail, $dbHost, $dbUser, $dbPassword, $dbName) {
        // Server info
        $this->serverName = $serverName;
        $this->serverPort = $serverPort;
        $this->adminEmail = $adminEmail;
        
        // Database info
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
    }

    // Connect to the database
    private function connectToDatabase() {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

        if ($this->connection->connect_error) {
            die("Error to connect to database: " . $this->connection->connect_error);
        }
    }

    // Close the connection
    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    // Metodo per eseguire una query di selezione
    public function executeSelectQuery($query, $params = []) {
        $stmt = $this->connection->prepare($query);

        if (!empty($params)) {
            // Costruire i tipi di parametri dinamicamente
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Execute a query that doesn't return a result
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

    //Get server info
    public function getServerInfo() {
        return [
            'serverName' => $this->serverName,
            'serverPort' => $this->serverPort,
            'adminEmail' => $this->adminEmail
        ];
    }

    // Return true if the connection is active
    public function isConnect() {
        if($this->connection){
            return true;
        } else {
            return false;
        }
    }

    // Set error message
    public function setError($message) {
        error_log("Errore sul server: " . $message);
    }

    // Destructor to close the connection
    public function __destruct() {
        $this->closeConnection();
    }
}

