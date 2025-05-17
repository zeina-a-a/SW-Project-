<?php

require_once '../../Repositories/EventRepository.php';
require_once '../../Models/Event.php';

class EventController
{
    private $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }

    public function getAllEvents()
    {
        return $this->eventRepository->getAllEventsQuery();
    }

    public function PublishEvent($event)
    {
        $event->setUserId($_SESSION['userId']);
        return $this->eventRepository->publishEventQuery($event);
    }

    public function getEvent($id)
    {
        return $this->eventRepository->getEventQuery($id);
    }

    public function RequestEvent(Event $event)
    {
        return $this->eventRepository->requestEventQuery($event->getUserId(), $event->getId());
    }

    public function editEvent($event)
    {
        return $this->eventRepository->editEventQuery($event);
    }

    public function deleteEvent($id)
    {
        return $this->eventRepository->deleteEventQuery($id);
    }

    public function getJoinedEventIdsByUser($userId)
    {
        return $this->eventRepository->getJoinedEventIdsByUser($userId);
    }
}