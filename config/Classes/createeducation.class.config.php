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
    {
        if (isset($this->userID)) {

            // Khaqan
            $connection = $this->database->connect();
            $edutitle = $this->getedutitle();
            $edudesc = $this->getedudesc();
            $company = $this->getcompany();
            $firstDate = $this->getfirstDate();
            $lastDate = $this->getlastDate();

            $sql = $connection->prepare(
                "INSERT INTO education (edutitle, edudesc, company, firstDate, lastDate, resumeID, userID) 
                 VALUES (:edutitle, :edudesc, :company, :firstDate, :lastDate, :resumeID, :userID);"
            );
            $sql->bindParam(":edutitle", $edutitle);
            $sql->bindParam(":edudesc", $edudesc);
            $sql->bindParam(":company", $company);
            $sql->bindParam(":firstDate", $firstDate);
            $sql->bindParam(":lastDate", $lastDate);
            $sql->bindParam(":resumeID", $this->resumeID); // Dhr. Allen Pieter. It now handles the resume value correctly.
            $sql->bindParam(":userID", $this->userID); // Dhr. Allen Pieter. It now handles the logged in user value correctly.
            $sql->execute();

        }
    }

    public function verifyEducation(){
        if(!$this->emptyInput()){
            $_SESSION['error'] = 'please name your education.';
            header('location: ../client.php');
            exit();
        }
        $this->Createeducation();
    }
    public function emptyInput(){
        return !(empty($this->edutitle));
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