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

    public function addLanguageQuery(Language $language)
    {
        $query = "INSERT INTO languages (user_id, language_name) 
                 VALUES ('$language->userId', '$language->languageName')";
        return $this->insert($query);
    }

    public function updateLanguageQuery(Language $language)
    {
        $query = "UPDATE languages 
                 SET language_name = '$language->languageName'
                 WHERE id = '$language->id' AND user_id = '$language->userId'";
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
            $language->id = $result[0]['id'];
            $language->userId = $result[0]['user_id'];
            $language->languageName = $result[0]['language_name'];
            return $language;
        }
        return null;
    }
}
?>