<?php // Khaqan Ul Haq Awan

class Education {
    private $edutitle;
    private $edudesc;
    private $company;
    private $firstDate;
    private $lastDate;
    private $database;
    private $userID;
    private $resumeID;


    public function __construct($edutitle, $edudesc, $company, $firstDate, $lastDate, $userID, $resumeID)
    {
        $this->edutitle = $edutitle;
        $this->edudesc = $edudesc;
        $this->company = $company;
        $this->firstDate = $firstDate;
        $this->lastDate = $lastDate;
        $this->userID = $userID;
        $this->resumeID = $resumeID;
        $this->database = new Database();
    }

    public function Createeducation()
    {   // Dhr. Allen Pieter: New if. We can't let users save resume related data without creating a resume.
        if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {

            // Khaqan
            $connection = $this->database->connect();
            //$edutitle = $this->getedutitle();
            // $edudesc = $this->getedudesc();
            // $company = $this->getcompany();
            // $firstDate = $this->getfirstDate();
            // $lastDate = $this->getlastDate();

            $sql = $connection->prepare(
                "INSERT INTO education (edutitle, edudesc, company, firstDate, lastDate, resumeID, userID) 
                 VALUES (:edutitle, :edudesc, :company, :firstDate, :lastDate, :resumeID, :userID);"
            );
            $sql->bindParam(":edutitle", $this->edutitle);
            $sql->bindParam(":edudesc", $this->edudesc);
            $sql->bindParam(":company", $this->company);
            $sql->bindParam(":firstDate", $this->firstDate);
            $sql->bindParam(":lastDate", $this->lastDate);
            $sql->bindParam(":resumeID", $this->resumeID); // Dhr. Allen Pieter. It now handles the resume value correctly.
            $sql->bindParam(":userID", $this->userID); // Dhr. Allen Pieter. It now handles the logged in user value correctly.
            $sql->execute();

            // Refresh client page.
            $_SESSION['success'] = 'Education has been created.';
            header('location: ../client.php?');

        } else {
            // No resume selected.
            $_SESSION['error'] = 'You should create a resume first.';
            header('location: ../client.php');               
        }
    }

    // Dhr. Allen Pieter: Adding an update procedure with haste.
    public function Updateeducation() {
        // Dhr. Allen Pieter: New if. We can't let users save resume related data without creating a resume.
        if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {       
            if(isset($_POST['eduID'])) {
                $eduID = $_POST['eduID'];
            } else {
                // Error message by sessions instead of URL parsing.
                $_SESSION['error'] = 'Failed to verify Experience.';
                header('location: ../client.php');
            }
            $connection = $this->database->connect();
            //$edutitle = $this->getedutitle();
            // $edudesc = $this->getedudesc();
            // $company = $this->getcompany();
            // $firstDate = $this->getfirstDate();
            // $lastDate = $this->getlastDate();

            $sql = $connection->prepare(
                "UPDATE `education` SET edutitle = :edutitle, edudesc = :edudesc, company = :company, firstDate = :firstDate, lastDate = :lastDate WHERE eduID = :eduID AND resumeID = :resumeID AND userID = :userID;"
            );
            $sql->bindParam(":edutitle", $this->edutitle);
            $sql->bindParam(":edudesc", $this->edudesc);
            $sql->bindParam(":company", $this->company);
            $sql->bindParam(":firstDate", $this->firstDate);
            $sql->bindParam(":lastDate", $this->lastDate);
            $sql->bindParam(":eduID", $eduID);
            $sql->bindParam(":resumeID", $this->resumeID); // Dhr. Allen Pieter. It now handles the resume value correctly.
            $sql->bindParam(":userID", $this->userID); // Dhr. Allen Pieter. It now handles the logged in user value correctly.
            $sql->execute();  

            // Refresh client page.
            $_SESSION['success'] = 'Education has been updated.';
            header('location: ../client.php?');

        } else {
            // No resume selected.
            $_SESSION['error'] = 'You should create a resume first.';
            header('location: ../client.php');               
        }
    }

    // Dhr. Allen Pieter: Add those damn empty checks!
    // We don't want NULL set into database columns to specifically hold 'NULL'...
    public function verifyEducation(){
        if(!$this->emptyInput()){
            $_SESSION['error'] = 'please fill your education.';
            header('location: ../client.php');
            exit();
        }
        if (isset($_POST['addEducation'])) {
            $this->Createeducation();
        } elseif (isset($_POST['saveEducation'])) {
            $this->Updateeducation();
        }
    }

    private function emptyInput() {
        // Check if any of the submitted values are empty.
        return (
            !empty($this->edutitle) ||
            !empty($this->edudesc) ||
            !empty($this->company) ||
            !empty($this->firstDate) ||
            !empty($this->lastDate)
        );
    }
    //////////////////////////////////////////////////////////

    // public function getedutitle()
    // {
    //     return $this->edutitle;
    // }

    // public function setedutitle($edutitle)
    // {
    //     $this->edutitle = $edutitle;
    // }

    // public function getedudesc()
    // {
    //     return $this->edudesc;
    // }


    // public function setedudesc($edudesc)
    // {
    //     $this->edudesc = $edudesc;
    // }


    // public function getcompany()
    // {
    //     return $this->company;
    // }


    // public function setcompany($company)
    // {
    //     $this->company = $company;
    // }


    // public function getfirstDate()
    // {
    //     return $this->firstDate;
    // }


    // public function setfirstDate($firstDate)
    // {
    //     $this->firstDate = $firstDate;
    // }


    // public function getlastDate()
    // {
    //     return $this->lastDate;
    // }


    // public function setlastDate($lastDate)
    // {
    //     $this->lastDate = $lastDate;
    // }

    // public function getdatabase()
    // {
    //     return $this->database;
    // }

    // public function setdatabase($database)
    // {
    //     $this->database = $database;
    // }
}