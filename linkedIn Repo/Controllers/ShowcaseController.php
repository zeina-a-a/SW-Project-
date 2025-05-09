<?php

require_once '../../Controllers/DBController.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/showcasepage.php';
require_once '../../Repositories/ShowcaseRepository.php';
require_once '../../IRepositories/IShowcaseRepository.php';

class ShowcaseController
{
    public IShowcaseRepository $_showcaseRepository;

    public function __construct()
    {
        $this->_showcaseRepository = new ShowcaseRepository();
    }

    public function getAllShowcasePages()
    {
        $result = $this->_showcaseRepository->getAllShowcasePagesQuery();
        return $result;
    }

    public function addShowcasePage($showcasePage)
    {

        $mediaPath = AddMedia::upload('logo');
        // Initialize imagePath to NULL by default
        $showcasePage->setImagePath(NULL);

        if ($mediaPath !== null) {  // File was uploaded
            if ($mediaPath === false) {  // Upload failed
                $errorMsg = "Error in media file upload.";
            } else {  // Upload successful
                $showcasePage->setImagePath($mediaPath);
            }
        }
        $showcasePage->setUserId($_SESSION['userId']);
        $result = $this->_showcaseRepository->addShowcasePageQuery($showcasePage);
        if ($result) {
            header("Location: ../../Views/home/index.php");
            exit();
        }
        return $result;
    }

    public function getShowcasePage($id)
    {

        $result = $this->_showcaseRepository->getShowcasePageQuery($id);

        if ($result === false) {
            return false;
        }
        if (count($result) > 0) {
            $showcasePage = new ShowcasePage();
            $showcasePage->setId($result[0]['id']);
            $showcasePage->setTitle($result[0]['title']);
            $showcasePage->setBody($result[0]['body']);
            $showcasePage->setWebsite($result[0]['website']);
            $showcasePage->setIndustry($result[0]['industry']);
            $showcasePage->setImagePath($result[0]['imagePath']);
            $showcasePage->setUserId($result[0]['userId']);
            return $showcasePage;
        }
        return false;
    }

    public function getShowcasePageByUserId($userId)
    {

        $result = $this->_showcaseRepository->getShowcasePageByUserIdQuery($userId);
        if ($result && count($result) > 0) {
            $showcasePage = new ShowcasePage();
            $showcasePage->setId($result[0]['id']);
            $showcasePage->setTitle($result[0]['title']);
            $showcasePage->setBody($result[0]['body']);
            $showcasePage->setWebsite($result[0]['website']);
            $showcasePage->setIndustry($result[0]['industry']);
            $showcasePage->setImagePath(isset($result[0]['imagePath']) ? $result[0]['imagePath'] : NULL);
            $showcasePage->setUserId($result[0]['userId']);
            return $showcasePage;
        }
        return false;
    }
}
