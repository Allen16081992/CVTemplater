<?php
    require "idb.config.php";

    class getResume {
        private $database;
    
        public function __construct()
        {
            $this->database = new Database(); // <-- Dhr. A Pieter: Dit was nodig want Resume werkte niet meer.
        }

        public function getResumeTitlesForUser($userID) {
            $connection = $this->database->connect(); // Get the database connection
        
            $sql = $connection->prepare("SELECT resumetitle FROM resume WHERE userID = :userID");
            $sql->bindParam(":userID", $userID);
            $sql->execute();
        
            $resumeTitles = $sql->fetchAll(PDO::FETCH_COLUMN);
            return $resumeTitles;
        }
    }
?>