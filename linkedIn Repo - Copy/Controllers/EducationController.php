<?php

require_once '../../Repositories/EducationRepository.php';
require_once '../../Models/Education.php';

class EducationController {
    private $educationRepository;

    public function __construct() {
        $this->educationRepository = new EducationRepository();
    }

    public function addEducation($userId, $studyingAt, $fromYear, $toYear, $description) {
        $education = new Education();
        $education->setUserId($userId);
        $education->setStudyingAt($studyingAt);
        $education->setFromYear($fromYear);
        $education->setToYear($toYear);
        $education->setDescription($description);
        return $this->educationRepository->addEducationQuery($education);
    }

    public function updateEducation($id, $userId, $studyingAt, $fromYear, $toYear, $description) {
        $education = new Education();
        $education->setId($id);
        $education->setUserId($userId);
        $education->setStudyingAt($studyingAt);
        $education->setFromYear($fromYear);
        $education->setToYear($toYear);
        $education->setDescription($description);
        return $this->educationRepository->updateEducationQuery($education);
    }

    public function deleteEducation($id, $userId) {
        return $this->educationRepository->deleteEducationQuery($id, $userId);
    }

    public function getUserEducation($userId) {
        return $this->educationRepository->getUserEducationQuery($userId);
    }

    public function getEducationById($id, $userId) {
        return $this->educationRepository->getEducationByIdQuery($id, $userId);
    }
}

?> 