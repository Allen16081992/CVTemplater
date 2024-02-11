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
            $sql = $connection->prepare(
                "INSERT INTO experience (worktitle, workdesc, company, firstDate, lastDate, resumeID, userID) 
                 VALUES (:worktitle, :workdesc, :company, :firstDate, :lastDate, :resumeID, :userID);"
            );

            $sql->bindParam(":worktitle", $this->worktitle);
            $sql->bindParam(":workdesc", $this->workdesc);
            $sql->bindParam(":company", $this->company);
            $sql->bindParam(":firstDate", $this->firstDate);
            $sql->bindParam(":lastDate", $this->lastDate);
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
            // Check if a row id was submitted
            if(isset($_POST['workID'])) {
                $workID = $_POST['workID'];
            } else {
                // Error message by sessions instead of URL parsing.
                $_SESSION['error'] = 'Failed to verify Experience.';
                header('location: ../client.php');
            }
            $connection = $this->database->connect();
            $sql = $connection->prepare(
                "UPDATE `experience` SET worktitle = :worktitle, workdesc = :workdesc, company = :company, firstDate = :firstDate, lastDate = :lastDate WHERE workID = :workID AND resumeID = :resumeID AND userID = :userID;"
            );

            $sql->bindParam(":worktitle", $this->worktitle);
            $sql->bindParam(":workdesc", $this->workdesc);
            $sql->bindParam(":company", $this->company);
            $sql->bindParam(":firstDate", $this->firstDate);
            $sql->bindParam(":lastDate", $this->lastDate);
            $sql->bindParam(":workID", $workID);
            $sql->bindParam(":resumeID", $this->resumeID); // Dhr. Allen Pieter. It now handles the resume value correctly.
            $sql->bindParam(":userID", $this->userID); // Dhr. Allen Pieter. It now handles the logged in user value correctly.
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