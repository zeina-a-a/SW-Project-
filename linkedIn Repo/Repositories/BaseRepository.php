<?php 

require_once '../../Database/Database.php';
require_once '../../IRepositories/IBaseRepository.php';

abstract class BaseRepository implements IBaseRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
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