<?php
interface IEventRepository
{
    public function getAllEventsQuery();
    public function publishEventQuery($event);
    public function getEventQuery($id);
    public function requestEventQuery($userId, $eventId);
    public function editEventQuery($event);
    public function deleteEventQuery($id);
}
?> 