<?php // Khaqan Ul Haq Awan
/*error_reporting(E_ALL);
ini_set('display_errors', 'On'); <-- Dhr. A Pieter: Niet zo handig in een productie omgeving.*/

class Resume {
    private $resumetitle;
    private $database; // Dhr. A Pieter: Dit was nodig omdat Resume niet meer werkte.

    public function __construct($resumetitle = NULL)
    {
        $this->resumetitle = $resumetitle;
        $this->database = new Database(); // <-- Dhr. A Pieter: Dit was nodig omdat Resume niet meer werkte.
    }

    public function Create (){
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
    
    public function setResumetitle($resumetitle)
    {
        $this->resumetitle = $resumetitle;
    }


}
