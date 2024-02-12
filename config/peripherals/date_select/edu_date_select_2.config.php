<select name="last_day">
<option selected><?= isset($edu_last_day) ? htmlspecialchars($edu_last_day) : '--' ?></option>
<?php
    for ($day = 1; $day <= 31; $day++) {
        echo '<option value="'.$day.'">'.$day.'</option>';
    }
?>
</select>
<select name="last_month">
<option selected><?= isset($edu_last_month) ? htmlspecialchars($edu_last_month) : '-' ?></option>
<?php
    for ($month = 1; $month <= 12; $month++) {
        echo '<option value="'.$month.'">'.$month.'</option>';
    }
?>
</select>
<select name="last_year">
<option selected><?= isset($edu_last_year) ? htmlspecialchars($edu_last_year) : '----' ?></option>
<?php
    $currentYear = date('Y');
    $targetYear = 1926;
    for ($year = $currentYear; $year >= $targetYear; $year--) {
        echo '<option value="'.$year.'">'.$year.'</option>';
    }
?>
</select>