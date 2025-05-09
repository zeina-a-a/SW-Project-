<?php

require_once '../../Models/Experience.php';

interface IExperienceRepository
{
    public function addExperienceQuery( $experience);
    public function updateExperienceQuery( $experience);
    public function deleteExperienceQuery($id, $userId);
    public function getUserExperienceQuery($userId);
    public function getExperienceByIdQuery($id, $userId);
}