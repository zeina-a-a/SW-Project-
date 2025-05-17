<?php

require_once '../../Repositories/SkillRepository.php';
require_once '../../Models/Skill.php';

class SkillController {
    private $skillRepository;

    public function __construct() {
        $this->skillRepository = new SkillRepository();
    }

    public function addSkill($userId, $skillName) {
        $skill = new Skill();
        $skill->setUserId($userId);
        $skill->setSkillName($skillName);
        return $this->skillRepository->addSkillQuery($skill);
    }

    public function updateSkill($id, $userId, $skillName) {
        $skill = new Skill();
        $skill->setId($id);
        $skill->setUserId($userId);
        $skill->setSkillName($skillName);
        return $this->skillRepository->updateSkillQuery($skill);
    }

    public function deleteSkill($id, $userId) {
        return $this->skillRepository->deleteSkillQuery($id, $userId);
    }

    public function getUserSkills($userId) {
        return $this->skillRepository->getUserSkillsQuery($userId);
    }

    public function getSkillById($id, $userId) {
        return $this->skillRepository->getSkillByIdQuery($id, $userId);
    }
}

?> 