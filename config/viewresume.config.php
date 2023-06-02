<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    session_start();

    // Use the (improved) database connection.
    include 'idb.config.php';

    class ViewResume {
        private $pdo;
        
        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }       

        public function viewResumeInfo() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];
        
                // Select user records
                $stmt = $this->pdo->prepare('SELECT resumetitle FROM `resume` WHERE userID = ?');
                $stmt->execute([$userID]);
                $cv = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (!$cv) {
                    return [];
                }
                // Return the resume data
                return $cv;
            }
            // Return an empty array if user ID is not set
            return [];
        }        

        public function viewExperience() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];

                // Select contact record
                $stmt = $this->pdo->prepare('SELECT * FROM experience WHERE userID = ?');
                $stmt->execute([$userID]);
                $work = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (!$work) {
                    $_SESSION['error'] = 'Work information not found';
                    return;
                }
                // Return the combined user and contact data
                return ['work' => $work];
            } 
            // Return an empty array if user ID is not set
            return [];
        }

        public function viewEducation() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];

                // Select contact record
                $stmt = $this->pdo->prepare('SELECT * FROM education WHERE userID = ?');
                $stmt->execute([$userID]);
                $college = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (!$college) {
                    $_SESSION['error'] = 'Education info not found';
                    return;
                }
                // Return the combined user and contact data
                return ['college' => $college];
            } 
            // Return an empty array if user ID is not set
            return [];
        }

        public function viewTechnical() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];

                // Select contact record
                $stmt = $this->pdo->prepare('SELECT techtitle FROM technical WHERE userID = ?');
                $stmt->execute([$userID]);
                $tech = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (!$tech) {
                    $_SESSION['error'] = 'Skills information not found';
                    return;
                }
                // Return the combined user and contact data
                return ['tech' => $tech];
            } 
            // Return an empty array if user ID is not set
            return [];            
        }

        public function viewLanguages() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];

                // Select contact record
                $stmt = $this->pdo->prepare('SELECT `language` FROM `languages` WHERE userID = ?');
                $stmt->execute([$userID]);
                $lang = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (!$lang) {
                    $_SESSION['error'] = 'Linguistical information not found';
                    return;
                }
                // Return the combined user and contact data
                return ['lang' => $lang];
            } 
            // Return an empty array if user ID is not set
            return [];              
        }

        public function viewInterests() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];

                // Select contact record
                $stmt = $this->pdo->prepare('SELECT `interest` FROM `interests` WHERE userID = ?');
                $stmt->execute([$userID]);
                $interest = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (!$interest) {
                    $_SESSION['error'] = 'Interests not found';
                    return;
                }
                // Return the combined user and contact data
                return ['interest' => $interest];
            } 
            // Return an empty array if user ID is not set
            return [];              
        }

        public function viewPortfolio() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];

                // Select contact record
                $stmt = $this->pdo->prepare('SELECT IMGtitle, IMGpath FROM portfolio WHERE userID = ?');
                $stmt->execute([$userID]);
                $portfolio = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (!$portfolio) {
                    $_SESSION['error'] = 'Portfolio information not found';
                    return;
                }
                // Return the combined user and contact data
                return ['interest' => $portfolio];
            } 
            // Return an empty array if user ID is not set
            return [];              
        }
    }
    // Create an object from our class


        // Copy-paste this part into the file that needs to display all resume data.
        // Include the PHP file that retrieves the data
        //include 'config/viewresume.config.php';

        // Create an instance of ViewResume
        //$viewResume = new ViewResume();
        //$data = $viewResume->viewResumeInfo();
        //$data = $viewResume->viewExperience();
        //$data = $viewResume->viewEducation();
        //$data = $viewResume->viewTechnical();
        //$data = $viewResume->viewLanguages();
        //$data = $viewResume->viewInterests();
        //$data = $viewResume->viewPortfolio();
      
        // Access the resume and all corresponding data from the array
        //$cv = $data['cv'];
        //$work = $data['work'];
        //$college = $data['college'];
        //$tech = $data['tech'];
        //$lang = $data['lang'];
        //$interest = $data['interest'];
        //$portfolio = $data['portfolio'];
?>