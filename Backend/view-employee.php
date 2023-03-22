<!-- cd backend -->
<!-- php -S 127.0.0.1:4002 view-employee.php -->

<?php
include 'connectdb.php';

echo "<html>";
echo "<head>";
echo "<title>View Employees</title>";
echo "<style type='text/css'>";
include 'style.css';
echo "</style>";
echo "</head>";
echo "<body>";
echo "<h1>View Employees</h1>";
echo "<table class='myTable'>";
echo "<caption><h2>See Employee Details</h2></caption>";
echo "<thead>";
echo "<tr>";
echo "<th padding='100px'>Employee Name</th>";
echo "<th padding='100px'>Email</th>";
echo "<th padding='100px'>Employee Type</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$employeeQuery = $connection->prepare("SELECT EmployeeName, EmployeeEmail, EmployeeType FROM Employee");
$employeeQuery->execute();
$employees = $employeeQuery->fetchAll();

foreach ($employees as $employee) {
    echo "<tr><td>{$employee['EmployeeName']}</td><td>{$employee['EmployeeEmail']}</td><td>{$employee['EmployeeType']}</td></tr>";
}

echo "</tbody></table>";
echo "</body>";
echo "</html>";

$connection = NULL;
?>
