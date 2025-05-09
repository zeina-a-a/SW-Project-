<?php
require_once 'DBController.php';
// require_once '../../Models/User.php';
require_once __DIR__ . '/../Models/User.php';
// require_once '../../Models/Connection.php';
require_once __DIR__ . '/../Models/Connection.php';



// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $sendController = new SendController();
    $userId = $_SESSION['userId'];

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'send':
                if (isset($_POST['to'])) {
                    $result = $sendController->sendConnectionRequest($userId, $_POST['to']);
                    header("Location: ../Views/Timeline/timeline-friends.php?message=" . urlencode($result ? "Connection request sent successfully!" : "Failed to send connection request."));
                    exit;
                }
                break;

            case 'accept':
                if (isset($_POST['connectionId'])) {
                    $result = $sendController->acceptConnectionRequest($_POST['connectionId']);
                    header("Location: ../Views/Timeline/timeline-friends.php?message=" . urlencode($result ? "Connection request accepted!" : "Failed to accept connection request."));
                    exit;
                }
                break;

            case 'reject':
                if (isset($_POST['connectionId'])) {
                    $result = $sendController->rejectConnectionRequest($_POST['connectionId']);
                    header("Location: ../Views/Timeline/timeline-friends.php?message=" . urlencode($result ? "Connection request rejected!" : "Failed to reject connection request."));
                    exit;
                }
                break;

            case 'remove':
                if (isset($_POST['connectionId'])) {
                    $result = $sendController->removeConnection($_POST['connectionId']);
                    header("Location: ../Views/Timeline/timeline-friends.php?message=" . urlencode($result ? "Connection removed!" : "Failed to remove connection."));
                    exit;
                }
                break;
        }
    }
}

class SendController {
    private $dbController;
    private $userModel;
    private $connectionModel;

    public function __construct() {
        $this->dbController = new DBController();
        $this->userModel = new User();
        $this->connectionModel = new Connection();
    }

    public function sendConnectionRequest($senderId, $receiverId) {
        // Check if connection already exists
        if ($this->dbController->openConnection()) {
            $checkQuery = "SELECT * FROM connections 
                            WHERE (senderId = '$senderId' AND receiverId = '$receiverId')
                            OR (senderId = '$receiverId' AND receiverId = '$senderId')";
            $existing = $this->dbController->select($checkQuery);
            
            if (!empty($existing)) {
                return false; // Connection already exists
            }
        }

        $query = "INSERT INTO connections (senderId, receiverId, status ,sentAt) 
                VALUES ('$senderId', '$receiverId', 'Pending' , now())";
        return $this->dbController->insert($query);
    }

    public function acceptConnectionRequest($connectionId) {
        if (!$this->dbController->openConnection()) {
            return false;
        }
        $query = "UPDATE connections SET status = 'Accepted' 
                WHERE connectionId = '$connectionId' AND status = 'Pending'";
        return $this->dbController->update($query);
    }

    public function rejectConnectionRequest($connectionId) {
        if (!$this->dbController->openConnection()) {
            return false;
        }
        $query = "UPDATE connections SET status = 'Rejected' 
                WHERE connectionId = '$connectionId' AND status = 'Pending'";
        return $this->dbController->update($query); 
    }

    public function getFriends($userId) {
        if ($this->dbController->openConnection()) {
            $query = "SELECT u.*, c.connectionId as connection_id 
                    FROM users u 
                    INNER JOIN connections c ON (c.senderId = u.id OR c.receiverId = u.id)
                    WHERE (c.senderId = '$userId' OR c.receiverId = '$userId')
                    AND c.status = 'Accepted'
                    AND u.id != '$userId'";
            return $this->dbController->select($query);
        }
        return [];
    }

    public function getPendingConnections($userId) {
        if ($this->dbController->openConnection()) {
            $query = "SELECT u.*, c.connectionId as connection_id 
                    FROM users u 
                    INNER JOIN connections c ON c.senderId = u.id
                    WHERE c.receiverId = '$userId' 
                    AND c.status = 'Pending'";
            return $this->dbController->select($query);
        }
        return [];
    }   

    public function getUsersExceptCurrent($userId) {
        if ($this->dbController->openConnection()) {
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
            return $this->dbController->select($query);
        }
        return [];
    }

    public function removeConnection($connectionId) {
        if (!$this->dbController->openConnection()) {
            return false;
        }
        $query = "DELETE FROM connections WHERE connectionId = '$connectionId'";
        return $this->dbController->delete($query);
    }
} 