<?php
/**
 * @author Shayna Jamieson
 * @version 1.0
 * date: January 13, 2020
 * URL: http://sjamieson.greenriverdev.com/328/cupcakes/success.php
 * description: This is a program that takes user input ie.e name, and cupcakes wanted. The form collects the user data,
 * validates to make sure that a name at at least one cupcake was entered, and then displays an appropriate message.
 * The program calculates the total cost of the order and lets the end user know their total and a summary of items ordered.
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// define cupcake keys and their associated values
$cupcakesArray = array("grasshopper" => "The Grasshopper", "maple" => "Whiskey Maple Bacon",
    "carrot" => "Carrot Walnut", "caramel" => "Salted Caramel Cupcake", "velvet" => "Red Velvet",
    "lemon" => "Lemon Drop", "tiramisu" => "Tiramisu");

// validation variables to track form state
$isValid = false;
$nameIsValid = false;
$cupcakesValid = false;

// variables to set to be used throughout the success page and error message (whichever is appropriate)
$name = "";
$errorText = "";
$orderTotalCost = 0;
$cupcakesOrdered = array();

// make sure that they entered a name
if(isset($_POST["name"]) && trim($_POST["name"]) != "") {
        $nameIsValid = true;
        $name = trim($_POST["name"]);
} else { // name field was not set (invalid)
    $nameIsValid = false;
    $errorText .= "Name field empty<br>";
}

// make sure that at least one cupcake was specified and form wasn't spoofed
if(isset($_POST["cupcakes"])) {
    foreach($_POST["cupcakes"] as $item) {
        if(!in_array($item, $cupcakesArray)) { // check for spoof to make sure their choice is in our associated array
            $cupcakesValid = false;
            $errorText .= "Invalid cupcake(s) entered: $item, etc.<br>";
            break;
        } else { // valid cupcake choice- add to total cost, and add item to ordered array
            $cupcakesValid = true;
            array_push($cupcakesOrdered, $item);
            $orderTotalCost = $orderTotalCost + 3.50;
        }
    }
} else { // invalid- no cupcake option was selected
    $cupcakesValid = false;
    $errorText .= "No cupcakes selected<br>";
}

// if both name and cupcake choices are valid then we declare the user information all valid
if($nameIsValid && $cupcakesValid) {
    $isValid = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Cupcake Fundraiser</title>
</head>
<body>
    <div class="container">
        <?
            // echo the user's summary if $isValid is true
            if($isValid) {
                echo "<h2>Thank you, $name, for your order!</h2><br>";
                echo "<p>Order Summary:</p>";
                echo "<ul>";
                foreach($cupcakesOrdered as $item) {
                    echo "<li>$item</li>";
                }
                echo "</ul><br>";
                echo "<p>Order Total: $".money_format('%i', $orderTotalCost)."</p>"; // two decimal places

            }
            // echo the user errors if $isValid is false
            else {
                echo "<h2>Invalid Information:</h2>";
                echo "<p>$errorText</p>";
            }
        ?>
    </div>
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
