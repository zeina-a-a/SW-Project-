<?php

require_once 'BaseRepository.php';
require_once __DIR__ .'/../IRepositories/ISendConnectionRepository.php';

// require_once '../../Models/User.php';
require_once __DIR__ . '../../Models/User.php';
// require_once '../../Models/Connection.php';
require_once __DIR__ . '../../Models/Connection.php';


class SendConnectionRepository extends BaseRepository implements ISendConnectionRepository
{

    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function checkSendQuery($senderId, $receiverId){

        $checkQuery = "SELECT * FROM connections 
                            WHERE (senderId = '$senderId' AND receiverId = '$receiverId')
                            OR (senderId = '$receiverId' AND receiverId = '$senderId')";
            $existing = $this->select($checkQuery);
            
            if (!empty($existing)) {
                return false; // Connection already exists
            }
            return true;
    }

    public function sendConnectionRequestQuery($senderId, $receiverId) {

        $query = "INSERT INTO connections (senderId, receiverId, status ,sentAt) 
                VALUES ('$senderId', '$receiverId', 'Pending' , now())";
        $result= $this->insert($query);
        if($result === false){
                return false;
            }else{
                return $result;
            }
    }

    public function acceptConnectionRequestQuery($connectionId) {
        $query = "UPDATE connections SET status = 'Accepted' 
                WHERE connectionId = '$connectionId' AND status = 'Pending'";
        $query2 =  "
        UPDATE users
        SET connectionCount = connectionCount + 1
        WHERE id IN (
            SELECT senderId FROM connections WHERE connectionId = $connectionId
            UNION
            SELECT receiverId FROM connections WHERE connectionId = $connectionId
        )
    ";
        $this->update($query2);
        return $this->update($query);
    }

    public function rejectConnectionRequestQuery($connectionId) {
        $query = "UPDATE connections SET status = 'Rejected' 
                WHERE connectionId = '$connectionId' AND status = 'Pending'";
        return $this->update($query); 
    }

    public function getFriendsQuery($userId) {
            $query = "SELECT u.*, c.connectionId as connection_id 
                    FROM users u 
                    INNER JOIN connections c ON (c.senderId = u.id OR c.receiverId = u.id)
                    WHERE (c.senderId = '$userId' OR c.receiverId = '$userId')
                    AND c.status = 'Accepted'
                    AND u.id != '$userId'";
            return $this->select($query);
    }

    public function getPendingConnectionsQuery($userId) {
            $query = "SELECT u.*, c.connectionId as connection_id 
                    FROM users u 
                    INNER JOIN connections c ON c.senderId = u.id
                    WHERE c.receiverId = '$userId' 
                    AND c.status = 'Pending'";
            return $this->select($query);
    }   

    public function getUsersExceptCurrentQuery($userId) {
            $query = "SELECT u.* FROM users u 
                    WHERE u.id != '$userId' 
                    AND u.id NOT IN (
                        SELECT CASE 
                            WHEN senderId = '$userId' THEN receiverId 
                            ELSE senderId 
                        END 
                        FROM connections 
                        WHERE (senderId = '$userId' OR receiverId = '$userId')
                        AND status = 'Accepted'
                    )";
            return $this->select($query);
    }

    public function removeConnectionQuery($connectionId) {
        $query = "DELETE FROM connections WHERE connectionId = '$connectionId'";
        return $this->delete($query);
    }
} 


?>