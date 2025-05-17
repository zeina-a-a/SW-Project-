<?php

//require_once '../../Models/User.php';
require_once __DIR__ . '/../Models/User.php';
//require_once '../../Models/Connection.php';
require_once __DIR__ . '/../Models/Connection.php';
require_once __DIR__ .'/../Repositories/SendConnectionRepository.php';
require_once __DIR__ .'/../IRepositories/ISendConnectionRepository.php';



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

    public ISendConnectionRepository $_sendConnectionRepository;
    public function __construct()
    {
        $this->_sendConnectionRepository = new SendConnectionRepository();
    }

    public function sendConnectionRequest($senderId, $receiverId) {


        $result =$this->_sendConnectionRepository->checkSendQuery($senderId,$receiverId);

        if (!$result) {
            return false;
        } else {
            $result = $this->_sendConnectionRepository->sendConnectionRequestQuery($senderId,$receiverId);
            return true;
        }
    
    }

    public function acceptConnectionRequest($connectionId) {
        $userId = $_SESSION['userId'];
        $result =  $this->_sendConnectionRepository->acceptConnectionRequestQuery($connectionId);
        if(!$result){
            return false;
        }
        return true; 
    }

    public function rejectConnectionRequest($connectionId) {
        return $this->_sendConnectionRepository->rejectConnectionRequestQuery($connectionId);
    }

    public function getFriends($userId) {
        return $this->_sendConnectionRepository->getFriendsQuery($userId);
    }

    public function getPendingConnections($userId) {
        return $this->_sendConnectionRepository->getPendingConnectionsQuery($userId);
    }   

    public function getUsersExceptCurrent($userId) {
        return $this->_sendConnectionRepository->getUsersExceptCurrentQuery($userId);
    }

    public function removeConnection($connectionId) {
        return $this->_sendConnectionRepository->removeConnectionQuery($connectionId);
    }
} 

?>