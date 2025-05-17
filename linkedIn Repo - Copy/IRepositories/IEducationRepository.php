<?php

require_once '../../Models/Education.php';

interface IEducationRepository
{
    public function addEducationQuery( $education);
    public function updateEducationQuery( $education);
    public function deleteEducationQuery($id, $userId);
    public function getUserEducationQuery($userId);
    public function getEducationByIdQuery($id, $userId);
}