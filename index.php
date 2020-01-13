<?php
/**
 * @author Shayna Jamieson
 * @version 1.0
 * date: January 13, 2020
 * URL: http://sjamieson.greenriverdev.com/328/cupcakes/index.php
 * description: This is a program that takes user input ie.e name, and cupcakes wanted. The form collects the user data,
 * validates to make sure that a name at at least one cupcake was entered, and then displays an appropriate message.
 * The program calculates the total cost of the order and lets the end user know their total and a summary of items ordered.
 */
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// define cupcake keys and their associated values to display throughout our form
$cupcakesArray = array("grasshopper" => "The Grasshopper", "maple" => "Whiskey Maple Bacon",
    "carrot" => "Carrot Walnut", "caramel" => "Salted Caramel Cupcake", "velvet" => "Red Velvet",
    "lemon" => "Lemon Drop", "tiramisu" => "Tiramisu");
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
    <h1>Cupcake Fundraiser</h1>
    <!-- Form -->
    <form action="success.php" method="post">
        <div class="form-group">
            <label for="name">Your name:</label>
            <input type="text" class="form-control" id="name" name="name" value="" placeholder="Please input your name.">
        </div>
        <p>Cupcake flavors:</p>
        <div class="form-check">
            <?
                // loop through associative array to display cupcake options as a list of checkbox items
                foreach($cupcakesArray as $key => $val) {
                    echo "<input type=\"checkbox\" class=\"form-check-input\" value=\"$val\" id=\"$key\" name=\"cupcakes[]\">";
                    echo "<label class=\"form-check-label\" for=\"$key\">$val</label><br>";
                }
            ?>
        </div>
        <button type="submit" class="btn btn-success mt-3">Order</button>
    </form>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>