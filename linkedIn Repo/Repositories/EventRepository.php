<?php
require_once 'BaseRepository.php';
require_once '../../Models/Event.php';
require_once '../../IRepositories/IEventRepository.php';

class EventRepository extends BaseRepository implements IEventRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllEventsQuery()
    {
        $query = "SELECT id, title, description, postedBy, userId FROM events ORDER BY id DESC";
        return $this->select($query);
    }

    public function publishEventQuery($event)
    {
        $query = "INSERT INTO events (title, description, postedBy, userId" . 
                ($event->getImagePath() ? ", imagePath" : "") . ") 
                VALUES (
                    '{$event->getTitle()}',
                    '{$event->getDescription()}',
                    '{$event->getPostedBy()}',
                    {$event->getUserId()}" .
                    ($event->getImagePath() ? ", '{$event->getImagePath()}'" : "") . 
                ")";
        return $this->insert($query);
    }

    public function getEventQuery($id)
    {
        $query = "SELECT * FROM events WHERE id = $id";
        $result = $this->select($query);
        if ($result && count($result) > 0) {
            $event = new Event();
            $event->setId($result[0]['id']);
            $event->setTitle($result[0]['title']);
            $event->setDescription($result[0]['description']);
            $event->setPostedBy($result[0]['postedBy']);
            $event->setUserId($result[0]['userId']);
            $event->setImagePath($result[0]['imagePath']);
            return $event;
        }
        return false;
    }

    public function requestEventQuery($userId, $eventId)
    {
        $query = "INSERT INTO eventRequests (userId, eventId) VALUES ($userId, $eventId)";
        return $this->insert($query);
    }

    public function editEventQuery($event)
    {
        $query = "UPDATE events 
                 SET title = '{$event->getTitle()}', 
                     description = '{$event->getDescription()}', 
                     postedBy = '{$event->getPostedBy()}' 
                 WHERE id = {$event->getId()}";
        return $this->update($query);
    }

    public function deleteEventQuery($id)
    {
        $query = "DELETE FROM events WHERE id = $id";
        return $this->delete($query);
    }

    public function getJoinedEventIdsByUser($userId)
    {
        $query = "SELECT eventId FROM eventRequests WHERE userId = $userId";
        return $this->select($query);
    }
}
?> 