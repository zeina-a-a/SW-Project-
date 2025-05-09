<?php

require_once 'BaseRepository.php';
require_once '../../Models/Connection.php';
require_once '../../IRepositories/IConnectionRepository.php';
class ConnectionRepository extends BaseRepository implements IConnectionRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getUserConnectionsQuery($userId)
    {
        $query = "SELECT connections.connectionId, users.username, users.email FROM users join connections on users.id = connections.senderId 
        where connections.receiverId = $userId ";
        $result = $this->select($query);
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }
}
?>