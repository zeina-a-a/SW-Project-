<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/event.php';

class EventController
{
    public $db;

    public function getAllEvents()
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "SELECT id, title, description, postedBy, userId FROM events ORDER BY id DESC";
            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function PublishEvent($event)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $event->userId = $_SESSION['userId'];
            $title = mysqli_real_escape_string($this->db->connection, $event->title);
            $description = mysqli_real_escape_string($this->db->connection, $event->description);
            $postedBy = mysqli_real_escape_string($this->db->connection, $event->postedBy);
            $userId = (int)$event->userId;
            $imagePath = $event->imagePath ? mysqli_real_escape_string($this->db->connection, $event->imagePath) : null;

            $query = "INSERT INTO events (title, description, postedBy, userId" . ($imagePath ? ", imagePath" : "") . ") 
                      VALUES ('$title', '$description', '$postedBy', $userId" . ($imagePath ? ", '$imagePath'" : "") . ")";

            return $this->db->insert($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getEvent($id)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "SELECT * FROM events WHERE id = $id";
            $result = $this->db->select($query);
            if ($result && count($result) > 0) {
                $event = new Event();
                $event->id = $result[0]['id'];
                $event->title = $result[0]['title'];
                $event->description = $result[0]['description'];
                $event->postedBy = $result[0]['postedBy'];
                $event->userId = $result[0]['userId'];
                $event->imagePath = $result[0]['imagePath'];
                return $event;
            }
            return false;
        }
        return false;
    }

    public function RequestEvent(Event $event)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "INSERT INTO eventRequests (userId, eventId)
                    VALUES ($event->userId, '$event->id')";
            $result = $this->db->insert($query);
            return $result ? 1 : 0;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function editEvent($event)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $title = mysqli_real_escape_string($this->db->connection, $event->title);
            $description = mysqli_real_escape_string($this->db->connection, $event->description);
            $postedBy = mysqli_real_escape_string($this->db->connection, $event->postedBy);
            $id = (int)$event->id;

            $query = "UPDATE events SET title = '$title', description = '$description', postedBy = '$postedBy' WHERE id = $id";
            $result = $this->db->update($query);
            return $result;
        }
        return false;
    }

    public function deleteEvent($id)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "DELETE FROM events WHERE id = $id";
            $result = $this->db->delete($query);
            return $result !== false;
        }
        return false;
    }
}