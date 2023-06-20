<?php // Dhr. Allen Pieter
// Start a session for handling data and error messages.
require_once 'peripherals/session_start.config.php';

// Use the (improved) database connection.
require_once 'idb.config.php';

// Invoke FPDF
require_once 'fpdf185/fpdf.php';

class ResumePDF extends FPDF {
    private $pdo;
    private $data;

    public function __construct() {
        parent::__construct();
        $database = new Database();
        $this->pdo = $database->connect();
        $this->SetAutoPageBreak(true, 15);
    }

    public function fetchData($resumeID, $userID) {
        $result = array();
        $tables = array('accounts', 'contact', 'experience', 'education', 'interests', 'languages', 'profile', 'technical');

        // Loop through each table and fetch data
        foreach ($tables as $table) {
            if ($table === 'accounts') {
                $stmt = $this->pdo->prepare("SELECT email FROM `$table` WHERE userID = ?");
                $stmt->execute([$userID]);
                $result[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($table === 'contact') {
                $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE userID = ?");
                $stmt->execute([$userID]);
                $result[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE resumeID = ? AND userID = ?");
                $stmt->execute([$resumeID, $userID]);
                $result[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        if (empty($result)) {
            $_SESSION['error'] = 'No data found.';
        }
        $this->data = $result; 
    }

    function Header() {
        //Cell( width, height, text, border, end line, align)
        // Set the font and size
        $this->SetFont('Arial', 'B', 16);
    
        // Add Custom header
        $this->Cell(0, 10, 'Curriculum Vitae', 0, 0, 'C');
    
        // Add a line break
        $this->Ln(10);
    }
    
    function Footer() {
        // Add your custom footer content here
    }

    public function generatePDF() {
        $this->AliasNbPages();
        $this->AddPage();
        $this->SetFont('Arial', '', 12);
        
        //////////////////// TRADEMARK ///////////////////
        $imagePath = '../img/CV-headed-eagle.png';
        $this->Image($imagePath, 10, 10, 30); // Adjust the positioning and dimensions as needed    

        // Set font
        $this->SetFont('Arial', '', 10);

        // Name and Contact
        $firstname = $this->data['contact'][0]['firstname'];
        $surname = $this->data['contact'][0]['lastname'];
        $city = $this->data['contact'][0]['city'];
        $nationality = $this->data['contact'][0]['nationality'];
        $phone = $this->data['contact'][0]['phone'];
        $email = $this->data['accounts'][0]['email'];    
        // Work Experience
        $workTitles = array_column($this->data['experience'], 'worktitle');
        $workCompany = array_column($this->data['experience'], 'company');
        $workFirstDate = array_column($this->data['experience'], 'firstDate');
        $workLastDate = array_column($this->data['experience'], 'lastDate');
        $workSummary = array_column($this->data['experience'], 'workdesc');
        // Education
        $eduTitles = array_column($this->data['education'], 'edutitle');
        $eduCompany = array_column($this->data['education'], 'company');
        $eduFirstDate = array_column($this->data['education'], 'firstDate');
        $eduLastDate = array_column($this->data['education'], 'lastDate');
        $eduSummary = array_column($this->data['education'], 'edudesc');
        // Skills
        $techTitle = array_column($this->data['technical'], 'techtitle');
        $language = array_column($this->data['languages'], 'language');
        $interest = array_column($this->data['interests'], 'interest');

        //////////////////// HEADER ///////////////////
        // Add name and surname
        $this->SetXY(110, 10); // Set the position for text
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, $firstname.' '.$surname, 0, 1, 'R');

        // Add city, phone and email
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, $city, 0, 1, 'R');
        $this->Cell(0, 5, 'Nationality:  '.$nationality, 0, 1, 'R');
        $this->Ln(4);
        $this->SetX(110); // Set the position for the email
        $this->Cell(0, 5, $phone, 0, 1, 'R');
        $this->Cell(0, 5, $email, 0, 1, 'R');

        // Add a line break
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, 'Profile', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, $this->data['profile'][0]['profiledesc'], 0, 1, 'L');
        
        // Add a line break
        $this->Ln(10);

        /////////////////////// WORK EXPERIENCE ////////////////////////
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Experience', 1, 1, 'L');
        $this->Ln(2);

        // Show values from array position specifically. Limit - 3 jobs.
        if (count($workTitles) >= 1) {
            $this->SetFont('Arial', '', 10);
            // DATES
            $this->Cell(22, 10, $workFirstDate[0], 0, 0, '');
            $this->Cell(5, 10, '-', 0, 0, '');
            $this->Cell(30, 10, $workLastDate[0], 0, 0, '');
            $this->SetFont('Arial', 'B', 12);
            // PROFESSION, COMPANY, SUMMARY
            $this->Cell(60, 10, $workTitles[0], 0, 0, 'L');
            $this->Cell(50, 10, $workCompany[0], 0, 1, '');
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(30, 5, $workSummary[0], 0, 1, '');
            $this->Ln(5);
        }
        if (count($workTitles) >= 2) {
            $this->SetFont('Arial', '', 10);
            $this->Cell(22, 10, $workFirstDate[1], 0, 0, '');
            $this->Cell(5, 10, '-', 0, 0, '');
            $this->Cell(30, 10, $workLastDate[1], 0, 0, '');
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(60, 10, $workTitles[1], 0, 0, 'L');
            $this->Cell(50, 10, $workCompany[1], 0, 1, '');
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(30, 5, $workSummary[1], 0, 1, '');
            $this->Ln(5);
        } 
        if (count($workTitles) >= 3) {
            $this->SetFont('Arial', '', 10);
            $this->Cell(22, 10, $workFirstDate[2], 0, 0, '');
            $this->Cell(5, 10, '-', 0, 0, '');
            $this->Cell(30, 10, $workLastDate[2], 0, 0, '');
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(60, 10, $workTitles[2], 0, 0, 'L');
            $this->Cell(50, 10, $workCompany[2], 0, 1, '');
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(30, 5, $workSummary[2], 0, 1, '');
            $this->Ln(5);
        }

        /////////////////////// EDUCATION ////////////////////////
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Education', 1, 1, 'L');
        $this->Ln(2);

        // Show values from array position specifically. Limit - 3 jobs.
        if (count($eduTitles) >= 1) {
            $this->SetFont('Arial', '', 10);
            // DATES
            $this->Cell(22, 10, $eduFirstDate[0], 0, 0, '');
            $this->Cell(5, 10, '-', 0, 0, '');
            $this->Cell(30, 10, $eduLastDate[0], 0, 0, '');
            $this->SetFont('Arial', 'B', 12);
            // PROFESSION, COMPANY, SUMMARY
            $this->Cell(60, 10, $eduTitles[0], 0, 0, 'L');
            $this->Cell(50, 10, $eduCompany[0], 0, 1, '');
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(30, 5, $eduSummary[0], 0, 1, '');
            $this->Ln(5);
        }
        if (count($eduTitles) >= 2) {
            $this->SetFont('Arial', '', 10);
            $this->Cell(22, 10, $eduFirstDate[1], 0, 0, '');
            $this->Cell(5, 10, '-', 0, 0, '');
            $this->Cell(30, 10, $eduLastDate[1], 0, 0, '');
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(60, 10, $eduTitles[1], 0, 0, 'L');
            $this->Cell(50, 10, $eduCompany[1], 0, 1, '');
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(30, 5, $eduSummary[1], 0, 1, '');
            $this->Ln(5);
        } 
        if (count($eduTitles) >= 3) {
            $this->SetFont('Arial', '', 10);
            $this->Cell(22, 10, $eduFirstDate[2], 0, 0, '');
            $this->Cell(5, 10, '-', 0, 0, '');
            $this->Cell(30, 10, $eduLastDate[2], 0, 0, '');
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(60, 10, $eduTitles[2], 0, 0, 'L');
            $this->Cell(50, 10, $eduCompany[2], 0, 1, '');
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(30, 5, $eduSummary[2], 0, 1, '');
            $this->Ln(5);
        }

        /////////////////////// SKILLS ////////////////////////
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Skills', 1, 1, 'L');
        $this->Ln(3);

        $this->SetFont('Arial', 'I', 10);
        $this->Cell(63, 5, 'Abilities', 1, 0, 'C');
        $this->Cell(63, 5, 'Languages', 1, 0, 'C');
        $this->Cell(63, 5, 'Interests', 1, 1, 'C');

        $this->SetFont('Arial', 'B', 14);
        $this->Ln(2);

        // Show values from array position specifically. Limit - 3 jobs.
        // Determine the maximum number of entries to display
        $maxEntries = max(count($techTitle), count($language), count($interest));

        // Loop through the entries
        for ($i = 0; $i < $maxEntries; $i++) {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(20, 5, '', 0, 0, '');
            // SKILLS, LANGUAGES, INTERESTS
            $this->Cell(60, 5, isset($techTitle[$i]) ? $techTitle[$i] : '', 0, 0, 'L');
            $this->Cell(60, 5, isset($language[$i]) ? $language[$i] : '', 0, 0, 'L');
            $this->Cell(60, 5, isset($interest[$i]) ? $interest[$i] : '', 0, 1, 'L');
            $this->Ln(5);
        }   

        $this->Output();
    }
}

if (isset($_SESSION['resumeID'])) {
    $resumeID = $_SESSION['resumeID'];
    $userID = $_SESSION['user_id'];

    $resumePDF = new ResumePDF();
    $resumePDF->fetchData($resumeID, $userID);
    $resumePDF->generatePDF();
}