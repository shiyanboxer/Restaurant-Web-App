<!-- cd backend -->
<!-- php -S 127.0.0.1:4000 employee-schedule.php -->

<!-- Allow the user to choose an employee and show their schedule
for Monday to Friday.  Do not show the schedule for Saturday or Sunday, 
even if the employee works on those days. -->

<?php
include 'connectdb.php';

echo "<html>";
echo "<head>";
echo "<title>Employee Schedule</title>";
echo "<style type='text/css'>";
include 'style.css';
echo "</style>";
echo "</head>";
echo "<body>";
echo "<h1>Employee Schedule</h1>";
echo "<table class='myTable'>";
echo "<caption><h2>Weekday Schedule</h2></caption>";
echo "<thead>";
echo "<tr>";
echo "<th width='50%'>Day</th>";
echo "<th width='50%'>Start and End Time</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// retrieve employee information from form submission
$employeeId = $_POST['employee-id'];

// query the database to get the schedule for the selected employee from Monday to Friday
$scheduleQuery = $connection->prepare("SELECT * FROM Schedule WHERE EmployeeID = ? AND Day BETWEEN 2 AND 6");
$scheduleQuery->execute([$employeeId]);
$schedule = $scheduleQuery->fetchAll();

if (count($schedule) > 0) {
    foreach ($schedule as $entry) {
        $dayOfWeek = date('l', strtotime($entry['ScheduleDay']));
        // Check if the day is not Saturday or Sunday before outputting it
        if ($dayOfWeek !== 'Saturday' && $dayOfWeek !== 'Sunday') {
            echo "<tr>";
            echo "<td>" . $dayOfWeek . "</td>";
            echo "<td>" . $entry['StartTime'] . " - " . $entry['EndTime'] . "</td>";
            echo "</tr>";
        }
    }
} else {
    echo "<tr>";
    echo "<td colspan='2'>No schedule data found for the selected employee from Monday to Friday.</td>";
    echo "</tr>";
}
echo "</tbody></table>";
echo "</body>";
echo "</html>";

$connection = NULL;
?>
