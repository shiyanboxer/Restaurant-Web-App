<!-- cd backend -->
<!-- php -S 127.0.0.1:4000 orders.php -->

<!-- List all the orders made on a particular date.  
The user should be asked for a  date and you will 
list the first and last name of the customer, 
the items ordered, the total amount of the order, 
the tip, and the name of the delivery person who delivered the order.
 -->

 <?php
include 'connectdb.php';

if (isset($_POST['date'])) {
  $date = $_POST['date'];

  // $query = "SELECT c.FullName AS CustomerFullName, o.OrderAmount, o.Tip, e.EmployeeName, GROUP_CONCAT(mi.MenuItemName SEPARATOR ', ') AS ItemsOrdered
  //           FROM Restaurant_Order o
  //           JOIN Employee e ON o.EmployeeID = e.EmployeeID
  //           JOIN Customer c ON c.Email = (
  //               SELECT ce.CustomerEmail 
  //               FROM Customer_Employee ce 
  //               WHERE ce.EmployeeID = o.EmployeeID 
  //               AND ce.CustomerEmail = c.Email 
  //               LIMIT 1
  //           )
  //           JOIN Order_Menu_Item om ON om.OrderID = o.OrderID
  //           JOIN Menu_Item mi ON mi.MenuItemID = om.MenuItemID
  //           WHERE DATE(o.OrderDate) = '$date'
  //           GROUP BY o.OrderID";
  
  $result = $connection->query($query);
  $orders = array();
  while ($row = $result->fetch()) {
    $customerName = $row["CustomerFullName"];
    $orderAmount = $row["OrderAmount"];
    $tip = $row["Tip"];
    $deliveryPerson = $row["EmployeeName"];

    // Retrieve the items ordered for this order
    $query = "SELECT mi.MenuItemName, omi.Quantity
              FROM Order_Menu_Item omi
              JOIN Menu_Item mi ON omi.MenuItemID = mi.MenuItemID
              WHERE omi.OrderID = {$row['OrderID']}";
    $itemResult = $connection->query($query);

    $itemsOrdered = array();
    while ($itemRow = $itemResult->fetch()) {
      $itemName = $itemRow["MenuItemName"];
      $quantity = $itemRow["Quantity"];
      $itemsOrdered[] = array("name" => $itemName, "quantity" => $quantity);
    }

    $order = array(
      "customer" => $customerName,
      "orderAmount" => $orderAmount,
      "tip" => $tip,
      "deliveryPerson" => $deliveryPerson,
      "itemsOrdered" => $itemsOrdered
    );

    $orders[] = $order;
  }

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($orders);
}

$connection = NULL;
?>
