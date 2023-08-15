<?php // Dhr. Allen Pieter

    // Parse and format the birthdate
    $dateObj = DateTime::createFromFormat('j/n/Y', $contact['birth']);
    
    if ($dateObj) {
        // Format the birthdate as DD-MM-YYYY
        $formattedBirthdate = $dateObj->format('d-m-Y');

        // Split the birthdate using the formatted value
        $birthdate = explode('-', $formattedBirthdate);

        // Prepare the $birthdate array as needed
        $day = $birthdate[0];
        $month = $birthdate[1];
        $year = $birthdate[2];
    }