<?php

require_once '../../Repositories/ExperienceRepository.php';
require_once '../../Models/Experience.php';

class ExperienceController {
    private $experienceRepository;

    public function __construct() {
        $this->experienceRepository = new ExperienceRepository();
    }

    public function addExperience($userId, $workAt, $fromYear, $toYear, $description) {
        $experience = new Experience();
        $experience->setUserId($userId);
        $experience->setWorkAt($workAt);
        $experience->setFromYear($fromYear);
        $experience->setToYear($toYear);
        $experience->setDescription($description);
        return $this->experienceRepository->addExperienceQuery($experience);
    }

    public function updateExperience($id, $userId, $workAt, $fromYear, $toYear, $description) {
        $experience = new Experience();
        $experience->setId($id);
        $experience->setUserId($userId);
        $experience->setWorkAt($workAt);
        $experience->setFromYear($fromYear);
        $experience->setToYear($toYear);
        $experience->setDescription($description);
        return $this->experienceRepository->updateExperienceQuery($experience);
    }

    public function deleteExperience($id, $userId) {
        return $this->experienceRepository->deleteExperienceQuery($id, $userId);
    }

    public function getUserExperience($userId) {
        return $this->experienceRepository->getUserExperienceQuery($userId);
    }

    public function getExperienceById($id, $userId) {
        return $this->experienceRepository->getExperienceByIdQuery($id, $userId);
    }
}

?> 