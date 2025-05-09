<?php

require_once '../../Models/Experience.php';

interface IExperienceRepository
{
    public function getAll();
    public function findById($id);
    public function create($userId, $workAt, $fromYear, $toYear, $description);
    public function update($id, $userId, $workAt, $fromYear, $toYear, $description);
    public function delete($id);
    public function getExperienceByUserId($userId);
    public function getExperienceByCompany($workAt);
    public function getExperienceByPosition($description);
}