<?php
    // $_POST - global variable
    //won't get here the first time you visit the page
    //will only get if a form has been submitted via post
if (isset($_POST["txtName"])) {
    
    //INCLUDE
    include ("../../connect.php");
    //put the include files at the top
    // ../ goes back a folder
    
    $name = $_POST["txtName"];
    $email = $_POST["txtEmail"];
    
    
    echo $name . " " . $email;
    
    //constants
    /*define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "productsdemo");
    global $con;                               //global var
        $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);  
    
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }*/
    echo "<br>";
    $sql = "select * from products";
    if ($result = mysqli_query($con, $sql)){
        // this is useful for getting the number of rows
        // echo mysqli_num_rows($result) . "<br>";
        
        while ($row = mysqli_fetch_array($result)){
            $msg= $row["Id"] . " " . $row["Category"] . " " . $row["Description"] . "<br>";
        }
    } // end if
    
    
    
    //insert statement
    $prodId = 982;
    $category = "Sportswear";
    $price = 54.00;

    $desc = "Blue Hammer";
    // INSERT
    $sql = "INSERT INTO products (Id, Category, Description, Price, Image)"
            . " VALUES ( $prodId, '$category', '$desc', $price, 1)";
    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1)     $msg= "<br>insert successful<br>";
    else                                                    $msg= "<br>Error on insert<br>";

    
    //UPDATE
    $description = "baseball bat";
    $sql = "Update products set Description = '$description' WHERE Id = $prodId";
    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
    $msg= "Update succesfull <br>";
    }
    elseif (mysqli_affected_rows($con) == 0){
    $msg= "No records updated <br>";
    }
    else  echo " Update Failed <br>";

    // ternary operators on mid-term
    // delete statement
    //DELETE
    //$sql="delete from products where ID=$prodId";
    //mysqli_query($con, $sql);
    //echo (mysqli_affected_rows($con)==1) ? "Deleted<BR>":"Not Deleted<BR>";
    
    
}// end of big if
    
    // a header redirect will sent the user to a diff page
    // ? - url querstring
    // used for sending
    header("location:Chap27.php?message='$msg'");  //
    // ?msg = message

    ?>