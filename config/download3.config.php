<?php // Dhr. Allen Pieter
// Start a session for handling data and error messages.
require_once 'peripherals/session_management.config.php';
sessionRegen(); // Call the periodic session regeneration

// Invoke the (improved) database connection and FPDF library.
require_once 'idb.config.php';
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
        $tables = array('resume', 'accounts', 'contact', 'profile', 'experience', 'education', 'techskill', 'motivation');

        // Loop through each table and fetch data
        foreach ($tables as $table) {
            if ($table === 'resume') {
                $stmt = $this->pdo->prepare("SELECT resumetitle FROM `$table` WHERE resumeID = ?");
                $stmt->execute([$resumeID]);
                $result[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($table === 'accounts') {
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
    
    function Footer() {
        // Check if more than one page exists
        if ($this->PageNo() > 1) {
            // Select Arial italic 8
            $this->SetFont('Arial','I',8);
            // Set the position of the footer at 15mm from the bottom
            $this->SetY(-15);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    public function generatePDF() {
        $this->AliasNbPages();
        $this->AddPage();
        $this->SetFont('Arial', '', 12);
        
        // Sanitize data using htmlspecialchars
        // Resume title becomes Filename
        if (isset($this->data['resume'][0]['resumetitle'])) {
            $doc = htmlspecialchars($this->data['resume'][0]['resumetitle']); 
            $this->SetTitle('My '.$doc.' CT');
        }
        // Name and Contact
        if (isset($this->data['contact'][0])) {
            $firstname = htmlspecialchars($this->data['contact'][0]['firstname']);
            $surname = htmlspecialchars($this->data['contact'][0]['lastname']);
            $initials = substr($firstname, 0, 1) . substr($surname, 0, 1);
            $city = htmlspecialchars($this->data['contact'][0]['city']);
            //$country = htmlspecialchars($this->data['contact'][0]['country']);
            $phone = htmlspecialchars($this->data['contact'][0]['phone']);
            $email = htmlspecialchars($this->data['accounts'][0]['email']);
            $postal = htmlspecialchars($this->data['contact'][0]['postalcode']);
        }
        // Work Experience
        if (isset($this->data['experience'])) {
            $workTitles = array_column($this->data['experience'], 'worktitle');
            $workCompany = array_column($this->data['experience'], 'company');
            $workFirstDate = array_column($this->data['experience'], 'firstDate');
            $workLastDate = array_column($this->data['experience'], 'lastDate');
            $workSummary = array_column($this->data['experience'], 'workdesc');
            // Sanitize
            $workTitles = array_map('htmlspecialchars', $workTitles);
            $workCompany = array_map('htmlspecialchars', $workCompany);
            $workFirstDate = array_map('htmlspecialchars', $workFirstDate);
            $workLastDate = array_map('htmlspecialchars', $workLastDate);
            // $workSummary = array_map('htmlspecialchars', $workSummary);
        }
        // Education
        if (isset($this->data['education'])) {
            $eduTitles = array_column($this->data['education'], 'edutitle');
            $eduCompany = array_column($this->data['education'], 'company');
            $eduFirstDate = array_column($this->data['education'], 'firstDate');
            $eduLastDate = array_column($this->data['education'], 'lastDate');
            $eduSummary = array_column($this->data['education'], 'edudesc');
            // Sanitize
            $eduTitles = array_map('htmlspecialchars', $eduTitles);
            $eduCompany = array_map('htmlspecialchars', $eduCompany);
            $eduFirstDate = array_map('htmlspecialchars', $eduFirstDate);
            $eduLastDate = array_map('htmlspecialchars', $eduLastDate);
            $eduSummary = array_map('htmlspecialchars', $eduSummary);
        }
        // Skills
        if (isset($this->data['techskill'])) {
            $techTitle = array_column($this->data['techskill'], 'techtitle');
            $language = array_column($this->data['techskill'], 'language');
            $interest = array_column($this->data['techskill'], 'interest');
            // Sanitize
            $techTitle = array_map('htmlspecialchars', $techTitle);
            $language = array_map('htmlspecialchars', $language);
            $interest = array_map('htmlspecialchars', $interest);
        }
        // Motivation
        if (isset($this->data['motivation'])) {
            $motivation = array_column($this->data['motivation'], 'motdesc');
            // Sanitize
            $motivation = array_map('htmlspecialchars', $motivation);
        }

        //////////////////// TRADEMARK ///////////////////
        $imagePath = '../img/MyInitials2.png';
        $building = '../img/icons/buildings-24.png'; 
        $envelope = '../img/icons/envelope-24.png';
        $mobile = '../img/icons/phone-24.png'; 
        $world = '../img/icons/world-24.png';

        //////////////////// Side 1 ///////////////////

        $this->SetDrawColor(0,155,119); //0,155,119 Emerald Green
        $this->SetFillColor(228, 228, 228); // Set RGB color
        $this->Cell(66, 270, '', 1, 0, 'C', 1); // Set width, height, text, border, align, fill

        // Set Graphic Design
        if (!empty($this->data['profile'][0]['filePath'])) {
            // Set Avatar
            $avatar = $this->data['profile'][0]['filePath'];
            $this->Image($imagePath, 25, 7, 34); // Default image
            $this->Image($avatar, 27.5, 13, 29); // Avatar image
        } 
        else {
            // Set Initials Crest
            $this->Image($imagePath, 28, 10, 30); // Adjust positioning and dimensions

            // Set Initials
            $this->SetXY(13, 24); // Set the position for text
            $this->SetFont('Arial', 'I', 14);
            $this->SetFontSize(38); // Set the font size to 41
            $this->SetTextColor(255,255,255); // Set font color to red (RGB values)

            $this->Cell(20, 10, '', 0, 0, 'L'); // Add cell space
            $this->Cell(25, 10, $initials, 0, 0, '');
            $this->SetTextColor(0,0,0); // Set font color to red (RGB values)
        }

        // Set Name
        $this->SetFont('Arial', 'I', 14);
        $this->SetFontSize(41); // Set the font size to 41
        $this->Cell(25, 21, '', 0, 0, 'L'); // Add cell space

        $this->SetXY(90, 18); // Set the position for text
        $this->Cell(0, 13, $firstname.' '.$surname, 0, 1, 'L');
        $this->SetXY(10, 50); // Set the position for text

        // Set Resume Title
        // $this->SetFontSize(12); // Set the font size
        // $this->Cell(80, 10, '', 0, 0, 'L'); // Add cell space
        // $this->Cell(0, 10, $doc, 0, 0, 'L');

        //////////////////// Contact ///////////////////
        $this->SetFont('Arial', '', 12);
        $this->SetFontSize(10); // Set the font size
        
        //$this->SetLineWidth(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(66, 8, 'Contact', 1, 1, 'C'); // Add cell title

        $this->SetFont('Arial', '', 10);
        $this->Cell(9, 8, '', 0, 0, 'L'); // Add cell space for icon
        $this->Image($mobile, 12, 59, 5); 
        $this->Cell(56, 8, $phone, 0, 1, 'L'); 

        $this->Cell(9, 8, '', 0, 0, 'L'); // Add cell space for icon
        $this->Image($envelope, 12, 67.5, 5);  
        $this->Cell(56, 8, $email, 0, 1, 'L');
        
        $this->Cell(9, 8, '', 0, 0, 'L'); // Add cell space for icon
        $this->Image($building, 12, 75, 5); 
        $this->Cell(56, 8, $postal.', '.$city, 0, 1, 'L');
        $this->Ln(2);

        /////////////////////// EDUCATION ////////////////////////
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(66, 8, 'Opleiding', 1, 1, 'C'); // Add cell title

        if (count($eduTitles) >= 1) {
            // STUDY & COMPANY
            if (isset($eduTitles[0]) && isset($eduCompany[0])) {
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(17, 6, $eduTitles[0], 0, 0, 'L');
                $this->Cell(65, 6, $eduCompany[0], 0, 1, 'C');
            }
            // DATES
            if (isset($eduFirstDate[0]) && isset($eduLastDate[0])) {
                $this->SetFont('Arial', '', 8);
                $this->Cell(17, 6, $eduFirstDate[0], 0, 0, '');
                $this->Cell(5, 6, '-', 0, 0, 'C');
                $this->Cell(17, 6, $eduLastDate[0], 0, 1, '');
            }
            $this->Ln(2);
        }
        if (count($eduTitles) >= 2) {
            // STUDY & COMPANY
            if (isset($eduTitles[1]) && isset($eduCompany[1])) {
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(17, 6, $eduTitles[1], 0, 0, 'L');
                $this->Cell(65, 6, $eduCompany[1], 0, 1, 'C');
            }
            // DATES
            if (isset($eduFirstDate[1]) && isset($eduLastDate[1])) {
                $this->SetFont('Arial', '', 8);
                $this->Cell(17, 6, $eduFirstDate[1], 0, 0, '');
                $this->Cell(5, 6, '-', 0, 0, 'C');
                $this->Cell(17, 6, $eduLastDate[1], 0, 1, '');
            }
            $this->Ln(2);
        }
        if (count($eduTitles) >= 3) {
            // STUDY & COMPANY
            if (isset($eduTitles[2]) && isset($eduCompany[2])) {
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(17, 6, $eduTitles[2], 0, 0, 'L');
                $this->Cell(65, 6, $eduCompany[2], 0, 1, 'C');
            }
            // DATES
            if (isset($eduFirstDate[2]) && isset($eduLastDate[2])) {
                $this->SetFont('Arial', '', 8);
                $this->Cell(17, 6, $eduFirstDate[2], 0, 0, '');
                $this->Cell(5, 6, '-', 0, 0, 'C');
                $this->Cell(17, 6, $eduLastDate[2], 0, 1, '');
            }
            $this->Ln(2);
        }
        if (count($eduTitles) >= 4) {
            // STUDY & COMPANY
            if (isset($eduTitles[3]) && isset($eduCompany[3])) {
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(17, 6, $eduTitles[3], 0, 0, 'L');
                $this->Cell(65, 6, $eduCompany[3], 0, 1, 'C');
            }
            // DATES
            if (isset($eduFirstDate[3]) && isset($eduLastDate[3])) {
                $this->SetFont('Arial', '', 8);
                $this->Cell(17, 6, $eduFirstDate[3], 0, 0, '');
                $this->Cell(5, 6, '-', 0, 0, 'C');
                $this->Cell(17, 6, $eduLastDate[3], 0, 1, '');
            }
            $this->Ln(2);
        }
        if (count($eduTitles) >= 5) {
            // STUDY & COMPANY
            if (isset($eduTitles[4]) && isset($eduCompany[4])) {
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(17, 6, $eduTitles[4], 0, 0, 'L');
                $this->Cell(65, 6, $eduCompany[4], 0, 1, 'C');
            }
            // DATES
            if (isset($eduFirstDate[4]) && isset($eduLastDate[4])) {
                $this->SetFont('Arial', '', 8);
                $this->Cell(17, 6, $eduFirstDate[4], 0, 0, '');
                $this->Cell(5, 6, '-', 0, 0, 'C');
                $this->Cell(17, 6, $eduLastDate[4], 0, 1, '');
            }
            $this->Ln(2);
        }
        if (count($eduTitles) >= 6) {
            // STUDY & COMPANY
            if (isset($eduTitles[5]) && isset($eduCompany[5])) {
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(17, 6, $eduTitles[5], 0, 0, 'L');
                $this->Cell(65, 6, $eduCompany[5], 0, 1, 'C');
            }
            // DATES
            if (isset($eduFirstDate[5]) && isset($eduLastDate[5])) {
                $this->SetFont('Arial', '', 8);
                $this->Cell(17, 6, $eduFirstDate[5], 0, 0, '');
                $this->Cell(5, 6, '-', 0, 0, 'C');
                $this->Cell(17, 6, $eduLastDate[5], 0, 1, '');
            }
            $this->Ln(2);
        }

        ////////////////////// HARD & SOFT SKILLS //////////////////////
        if (isset($this->data['techskill'][0]['techtitle']) || isset($this->data['techskill'][0]['language']) || isset($this->data['techskill'][0]['interest'])) {

            // Show values from array position specifically. Limit - 3 jobs.
            // Determine the maximum number of entries to display 
            $maxEntries = max(count($techTitle), count($language), count($interest)); 

            $this->SetFont('Arial', 'B', 10);
            $this->Cell(33, 8, 'Talen', 1, 0, 'C'); // Add cell title
            $this->Cell(33, 8, 'Vaardigheden', 1, 1, 'C'); // Add cell title

            // Loop through the entries
            for ($i = 0; $i < $maxEntries; $i++) {

                // SKILLS, LANGUAGES
                $this->SetFont('Arial', '', 10);
                $this->Cell(22, 5, isset($language[$i]) ? $language[$i] : '', 0, 0, 'L');
                $this->Cell(12, 5, '', 0, 0, 'L');
                $this->Cell(22, 5, isset($techTitle[$i]) ? $techTitle[$i] : '', 0, 1, 'L');
            }

            $this->Ln(2);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(66, 8, 'Interessen', 1, 1, 'C'); // Add cell title

            // Loop through the entries
            for ($i = 0; $i < $maxEntries; $i++) {

                // INTERESTS
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, isset($interest[$i]) ? $interest[$i] : '', 0, 1, 'L');
            }
        }

        //////////////////////////// Main ////////////////////////////
        /////////////////////// WORK EXPERIENCE ////////////////////////
        $this->SetFont('Arial', '', 14);
        $this->SetXY(80, 50); // Set the position for text
        $this->Cell(0, 8, 'Werkervaring', 1, 1, 'C');
        $this->Ln(2);

        // Show values from array position specifically. Limit - 3 jobs.
        if (count($workTitles) >= 1) {
            // PROFESSION
            if (isset($workTitles[0])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(75, 8, $workTitles[0], 1, 0, 'L');
            }

            // DATES
            if (isset($workFirstDate[0]) && isset($workLastDate[0])) {
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 8, $workFirstDate[0], 1, 0, '');
                $this->Cell(5, 8, '-', 1, 0, 'C');
                $this->Cell(20, 8, $workLastDate[0], 1, 1, '');
            }
            
            // COMPANY & SUMMARY
            if (isset($workCompany[0]) && isset($workSummary[0])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);   
                $this->Cell(0, 8, $workCompany[0], 1, 1, '');

                if (!empty($workSummary[0])) {
                    $this->SetX(80); // Set the position for text
                    $this->SetFont('Arial', '', 10);
                    $this->MultiCell(0, 5, $workSummary[0], 1, 1, '');
                    $this->Ln(5);
                } else {
                    $this->Ln(5);
                }
            }        
        }
        if (count($workTitles) >= 2) {
            // PROFESSION
            if (isset($workTitles[1])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(75, 8, $workTitles[1], 1, 0, 'L');
            }

            // DATES
            if (isset($workFirstDate[1]) && isset($workLastDate[1])) {
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 8, $workFirstDate[1], 1, 0, '');
                $this->Cell(5, 8, '-', 1, 0, 'C');
                $this->Cell(20, 8, $workLastDate[1], 1, 1, '');
            }
            
            // COMPANY & SUMMARY
            if (isset($workCompany[1]) && isset($workSummary[1])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);   
                $this->Cell(0, 8, $workCompany[1], 1, 1, '');

                if (!empty($workSummary[1])) {
                    $this->SetX(80); // Set the position for text
                    $this->SetFont('Arial', '', 10);
                    $this->MultiCell(0, 5, $workSummary[1], 1, 1, '');
                    $this->Ln(5);
                } else {
                    $this->Ln(5);
                }
            } 
        }
        if (count($workTitles) >= 3) {
            // PROFESSION
            if (isset($workTitles[2])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(75, 8, $workTitles[2], 1, 0, 'L');
            }

            // DATES
            if (isset($workFirstDate[2]) && isset($workLastDate[2])) {
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 8, $workFirstDate[2], 1, 0, '');
                $this->Cell(5, 8, '-', 1, 0, 'C');
                $this->Cell(20, 8, $workLastDate[2], 1, 1, '');
            }
            
            // COMPANY & SUMMARY
            if (isset($workCompany[2]) && isset($workSummary[2])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);   
                $this->Cell(0, 8, $workCompany[2], 1, 1, '');

                if (!empty($workSummary[2])) {
                    $this->SetX(80); // Set the position for text
                    $this->SetFont('Arial', '', 10);
                    $this->MultiCell(0, 5, $workSummary[2], 1, 0, '');
                    $this->Ln(5);
                }  else {
                    $this->Ln(5);
                }
            } 
        }
        if (count($workTitles) >= 4) {
            // PROFESSION
            if (isset($workTitles[3])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(75, 8, $workTitles[3], 1, 0, 'L');
            }

            // DATES
            if (isset($workFirstDate[3]) && isset($workLastDate[3])) {
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 8, $workFirstDate[3], 1, 0, '');
                $this->Cell(5, 8, '-', 1, 0, 'C');
                $this->Cell(20, 8, $workLastDate[3], 1, 1, '');
            }
            
            // COMPANY & SUMMARY
            if (isset($workCompany[3]) && isset($workSummary[3])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);   
                $this->Cell(0, 8, $workCompany[3], 1, 1, '');

                if (!empty($workSummary[3])) {
                    $this->SetX(80); // Set the position for text
                    $this->SetFont('Arial', '', 10);
                    $this->MultiCell(0, 5, $workSummary[3], 1, 0, '');
                    $this->Ln(5);
                }  else {
                    $this->Ln(5);
                }
            } 
        }
        if (count($workTitles) >= 5) {
            // PROFESSION
            if (isset($workTitles[4])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(75, 8, $workTitles[4], 1, 0, 'L');
            }

            // DATES
            if (isset($workFirstDate[4]) && isset($workLastDate[4])) {
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 8, $workFirstDate[4], 1, 0, '');
                $this->Cell(5, 8, '-', 1, 0, 'C');
                $this->Cell(20, 8, $workLastDate[4], 1, 1, '');
            }
            
            // COMPANY & SUMMARY
            if (isset($workCompany[4]) && isset($workSummary[4])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);   
                $this->Cell(0, 8, $workCompany[4], 1, 1, '');

                if (!empty($workSummary[4])) {
                    $this->SetX(80); // Set the position for text
                    $this->SetFont('Arial', '', 10);
                    $this->MultiCell(0, 5, $workSummary[4], 1, 0, '');
                    $this->Ln(5);
                }  else {
                    $this->Ln(5);
                }
            } 
        }
        if (count($workTitles) >= 6) {
            // PROFESSION
            if (isset($workTitles[5])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(75, 8, $workTitles[5], 1, 0, 'L');
            }

            // DATES
            if (isset($workFirstDate[4]) && isset($workLastDate[4])) {
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 8, $workFirstDate[5], 1, 0, '');
                $this->Cell(5, 8, '-', 1, 0, 'C');
                $this->Cell(20, 8, $workLastDate[5], 1, 1, '');
            }
            
            // COMPANY & SUMMARY
            if (isset($workCompany[5]) && isset($workSummary[5])) {
                $this->SetX(80); // Set the position for text
                $this->SetFont('Arial', 'B', 10);   
                $this->Cell(0, 8, $workCompany[5], 1, 1, '');

                if (!empty($workSummary[5])) {
                    $this->SetX(80); // Set the position for text
                    $this->SetFont('Arial', '', 10);
                    $this->MultiCell(0, 5, $workSummary[5], 1, 0, '');
                    $this->Ln(5);
                }  else {
                    $this->Ln(5);
                }
            } 
        }
         
        /////////////////////// MOTIVATION ////////////////////////
        if (isset($motivation[0])) {
            $this->AddPage();
            $this->SetFont('Arial', '', 15);
    
            // Add Custom header
            $this->Cell(0, 10, 'Motivatie', 0, 0, 'C');
    
            // Add a line break
            $this->Ln(15);

            $this->SetFont('Arial', '', 10);
            $this->MultiCell(0, 5, $motivation[0], 0, 0, '');
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
} else {
    // No resume selected.
    $_SESSION['error'] = 'Select a resume to view as PDF.';
    header('location: ../client.php');          
    exit();
}