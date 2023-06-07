<?php // Khaqan Ul Haq Awan
/*error_reporting(E_ALL);
ini_set('display_errors', 'On'); <-- Dhr. A Pieter: Niet zo handig in een productie omgeving.*/

class Resume {
    private $resumetitle;
    private $database; // Dhr. A Pieter: Dit was nodig omdat Resume niet meer werkte.

    public function __construct($resumetitle)
    {
        $this->resumetitle = $resumetitle;
        $this->database = new Database(); // <-- Dhr. A Pieter: Dit was nodig omdat Resume niet meer werkte.
    }

    public function CreateResume() {
        //Dhr. A Pieter: Kijk of de user ingelogd is. Doe daarna Khaqan's deel uitvoeren.
        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id']; 

            // Khaqan
            $connection = $this->database->connect();
            $resumetitle = $this->getResumetitle();

            $sql = $connection->prepare(
                "insert into resume(resumetitle, userID) values
                    (:resumetitle, :userID);
            ");
            $sql -> bindParam(":resumetitle", $resumetitle);
            $sql -> bindParam(":userID", $userID); // Dhr. A Pieter: Koppelen aan de ingelogde user.
            $sql -> execute();
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
