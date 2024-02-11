<select name="fday">
<option selected>--</option>
<?php
    for ($day = 1; $day <= 31; $day++) {
        echo '<option value="'.$day.'">'.$day.'</option>';
    }
?>
</select>
<select name="fmonth">
<option selected>-</option>
<?php
    for ($month = 1; $month <= 12; $month++) {
        echo '<option value="'.$month.'">'.$month.'</option>';
    }
?>
</select>
<select name="fyear">
<option selected>----</option>
<?php
    $currentYear = date('Y');
    $targetYear = 1908;
    for ($year = $currentYear - 15; $year >= $targetYear; $year--) {
        echo '<option value="'.$year.'">'.$year.'</option>';
    }
?>
</select>