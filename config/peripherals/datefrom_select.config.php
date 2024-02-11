<select name="day">
<option selected><?= isset($first_day) ? htmlspecialchars($first_day) : '--' ?></option>
<?php
    for ($day = 1; $day <= 31; $day++) {
        echo '<option value="'.$day.'">'.$day.'</option>';
    }
?>
</select>
<select name="month">
<option selected><?= isset($first_month) ? htmlspecialchars($first_month) : '-' ?></option>
<?php
    for ($month = 1; $month <= 12; $month++) {
        echo '<option value="'.$month.'">'.$month.'</option>';
    }
?>
</select>
<select name="year">
<option selected><?= isset($first_year) ? htmlspecialchars($first_year) : '----' ?></option>
<?php
    $currentYear = date('Y');
    $targetYear = 1926;
    for ($year = $currentYear; $year >= $targetYear; $year--) {
        echo '<option value="'.$year.'">'.$year.'</option>';
    }
?>
</select>