<?php // Khaqan
require_once '././Controller/errorhandlers.control.config.php';

class Skills
{
    private $database;
    private $interest;
    private $language;
    private $techtitle;
    private $resumeID;
    private $userID;
    use ErrorHandlers;

    public function __construct($interest, $language, $techtitle, $resumeID, $userID)
    {
        $this->database = new Database();
        $this->interest = $interest;
        $this->language = $language;
        $this->techtitle = $techtitle;
        $this->resumeID = $resumeID;
        $this->userID = $userID;
    }

    public function Createskills()
    {   // Dhr. Allen Pieter: New if. We can't let users save resume related data without creating a resume.
        if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {

            $connection = $this->database->connect();
            //$interest = $this->getInterest();
            //$language = $this->getLanguage();
            //$techtitle = $this->getTechtitle();

            $sqleen = $connection->prepare(
                "INSERT INTO interests (interest, resumeID, userID)
                 VALUES (:interest, :resumeID, :userID);"
            );
            $sqleen->bindParam(":interest", $this->interest);
            $sqleen->bindParam(":resumeID", $this->resumeID);
            $sqleen->bindParam(":userID", $this->userID);
            $sqleen->execute();

            $sqltwee = $connection->prepare(
                "INSERT INTO languages (language, resumeID, userID)
                 VALUES (:language, :resumeID, :userID);"
            );
            $sqltwee->bindParam(":language", $this->language);
            $sqltwee->bindParam(":resumeID", $this->resumeID);
            $sqltwee->bindParam(":userID", $this->userID);
            $sqltwee->execute();

            $sqldrie = $connection->prepare(
                "INSERT INTO technical(techtitle, resumeID, userID)
                 VALUES (:techtitle, :resumeID, :userID);"
            );
            $sqldrie->bindParam(":techtitle", $this->techtitle);
            $sqldrie->bindParam(":resumeID", $this->resumeID);
            $sqldrie->bindParam(":userID", $this->userID);           
            $sqldrie->execute();
        } else {
            // No resume selected.
            $_SESSION['error'] = 'You should create a resume first.';
            header('location: ../client.php');
            exit();                 
        }
    }

    public function Updateskills() {

        if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {

            $connection = $this->database->connect();

            $sqleen = $connection->prepare(
                "UPDATE `interests` SET `interest` = :interest WHERE resumeID = :resumeID AND userID = :userID;"
            );
            $sqleen->bindParam(":interest", $this->interest);
            $sqleen->bindParam(":resumeID", $this->resumeID);
            $sqleen->bindParam(":userID", $this->userID);
            $sqleen->execute();

            $sqltwee = $connection->prepare(
                "UPDATE `languages` SET `language` = :language WHERE resumeID = :resumeID AND userID = :userID;"
            );
            $sqltwee->bindParam(":language", $this->language);
            $sqltwee->bindParam(":resumeID", $this->resumeID);
            $sqltwee->bindParam(":userID", $this->userID);
            $sqltwee->execute();

            $sqldrie = $connection->prepare(
                "UPDATE `technical` SET `techtitle` = :techtitle WHERE resumeID = :resumeID AND userID = :userID;"
            );
            $sqldrie->bindParam(":techtitle", $this->techtitle);
            $sqldrie->bindParam(":resumeID", $this->resumeID);
            $sqldrie->bindParam(":userID", $this->userID);           
            $sqldrie->execute();
        } else {
            // No resume selected.
            $_SESSION['error'] = 'You should create a resume first.';
            header('location: ../client.php');
            exit();                 
        }
    }

    // Dhr. A Pieter: Error handler added.
    // Some checking on empty fields is preferred.
    public function verifySkills() {
        // Invoke validation.
        if(!$this->emptyInterest()) {
            // No interest provided.
            $_SESSION['error'] = 'Please fill in your interest.';
            header('location: ../client.php');
            exit();
        } elseif(!$this->emptyLanguage()) {
            // No language provided.
            $_SESSION['error'] = 'Please fill in your languages.';
            header('location: ../client.php');
            exit();           
        } elseif(!$this->emptyTech()) { 
            // No skill provided.
            $_SESSION['error'] = 'Please fill in your skills.';
            header('location: ../client.php');
            exit();  
        }

        // Push the submitted values to the correct function
        if (isset($_POST['addSkill'])){
            $this->Createskills();

        } elseif (isset($_POST['saveSkill'])){
            $this->Updateskills();
        }
    }
}