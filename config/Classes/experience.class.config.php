<?php // Khaqan Ul Haq Awan

class Experience {
    private $worktitle;
    private $workdesc;
    private $company;
    private $firstDate;
    private $lastDate;
    private $database;
    private $userID;
    private $resumeID;

    public function __construct($worktitle, $workdesc, $company, $firstDate, $lastDate, $userID, $resumeID)
    {
        $this->worktitle = $worktitle;
        $this->workdesc = $workdesc;
        $this->company = $company;
        $this->firstDate = $firstDate;
        $this->lastDate = $lastDate;
        $this->userID = $userID;
        $this->resumeID = $resumeID;
        $this->database = new Database();
    }

    public function Createexperience()
    { // Dhr. Allen Pieter: New if. We can't let users save resume related data without creating a resume.
        if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {

            $connection = $this->database->connect();
            $worktitle = $this->getWorktitle();
            $workdesc = $this->getWorkdesc();
            $company = $this->getCompany();
            $firstDate = $this->getFirstDate();
            $lastDate = $this->getLastDate();
            $sql = $connection->prepare(
                "INSERT INTO experience (worktitle, workdesc, company, firstDate, lastDate, resumeID, userID) 
                 VALUES (:worktitle, :workdesc, :company, :firstDate, :lastDate, :resumeID, :userID);"
            );

            $sql->bindParam(":worktitle", $worktitle);
            $sql->bindParam(":workdesc", $workdesc);
            $sql->bindParam(":company", $company);
            $sql->bindParam(":firstDate", $firstDate);
            $sql->bindParam(":lastDate", $lastDate);
            $sql->bindParam(":userID", $this->userID); // Dhr. Allen Pieter. It now handles the logged in user value correctly.
            $sql->bindParam(":resumeID", $this->resumeID); // Dhr. Allen Pieter. It now handles the resume value correctly.
            $sql->execute();

            // Refresh client page.
            $_SESSION['success'] = 'Experience has been created';
            header('location: ../client.php?');

        } else {
            // No resume selected.
            $_SESSION['error'] = 'You should create a resume first.';
            header('location: ../client.php');            
        }
    }

    // Dhr. Allen Pieter: Adding an update procedure with haste.
    public function Updateexperience() {
        // Dhr. Allen Pieter: New if. We can't let users save resume related data without creating a resume.
        if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {  

            $connection = $this->database->connect();
            $worktitle = $this->getWorktitle();
            $workdesc = $this->getWorkdesc();
            $company = $this->getCompany();
            $firstDate = $this->getFirstDate();
            $lastDate = $this->getLastDate();
            $sql = $connection->prepare(
                "UPDATE `experience` SET worktitle = :worktitle, workdesc = :workdesc, company = :company, firstDate = :firstDate, lastDate = :lastDate, resumeID = :resumeID, userID = :userID;"
            );

            $sql->bindParam(":worktitle", $worktitle);
            $sql->bindParam(":workdesc", $workdesc);
            $sql->bindParam(":company", $company);
            $sql->bindParam(":firstDate", $firstDate);
            $sql->bindParam(":lastDate", $lastDate);
            $sql->bindParam(":userID", $this->userID); // Dhr. Allen Pieter. It now handles the logged in user value correctly.
            $sql->bindParam(":resumeID", $this->resumeID); // Dhr. Allen Pieter. It now handles the resume value correctly.
            $sql->execute(); 

            // Refresh client page.
            $_SESSION['success'] = 'Experience has been saved';
            header('location: ../client.php?');

        } else {
            // No resume selected.
            $_SESSION['error'] = 'You should create a resume first.';
            header('location: ../client.php');              
        }
    }

    // Dhr. Allen Pieter: Add those damn empty checks!
    // We don't want NULL set into database columns to specifically hold 'NULL'...
    public function verifyExperience(){
        if(!$this->emptyInput()){
            $_SESSION['error'] = 'please fill your experience.';
            header('location: ../client.php');
        }
        if (isset($_POST['addExperience'])) {
            $this->Createexperience();
        } elseif (isset($_POST['saveExperience'])) {
            $this->Updateexperience();
        }
    }

    private function emptyInput() {
        // Check if any of the submitted values are empty.
        return (
            !empty($this->worktitle) ||
            !empty($this->workdesc) ||
            !empty($this->company) ||
            !empty($this->firstDate) ||
            !empty($this->lastDate)
        );
    }
    //////////////////////////////////////////////////////////

    /**
     * @return mixed
     */
    public function getWorktitle()
    {
        return $this->worktitle;
    }

    /**
     * @param mixed $worktitle
     */
    public function setWorktitle($worktitle): void
    {
        $this->worktitle = $worktitle;
    }

    /**
     * @return mixed
     */
    public function getWorkdesc()
    {
        return $this->workdesc;
    }

    /**
     * @param mixed $workdesc
     */
    public function setWorkdesc($workdesc): void
    {
        $this->workdesc = $workdesc;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getFirstDate()
    {
        return $this->firstDate;
    }

    /**
     * @param mixed $firstDate
     */
    public function setFirstDate($firstDate): void
    {
        $this->firstDate = $firstDate;
    }

    /**
     * @return mixed
     */
    public function getLastDate()
    {
        return $this->lastDate;
    }

    /**
     * @param mixed $lastDate
     */
    public function setLastDate($lastDate): void
    {
        $this->lastDate = $lastDate;
    }

    /**
     * @return Database
     */
    public function getDatabase(): Database
    {
        return $this->database;
    }

    /**
     * @param Database $database
     */
    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }
}