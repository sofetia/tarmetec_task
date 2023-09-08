<?php

include('config.php');
include('productdb.php');

$ctrl = new ProductController;


$nameErr = $priceErr = "";
$name = $desc = $quantity = $price = $id = "";
$existing = $ctrl->getAll("id", "");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    if (empty($_POST["id"])) {
        $id = "";
    } else {
        $id = test_input($_POST["id"]);
    }

    if (empty($_POST["name"]) && empty($_POST["id"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }
    
    if (empty($_POST["desc"])) {
        $desc = "";
    } else {
        $desc = test_input($_POST["desc"]);
    }

    if (empty($_POST["quantity"])) {
        $quantity = "";
    } else {
        $quantity = test_input($_POST["quantity"]);
    }

    if (empty($_POST["price"]) && empty($_POST["id"])) {
        $priceErr = "Price is required";
    } else {
        $price = test_input($_POST["price"]);
    }
    if (!empty($_POST["name"]) && !empty($_POST["price"]) && empty($_POST["id"])){
        $ctrl->addProduct($name, $desc, $quantity, $price);
    }
    if (!empty($_POST["id"])){
        $ctrl->updateProduct($id, $name, $desc, $quantity, $price);
    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["namesearch"])) {
        $namesearch = "";
    } else {
        $namesearch = test_input($_POST["namesearch"]);
    }
    if (isset($_POST['sortbyid'])) {
        $existing = $ctrl->getAll("id", $namesearch);
    }
    else if (isset($_POST['sortbyname'])) {
        $existing = $ctrl->getAll("name", $namesearch);
    }
    else if (isset($_POST['sortbydesc'])) {
        $existing = $ctrl->getAll("description", $namesearch);
    } 
    else if (isset($_POST['sortbyquant'])) {
        $existing = $ctrl->getAll("quantity", $namesearch);
    }
    else if (isset($_POST['sortbyprice'])) {
        $existing = $ctrl->getAll("price", $namesearch);
    }
    else {
        $existing = $ctrl->getAll("id", $namesearch);
    }
    
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Product Controller</title>
    </head>
    <style>
    .error {
        color: #FF0000;
    }
    table, th, td {
        border: 2px solid #df1c44;
    }
    .alert {
        color: #ffb233;
    }
    html *
    {
        font-family: Helvetica !important;
    }
    .row {
        display: flex;
        padding: 50px;
    }
    .column {
        padding: 10px;
    }
    .square {
        height: 50px;
        width: 50px;
    }   
    </style>
    <body>
        <img src="https://tarmetec.ee/wp-content/uploads/2019/11/cropped-Tarmetec_2019_hall-01.png" width="160" height="30">
        <button onclick="reloadPage()">Force Reload Page</button>
        <div class="row">
            <div style="column">
                <h2>Product list</h2>

                <table>
                    <tr class="header">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Desc</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Client</th>
                    </tr>
                <?php
                while($row = mysqli_fetch_assoc($existing)){
                    echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
                }
                ?>
                </table>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                    Sort By:
                    <input type="submit" name="sortbyid" value="ID"> 
                    <input type="submit" name="sortbyname" value="Name">
                    <input type="submit" name="sortbydesc" value="Desc"> 
                    <input type="submit" name="sortbyquant" value="Quantity"> 
                    <input type="submit" name="sortbyprice" value="Price">
                </form>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                    Search name: <input type="text" name="namesearch">
                    <input type="submit" name="namesearchbtn" value="Search"> 
                </form>
            </div>


            <div class="square"></div>

            <div style="column">
                <h2>Product add/update</h2>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                    Name: <input type="text" name="name">
                    <span class="error"> <?php echo $nameErr;?></span>
                    <br><br>
                    Description: <input type="text" name="desc">
                    <br><br>
                    Quantity: <input type="number" name="quantity">
                    <br><br>
                    Price: <input type="number" name="price">
                    <span class="error"> <?php echo $priceErr;?></span>
                    <br><br>

                    <p><span class="alert">Only fill this if you wish to update a existing entry</span></p>
                    ID: <input type="number" name="id">
                    <br><br>
                    <input type="submit" name="submit" value="Submit">  
                </form>
            </div>
        </div>
        <script>
            function reloadPage(){
                window.location.reload();
            }
        </script>
    </body>
</html>

