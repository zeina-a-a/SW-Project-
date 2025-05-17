<?php
require_once __DIR__ . '/../IRepositories/ISearchRepository.php';
require_once __DIR__ . '/BaseRepository.php';

class SearchRepository extends BaseRepository implements ISearchRepository {
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function searchUsers($username) {
        $username = trim($username);
        $search = "%$username%";
        $query = "SELECT * FROM users WHERE username LIKE '$search'";
        $result = $this->connection->query($query);
        if (!$result) {
            error_log('MySQL Error: ' . $this->connection->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
} 