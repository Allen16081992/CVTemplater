<?php

class Education {
    private $edutitle;
    private $edudesc;
    private $company;
    private $firstDate;
    private $lastDate;
    private $database;

    public function __construct($edutitle, $edudesc, $company, $firstDate, $lastDate)
    {
        $this->edutitle = $edutitle;
        $this->edudesc = $edudesc;
        $this->company = $company;
        $this->firstDate = $firstDate;
        $this->lastDate = $lastDate;
        $this->database = new Database();
    }

    public function Createeducation()
    {
        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id'];

            // Khaqan
            $connection = $this->database->connect();
            $edutitle = $this->getedutitle();
            $edudesc = $this->getedudesc();
            $company = $this->getcompany();
            $firstDate = $this->getfirstDate();
            $lastDate = $this->getlastDate();

            $sql = $connection->prepare(
                "insert into education(edutitle, edudesc, company, firstDate, lastDate, userID) values 
                       (:edutitle, :edudesc, :company, :firstDate, :lastDate, :userID);"
            );
            $sql->bindParam(":edutitle", $edutitle);
            $sql->bindParam(":edudesc", $edudesc);
            $sql->bindParam(":company", $company);
            $sql->bindParam(":firstDate", $firstDate);
            $sql->bindParam(":lastDate", $lastDate);
            $sql->execute();

            $stmt = $sql->fetch(PDO::FETCH_ASSOC);
            return $stmt;

        }
    }

    public function verifyEducation() {
        // Activate security function beneath.
//        if(!$this->emptyInput()) {
//            // Empty input, no values given for account.
//           // $_SESSION['error'] = 'Please name your education.';
//            //header('location: ../client.php');
//            //exit();
//            return $this->edutitle, $this->edudesc, $this->company, $this->firstDate, $this->lastDate;
//        }
          $this->Createeducation();

    }

//    private function emptyInput() {
//        // Check if any of the submitted values are empty.
//        return (
//            empty($this->edutitle) ||
//            empty($this->edudesc) ||
//            empty($this->company) ||
//            empty($this->firstDate) ||
//            empty($this->lastDate)
//        );
//    }


    public function getedutitle()
    {
        return $this->edutitle;
    }

    public function setedutitle($edutitle)
    {
        $this->edutitle = $edutitle;
    }

    public function getedudesc()
    {
        return $this->edudesc;
    }


    public function setedudesc($edudesc)
    {
        $this->edudesc = $edudesc;
    }


    public function getcompany()
    {
        return $this->company;
    }


    public function setcompany($company)
    {
        $this->company = $company;
    }


    public function getfirstDate()
    {
        return $this->firstDate;
    }


    public function setfirstDate($firstDate)
    {
        $this->firstDate = $firstDate;
    }


    public function getlastDate()
    {
        return $this->lastDate;
    }


    public function setlastDate($lastDate)
    {
        $this->lastDate = $lastDate;
    }

    public function getdatabase()
    {
        return $this->database;
    }

    public function setdatabase($database)
    {
        $this->database = $database;
    }

}