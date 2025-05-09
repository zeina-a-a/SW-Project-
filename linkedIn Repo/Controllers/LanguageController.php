<?php

require_once '../../Repositories/LanguageRepository.php';
require_once '../../Models/Language.php';

class LanguageController {
    private $languageRepository;

    public function __construct() {
        $this->languageRepository = new LanguageRepository();
    }

    public function addLanguage($userId, $languageName) {
        $language = new Language();
        $language->userId = $userId;
        $language->languageName = $languageName;
        return $this->languageRepository->addLanguageQuery($language);
    }

    public function updateLanguage($id, $userId, $languageName) {
        $language = new Language();
        $language->id = $id;
        $language->userId = $userId;
        $language->languageName = $languageName;
        return $this->languageRepository->updateLanguageQuery($language);
    }

    public function deleteLanguage($id, $userId) {
        return $this->languageRepository->deleteLanguageQuery($id, $userId);
    }

    public function getUserLanguages($userId) {
        return $this->languageRepository->getUserLanguagesQuery($userId);
    }

    public function getLanguageById($id, $userId) {
        return $this->languageRepository->getLanguageByIdQuery($id, $userId);
    }
}

?> 