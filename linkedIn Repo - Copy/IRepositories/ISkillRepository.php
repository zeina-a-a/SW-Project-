<?php

require_once '../../Models/Skill.php';

interface ISkillRepository
{
    public function addSkillQuery( $skill);
    public function updateSkillQuery( $skill);
    public function deleteSkillQuery($id, $userId);
    public function getUserSkillsQuery($userId);
    public function getSkillByIdQuery($id, $userId);
}