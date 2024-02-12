<select name="first_day">
<option selected><?= isset($edu_first_day) ? htmlspecialchars($edu_first_day) : '--' ?></option>
<?php
    for ($day = 1; $day <= 31; $day++) {
        echo '<option value="'.$day.'">'.$day.'</option>';
    }
?>
</select>
<select name="first_month">
<option selected><?= isset($edu_first_month) ? htmlspecialchars($edu_first_month) : '-' ?></option>
<?php
    for ($month = 1; $month <= 12; $month++) {
        echo '<option value="'.$month.'">'.$month.'</option>';
    }
?>
</select>
<select name="first_year">
<option selected><?= isset($edu_first_year) ? htmlspecialchars($edu_first_year) : '----' ?></option>
<?php
    $currentYear = date('Y');
    $targetYear = 1926;
    for ($year = $currentYear; $year >= $targetYear; $year--) {
        echo '<option value="'.$year.'">'.$year.'</option>';
    }
?>
</select>