<?php
require_once __DIR__ . '/../Repositories/SearchRepository.php';

class SearchController {
    private $searchRepository;

    public function __construct() {
        $this->searchRepository = new SearchRepository();
    }

    public function searchUsers($username) {
        if (empty($username)) {
            return [];
        }
        return $this->searchRepository->searchUsers($username);
    }
} 