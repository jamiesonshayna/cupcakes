<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

$cupcakesArray = array("grasshopper" => "The Grasshopper", "maple" => "Whiskey Maple Bacon",
    "carrot" => "Carrot Walnut", "caramel" => "Salted Caramel Cupcake", "velvet" => "Red Velvet",
    "lemon" => "Lemon Drop", "tiramisu" => "Tiramisu");

// validate the user's form input
$isValid = false;
$nameIsValid = false;
$cupcakesValid = false;

// variables to set to be used throughout the success page
$name = "";
$errorText = "";
$orderTotalCost = 0;
$cupcakesOrdered = array();

// make sure that they entered a name
if(isset($_POST["name"]) && trim($_POST["name"]) != "") {
        $nameIsValid = true;
        $name = trim($_POST["name"]);
} else {
    $nameIsValid = false;
    $errorText .= "Name field empty<br>";
}

// make sure that at least one cupcake was specified and form wasn't spoofed
if(isset($_POST["cupcakes"])) {
    foreach($_POST["cupcakes"] as $item) {
        if(!in_array($item, $cupcakesArray)) {
            $cupcakesValid = false;
            $errorText .= "Invalid cupcake: $item<br>";
            break;
        } else {
            $cupcakesValid = true;
            array_push($cupcakesOrdered, $item);
            $orderTotalCost = $orderTotalCost + 3.50;
        }
    }
} else {
    $cupcakesValid = false;
    $errorText .= "No cupcakes selected<br>";
}

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
                echo "<p>Order Total: $".money_format('%i', $orderTotalCost)."</p>";

            }
            // echo the user errors if $isValid is false
            else {
                echo "<h2>Invalid Information:</h2>";
                echo "<p>$errorText</p>";
            }
        ?>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
