<?php

require_once '../../Repositories/ConnectionRepository.php';
require_once '../../IRepositories/IConnectionRepository.php';
require_once '../../Models/Connection.php';


class ConnectionController
{
    public IConnectionRepository $_connectionRepository;

    public function __construct()
    {
        $this->_connectionRepository = new ConnectionRepository();
    }

    public function getUserConnections($userId)
    {
        
            return $this->_connectionRepository->getUserConnectionsQuery($userId);
        
    }

}


?>