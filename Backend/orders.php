<!-- cd backend -->
<!-- php -S 127.0.0.1:4004 orders.php -->

<!-- List all the orders made on a particular date.  
The user should be asked for a  date and you will 
list the first and last name of the customer, 
the items ordered, the total amount of the order, 
the tip, and the name of the delivery person who delivered the order.
 -->

 <?php
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the date from the form submission
  $date = $_POST['date'];

  // Prepare the SQL query to get all orders made on the given date
  $query = $connection->prepare("
    SELECT ro.OrderID, c.FullName AS CustomerFirstName, c.Email AS CustomerLastName, 
    mi.MenuItemName, mi.Price, omi.Quantity, 
    ro.OrderAmount, ro.Tip, e.EmployeeName AS DeliveryPerson
    FROM Restaurant_Order ro
    JOIN Order_Menu_Item omi ON omi.OrderID = ro.OrderID
    JOIN Menu_Item mi ON mi.MenuItemID = omi.MenuItemID
    JOIN Customer c ON c.Email = ro.CustomerEmail
    JOIN Employee e ON e.EmployeeID = ro.EmployeeID
    WHERE ro.OrderDate = ?;
  ");

  // Execute the query with the given date parameter
  $query->execute([$date]);

  // Check if any orders were found
  if ($query->rowCount() > 0) {
    // Print out the table headers
    echo "<html>";
    echo "<head>";
    echo "<title>Orders on $date</title>";
    echo "<style type='text/css'>";
    include 'style.css';
    echo "</style>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Orders on $date</h1>";
    echo "<table class='myTable'>";
    echo "<caption><h2>Order Details</h2></caption>";
    echo "<thead>";
    echo "<tr>";
    echo "<th style='padding: 20px;'>Customer Full Name</th>";
    echo "<th style='padding: 20px;'>Order Total</th>";
    echo "<th style='padding: 20px;'>Tip</th>";
    echo "<th style='padding: 20px;'>Delivery Person</th>";
    echo "<th style='padding: 20px;'>Items Ordered</th>";  
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through each order and print out its details
    // while ($row = $query->fetch()) {
    //   echo '<pre>';
    //   print_r($row);
    //   echo '</pre>';

    //   echo "<tr>";
    //   echo "<td>{$row['CustomerFirstName']}</td>";
    //   echo "<td>{$row['MenuItemName']}</td>";
    //   echo "<td>{$row['OrderAmount']}</td>";
    //   echo "<td>{$row['Tip']}</td>";
    //   echo "<td>{$row['DeliveryPerson']}</td>";
    //   echo "</tr>";
    // }

    // Initialize variables to keep track of current and previous order IDs
    $currentOrderID = '';
    $previousOrderID = '';

    // Loop through each order and print out its details
    while ($row = $query->fetch()) {
      // echo '<pre>';
      // print_r($row);
      // echo '</pre>';

      $currentOrderID = $row['OrderID'];

      // If the current order ID is different from the previous order ID,
      // print out a new row with the order details
      if ($currentOrderID !== $previousOrderID) {
        // If this isn't the first row, close the previous row first
        if ($previousOrderID !== '') {
          echo "</td></tr>";
        }

        // Print out the details for the current row
        echo "<tr>";
        echo "<td>{$row['CustomerFirstName']}</td>";
        echo "<td>{$row['OrderAmount']}</td>";
        echo "<td>{$row['Tip']}</td>";
        echo "<td>{$row['DeliveryPerson']}</td>";
        echo "<td>{$row['MenuItemName']}";
        
        // Update the previous order ID to the current one
        $previousOrderID = $currentOrderID;
      } else {
        // If the current order ID is the same as the previous order ID,
        // append the current menu item to the previous row's item list
        echo ", {$row['MenuItemName']}";
      }
    }

    // Close the last row
    echo "</td></tr>";
    
    // Print out the table footer
    echo "</tbody></table>";
    echo "</body>";
    echo "</html>";
  } else {
    // If no orders were found, print out an error message
    echo "<html>";
    echo "<head>";
    echo "<title>Orders on $date</title>";
    echo "<style type='text/css'>";
    include 'style.css';
    echo "</style>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Orders on $date</h1>";    
    echo "No orders found on $date.";
  }

  // Close the database connection
  $connection = NULL;
}
?>
