<?php // Dhr. Allen Pieter

    // Parse and format the birthdate
    $work1Obj = DateTime::createFromFormat('j/n/Y', $data['experience']['firstDate']);
    $work2Obj = DateTime::createFromFormat('j/n/Y', $data['experience']['lastDate']);

    $edu1Obj = DateTime::createFromFormat('j/n/Y', $data['education']['firstDate']);
    $edu2Obj = DateTime::createFromFormat('j/n/Y', $data['education']['lastDate']);
    
    if ($work1Obj && $work2Obj) {
        // Format the birthdate as DD-MM-YYYY
        $formatFirstW = $work1Obj->format('d-m-Y');
        $formatLastW = $work2Obj->format('d-m-Y');

        // Split the birthdate using the formatted value
        $wfirst = explode('-', $formatFirstW);
        $wlast = explode('-', $formatLastW);

        // Prepare the $birthdate array as needed
        $wFday = $wfirst[0];
        $wFmonth = $wfirst[1];
        $wFyear = $wfirst[2];

        $wLday = $wlast[0];
        $wLmonth = $wlast[1];
        $wLyear = $wlast[2];
    }

    if ($edu1Obj && $edu2Obj) {
        // Format the birthdate as DD-MM-YYYY
        $formatFirstE = $eduO1bj->format('d-m-Y');
        $formatLastE = $eduO2bj->format('d-m-Y');

        // Split the birthdate using the formatted value
        $efirst = explode('-', $formatFirstE);
        $elast = explode('-', $formatLastE);

        // Prepare the $birthdate array as needed
        $eFday = $efirst[0];
        $eFmonth = $efirst[1];
        $eFyear = $efirst[2];

        $eLday = $elast[0];
        $eLmonth = $elast[1];
        $eLyear = $elast[2];
    }