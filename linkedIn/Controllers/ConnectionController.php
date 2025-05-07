<?php

require_once 'DBController.php';
require_once '../../Models/Connection.php';


class ConnectionController
{
    protected $db;
    public function __construct()
    {
        $this->db = new DBController();
        $this->db->openConnection();
    }

    public function getUserConnections($userId)
    {
        $this->db = new DBController();

        if ($this->db->openConnection()) {

            $query = "SELECT connections.connectionId, users.username, users.email FROM users join connections on users.id = connections.senderId 
        where connections.receiverId = $userId ";
            return $this->db->select($query);
        } else {
            echo "Error connecting to database.";
            return [];
        }
    }


}
