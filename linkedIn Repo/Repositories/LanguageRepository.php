<?php
require_once 'BaseRepository.php';
require_once '../../Models/Language.php';

class LanguageRepository extends BaseRepository implements ILanguageRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function addLanguageQuery($language)
    {
        $query = "INSERT INTO languages (user_id, language_name) 
                 VALUES ('{$language->getUserId()}', '{$language->getLanguageName()}')";
        return $this->insert($query);
    }

    public function updateLanguageQuery($language)
    {
        $query = "UPDATE languages 
                 SET language_name = '{$language->getLanguageName()}'
                 WHERE id = '{$language->getId()}' AND user_id = '{$language->getUserId()}'";
        return $this->update($query);
    }

    public function deleteLanguageQuery($id, $userId)
    {
        $query = "DELETE FROM languages WHERE id = '$id' AND user_id = '$userId'";
        return $this->delete($query);
    }

    public function getUserLanguagesQuery($userId)
    {
        $query = "SELECT * FROM languages WHERE user_id = '$userId' ORDER BY language_name ASC";
        return $this->select($query);
    }

    public function getLanguageByIdQuery($id, $userId)
    {
        $query = "SELECT * FROM languages WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->select($query);
        if ($result) {
            $language = new Language();
            $language->setId($result[0]['id']);
            $language->setUserId($result[0]['user_id']);
            $language->setLanguageName($result[0]['language_name']);
            return $language;
        }
        return null;
    }
}
?>