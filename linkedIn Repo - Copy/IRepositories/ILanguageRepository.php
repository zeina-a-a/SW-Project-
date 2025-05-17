<?php

require_once '../../Models/Language.php';

interface ILanguageRepository
{
    public function addLanguageQuery( $language);
    public function updateLanguageQuery( $language);
    public function deleteLanguageQuery($id, $userId);
    public function getUserLanguagesQuery($userId);
    public function getLanguageByIdQuery($id, $userId);
}