<?php // Khaqan Ul Haq Awan

class updateResume {
    private $resid; // Dhr. A Pieter: Dit is nodig om het juiste cv te wijzigen.
    private $resumetitle;
    private $database; // Dhr. A Pieter: Dit was nodig omdat Resume niet meer werkte.

    public function __construct($resid, $resumetitle)
    {
        $this->resid = $resid;
        $this->resumetitle = $resumetitle;
        $this->database = new Database(); // <-- Dhr. A Pieter: Dit was nodig omdat Resume niet meer werkte.
    }

    public function UpdateResume()
    {
        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id'];
            $connection = $this->database->connect();

            $resumetitle = $this->getResumetitle();

            $sql = $connection->prepare
            ("
                update resume set resumetitle=:resumetitle
                where resumeID = :resid and userID=:user_id
            ");

            $sql->bindParam(":resid", $this->resid);
            $sql->bindParam(":resumetitle", $resumetitle);
            $sql->bindParam(":user_id", $userID);
            $sql->execute();
        }
    }

    public function getResumetitle()
    {
        return $this->resumetitle;
    }
    //public function setResumetitle($resumetitle)
    //{
    //$this->resumetitle = $resumetitle;
    //}

    // Dhr. A Pieter: Error handler erbij gezet.
    public function verifyResume() {
        // Activate security function beneath.
        if(!$this->emptyInput()) {
            // Empty input, no values given for account.
            $_SESSION['error'] = 'Please name your resume.';
            header('location: ../client.php');
            exit();
        }
        $this->CreateResume();
    }
    private function emptyInput() {
        // Check if the submitted values are not empty.
        return !(empty($this->resumetitle));
    }
}
