<?php // Khaqan Ul Haq Awan
/*error_reporting(E_ALL);
ini_set('display_errors', 'On'); <-- Dhr. A Pieter: Niet zo handig in een productie omgeving.*/

require "../idb.config.php";

class Resume {
    private $resumetitle;
    private $database; // Dhr. A Pieter: Dit was nodig want Resume werkte niet meer.


    public function __construct($resumetitle = NULL)
    {
        $this->resumetitle = $resumetitle;
        $this->database = new Database(); // <-- Dhr. A Pieter: Dit was nodig want Resume werkte niet meer.
    }

    public function Create (){
        /*echo "dit is create"; 
        $servername = "localhost"; Dhr. A Pieter: Dit is niet meer nodig sinds je 'idb.config' gebruikt.
        $dbname = "curriculumdb";
        $username = "root";
        $password = "";
        try {
            $conn = new PDO(
                "mysqql:host=$servername
                dbname=$dbname",
                $username, $password
            );

            echo "connectie gelukt <br/>";
        }
        catch (PDOExeption $e){
            echo "connectie mislukt<br/>" .$e->getMessage();
        }*/

        //Dhr. A Pieter: Kijk of de user ingelogd is. Doe daarna Khaqan's deel uitvoeren.
        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id']; 

            $connection = $this->database->connect();
            $resumetitle = $this->getResumetitle();

            $sql = $connection->prepare(
                "insert into resume(resumetitle, userID) values
                    (:resumetitle, :userID);
            ");
            /*echo "FIX ME GOEDE GEBRUIKER IN RESUME CLASS CREATE!";*/
            $sql -> bindParam(":resumetitle", $resumetitle);
            $sql -> bindParam(":userID", $userID); // Dhr. A Pieter: Koppelt aan de logged in user.
            $sql -> execute();

            //echo "The resume has been created";
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
