<?php // Dhr. Allen Pieter
require_once '././peripherals/session_management.config.php';

class Technicals extends Database {
    private $technical;
    private $interest;
    private $language;
    private $resumeID;
    private $userID;

    public function __construct($technical, $language, $interest, $resumeID, $userID) {
        $this->technical = $technical;
        $this->interest = $interest;
        $this->language = $language;
        $this->resumeID = $resumeID;
        $this->userID = $userID;
    }

    public function Createskills() {
        // Initialize an empty array to store the fields and values
        $fields = [];
        $values = [];
    
        // Check if each field is filled in, and add it to the arrays
        if (!empty($this->technical)) {
            $fields[] = "techtitle";
            $values[] = $this->technical;
        } 
        if (!empty($this->language)) {
            $fields[] = "language";
            $values[] = $this->language;
        } 
        if (!empty($this->interest)) {
            $fields[] = "interest";
            $values[] = $this->interest;
        } 
    
        // Construct the SQL query based on the fields and values
        $fieldsStr = implode(", ", $fields);
        $valuesStr = implode(", ", array_fill(0, count($values), "?"));
        $sql = "INSERT INTO technical ($fieldsStr, resumeID, userID) VALUES ($valuesStr, ?, ?)";
    
        // Prepare the SQL statement
        $stmt = $this->connect()->prepare($sql);
    
        // Bind the parameters and execute the statement
        $params = array_merge($values, [$this->resumeID, $this->userID]);
        $stmt->execute($params);
    
        // Handle success or failure
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = 'Skills Saved.'; 
        } else {
            $_SESSION['error'] = 'Skills query failed.';
        }
    
        // Refresh client page.
        header('location: ../client.php');
    }

    public function Updateskills() {
        // Initialize an empty array to store the updates
        $updates = [];
        $params = [];
    
        // Check if each field is filled in, and add it to the updates array
        if (!empty($this->technical)) {
            $updates[] = "techtitle = ?";
            $params[] = $this->technical;
        } 
        if (!empty($this->language)) {
            $updates[] = "language = ?";
            $params[] = $this->language;
        } 
        if (!empty($this->interest)) {
            $updates[] = "interest = ?";
            $params[] = $this->interest;
        } 
    
        // Construct the SQL query based on the updates
        $updatesStr = implode(", ", $updates);
        $sql = "UPDATE technical SET $updatesStr WHERE resumeID = ? AND userID = ?";
    
        // Add resumeID and userID to the parameters array
        $params[] = $this->resumeID;
        $params[] = $this->userID;
    
        // Prepare the SQL statement
        $stmt = $this->connect()->prepare($sql);
    
        // Bind the parameters
        $stmt->execute($params);
    
        // Handle success or failure
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = 'Skills Saved.'; 
        } else {
            $_SESSION['error'] = 'Skills query failed.';
        }
    
        // Refresh client page.
        header('location: ../client.php');
    }    
}