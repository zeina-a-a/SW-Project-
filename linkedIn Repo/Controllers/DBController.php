<?php
class DBController
{
    public $dbHost = "localhost";
    public $dbUser = "root";
    public $dbPassword = "";
    public $dbName = "linkedin";
    public $connection;


    public function __construct() {
        try {
            $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
            
            if ($this->connection->connect_error) {
                error_log("Database connection failed: " . $this->connection->connect_error);
                throw new Exception("Database connection failed: " . $this->connection->connect_error);
            }

        } catch (Exception $e) {
            error_log("Error in DBController: " . $e->getMessage());
            throw $e;
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function openConnection()
    {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->connection->connect_error) {
            echo "Error in Connection : " . $this->connection->connect_error;
            return false;
        } else {
            return true;
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            $this->connection->close();
        } else {
            echo "Conection is not Opened";
        }
    }

    public function select($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function insert($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $this->connection->insert_id;
        }
    }

    public function update($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return true;
        }
    }

    public function delete($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) 
        {
            echo "Error: " . mysqli_error($this->connection);
            return false;
        } 
        else 
        {
            return true;
        }
    }
}
?>