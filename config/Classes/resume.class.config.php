<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require "../idb.config.php";

class Resume {
    private $resumetitle;


    public function __construct($resumetitle = NULL)
    {
        $this->resumetitle = $resumetitle;
    }

    public function Create (){
        echo "dit is create";
        /*$servername = "localhost";
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
        }
        */

        global $connection;
        $resumetitle = $this->getResumetitle();

        $sql = $connection->prepare(

               "insert into resume(resumetitle, userID) values
                (:resumetitle, 1);
        ");
        echo "FIX ME GOEDE GEBRUIKER IN RESUME CLASS CREATE!";
        $sql -> bindParam(":resumetitle", $resumetitle);
        $sql -> execute();

        echo "The resume has been created";
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
