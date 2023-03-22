<!-- cd backend -->
<!-- php -S 127.0.0.1:4000 order-dates.php -->

<?php
include 'connectdb.php';

echo "<html>";
echo "<head>";
echo "<title>Order Dates</title>";
echo "<style type='text/css'>";
include 'style.css';
echo "</style>";
echo "</head>";
echo "<body>";
echo "<h1>Order Dates</h1>";
echo "<table class='myTable'>";
echo "<caption><h2>Order Counts by Date</h2></caption>";
echo "<thead>";
echo "<tr>";
echo "<th width='50%'>Date</th>";
echo "<th width='50%'>Number of Orders</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$ordersQuery = $connection->prepare("SELECT DATE(OrderDate) AS OrderDate, COUNT(*) AS OrderCount FROM Restaurant_Order GROUP BY DATE(OrderDate)");
$ordersQuery->execute();
$orders = $ordersQuery->fetchAll();

foreach ($orders as $order) {
    echo "<tr><td>{$order['OrderDate']}</td><td>{$order['OrderCount']}</td></tr>";
}

echo "</tbody></table>";
echo "</body>";
echo "</html>";

$connection = NULL;
?>
