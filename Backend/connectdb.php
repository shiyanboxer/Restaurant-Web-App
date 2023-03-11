<?php
try {
    $connection = new PDO('mysql:host=127.0.0.1;dbname=restaurantDB', "root", "");
} catch (PDOException $e) {
	echo "Error";
    echo "Error!: ". $e->getMessage(). "<br/>";
	die();
}
?>
