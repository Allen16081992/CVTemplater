<?php

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
    {
        if (isset($this->userID)) {

            // Khaqan
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
            $sql->bindParam(":userID", $this->userID);
            $sql->bindParam(":resumeID", $this->resumeID);
            $sql->execute();

        }

    }

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

    public function verifyExperience(){
        if(!$this->emptyInput()){
            $_SESSION['error'] = 'please name your experience.';
            header('location: ../client.php');
            exit();
        }
        $this->Createexperience();
    }
    public function emptyInput(){
        return !(empty($this->worktitle));
    }


}
