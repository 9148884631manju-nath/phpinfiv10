<?php

// set the timezone
date_default_timezone_set('America/New_York');

// get the current month and year
$month = date('m');
$year = date('Y');

// calculate the number of days in the current month
$num_days = date('t', mktime(0, 0, 0, $month, 1, $year));

// calculate the day of the week for the first day of the month
$first_day = date('N', mktime(0, 0, 0, $month, 1, $year));

// create an array to hold the calendar days
$calendar = array();

// fill in the days of the previous month
$prev_month = $month - 1;
$prev_year = $year;
if ($prev_month == 0) {
    $prev_month = 12;
    $prev_year--;
}
$prev_num_days = date('t', mktime(0, 0, 0, $prev_month, 1, $prev_year));
$prev_days = array_slice(range($prev_num_days - $first_day + 2, $prev_num_days), 0, $first_day - 1);
foreach ($prev_days as $day) {
    $calendar[] = array('day' => $day, 'class' => 'prev-month');
}

// fill in the days of the current month
for ($i = 1; $i <= $num_days; $i++) {
    $calendar[] = array('day' => $i, 'class' => 'current-month');
}

// fill in the days of the next month
$next_month = $month + 1;
$next_year = $year;
if ($next_month == 13) {
    $next_month = 1;
    $next_year++;
}
$next_days = array_slice(range(1, 7 - (count($calendar) % 7)), 0);
foreach ($next_days as $day) {
    $calendar[] = array('day' => $day, 'class' => 'next-month');
}

// output the calendar HTML
echo '<table>';
echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';
foreach (array_chunk($calendar, 7) as $week) {
    echo '<tr>';
    foreach ($week as $day) {
        echo '<td class="' . $day['class'] . '">' . $day['day'] . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

?>