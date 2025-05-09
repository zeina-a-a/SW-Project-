<?php

require_once '../../Models/Education.php';

interface IEducationRepository
{
    public function getAll();
    public function findById($id);
    public function create($userId, $studyingAt, $fromYear, $toYear, $description);
    public function update($id, $userId, $studyingAt, $fromYear, $toYear, $description);
    public function delete($id);
    public function getEducationByUserId($userId);
    public function getEducationByInstitution($studyingAt);
}