<?php // Khaqan

class Skills
{
    private $database;
    private $interest;
    private $language;
    private $techtitle;
    private $resumeID;
    private $userID;

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

    /**
     * @return mixed
     */
    //public function getInterest()
    //{
    //    return $this->interest;
    //}

    /**
     * @param mixed $interest
     */
    //public function setInterest($interest): void
    //{
    //    $this->interest = $interest;
    //}

    /**
     * @return mixed
     */
    //public function getLanguage()
    //{
    //    return $this->language;
    //}

    /**
     * @param mixed $language
     */
    //public function setLanguage($language): void
    //{
    //    $this->language = $language;
    //}

    /**
     * @return mixed
     */
    //public function getTechtitle()
    //{
    //    return $this->techtitle;
    //}

    /**
     * @param mixed $techtitle
     */
    //public function setTechtitle($techtitle): void
    //{
    //    $this->techtitle = $techtitle;
    //}
}
