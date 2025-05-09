<?php

require_once '../../Models/Skill.php';

interface ISkillRepository
{
    public function getAll();
    public function findById($id);
    public function create($userId, $skillName);
    public function update($id, $userId, $skillName);
    public function delete($id);
    public function getSkillsByUserId($userId);
}