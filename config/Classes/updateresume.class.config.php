<?php // Khaqan Ul Haq Awan
require_once '././Controller/errorhandlers.control.config.php';

class updateResume {
    private $resid; // Dhr. A Pieter: This is needed to edit the correct resume.
    private $resumetitle;
    private $database; // Dhr. A Pieter: This was needed because the file didn't work anymore.
    use ErrorHandlers;

    public function __construct($resid, $resumetitle)
    {
        $this->resid = $resid;
        $this->resumetitle = $resumetitle;
        $this->database = new Database(); // <-- Dhr. A Pieter: This was needed because the file didn't work anymore.
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

    // Dhr. A Pieter: Error handler added.
    // Can't be good when only half of the code incorporates validation.
    public function verifyResume() {
        // Invoke validation.
        if(!$this->emptyResumetitle()) {
            // No resume name provided.
            $_SESSION['error'] = 'Please name your resume.';
            header('location: ../client.php');
            exit();
        }
        $this->UpdateResume();
    }
}
