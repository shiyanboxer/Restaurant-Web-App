<!-- cd backend -->
<!-- php -S 127.0.0.1:4000 new-customer.php -->

<!-- Provide a way to add a new customer to the database.  
You will need to ask for all the customer information.
You should check to ensure that the customer doesn't already
 exist in the database.  An account should be created for 
 them with $5.00 credit.
 -->

<?php
include 'connectdb.php';

// retrieve customer information from form submission
$fullName = $_POST['full-name'];
$email = $_POST['email'];
$phoneNumber = $_POST['phone'];
$deliveryAddress = $_POST['delivery-address'];

// check if customer already exists in the database
$existingCustomerQuery = $connection->prepare("SELECT * FROM Customer WHERE Email = ?");
$existingCustomerQuery->execute([$email]);
$existingCustomer = $existingCustomerQuery->fetch();

if ($existingCustomer) {
    echo "Customer already exists in the database.";
} else {
    // insert new customer into database
    $newCustomerQuery = $connection->prepare("INSERT INTO Customer (Email, FullName, PhoneNumber, DeliveryAddress) VALUES (?, ?, ?, ?)");
    $newCustomerQuery->execute([$email, $fullName, $phoneNumber, $deliveryAddress]);

    // add $5.00 credit to new customer's account
    $newCustomerPaymentQuery = $connection->prepare("INSERT INTO Payment (PaymentDate, PaymentAmount, Credit) VALUES (?, ?, ?)");
    $newCustomerPaymentQuery->execute([date("Y-m-d"), 0.00, 5.00]);

    echo "New customer added to the database.";
}

$connection = NULL;
?>
