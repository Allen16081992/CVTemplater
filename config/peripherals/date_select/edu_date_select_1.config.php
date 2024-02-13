<select name="first_day">
<?= isset($edu_first_day) ? '<option selected>'.htmlspecialchars($edu_first_day).'</option><option>--</option>' : '<option selected>--</option>' ?>
<?php
    for ($day = 1; $day <= 31; $day++) {
        // Format the day with leading zero if it's a single digit
        $formattedDay = sprintf('%02d', $day);
        echo '<option value="'.$formattedDay.'">'.$formattedDay.'</option>';
    }
?>
</select>
<select name="first_month">
<?= isset($edu_first_month) ? '<option selected>'.htmlspecialchars($edu_first_month).'</option><option>--</option>' : '<option selected>--</option>' ?>
<?php
    for ($month = 1; $month <= 12; $month++) {
        // Format the month with leading zero if it's a single digit
        $formattedMonth = sprintf('%02d', $month);
        echo '<option value="'.$formattedMonth.'">'.$formattedMonth.'</option>';
    }
?>
</select>
<select name="first_year">
<?= isset($edu_first_year) ? '<option selected>'.htmlspecialchars($edu_first_year).'</option><option>----</option>' : '<option selected>----</option>' ?>
<?php
    $currentYear = date('Y');
    $targetYear = 1926;
    for ($year = $currentYear; $year >= $targetYear; $year--) {
        echo '<option value="'.$year.'">'.$year.'</option>';
    }
?>
</select>