<?php

require_once '../../Models/Language.php';

interface ILanguageRepository
{
    public function getAll();
    public function findById($id);
    public function create($userId, $languageName);
    public function update($id, $userId, $languageName);
    public function delete($id);
    public function getLanguagesByUserId($userId);
}