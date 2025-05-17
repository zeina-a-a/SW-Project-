<?php

require_once __DIR__ .'/../Models/Connection.php';

interface ISendConnectionRepository
{
    public function checkSendQuery($senderId, $receiverId);
    public function sendConnectionRequestQuery($senderId, $receiverId);
    // public function acceptConnectionRequestQuery($connectionId);
    public function acceptConnectionRequestQuery($connectionId) ;
    public function rejectConnectionRequestQuery($connectionId);
    public function getFriendsQuery($userId);
    public function getPendingConnectionsQuery($userId);
    public function getUsersExceptCurrentQuery($userId);
    public function removeConnectionQuery($connectionId);
}
?>