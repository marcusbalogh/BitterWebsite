<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Simple PHP Exercise</title>
    </head>
    <body>
        <?php
       
        // .1
        $var1= 10;
        $var2= 10;
        $_1equals2 = ($var1 == $var2 ? "EQUAL<BR>" : "not equal<BR>");
        echo $_1equals2;
        
        // 2.
        echo "<table style='padding: 5px; border: 1px solid black '>";
        for ($row=1; $row <8;$row++)
        {
            
            echo "<tr>" ;
            for ($col=1; $col<8; $col++)
            {
                echo "<td style='text-align: center; padding: 5px; border: 1px solid black  ' >" . $col * $row  . "</td>";
            }
            echo "</tr>";
            
        }
        echo "</table>";
        
        // 3.
         echo "<table style='padding: 5px; border: 1px solid black '>";
       
        //https://www.w3schools.com/php/php_arrays_multi.asp
        //https://stackoverflow.com/questions/28223142/php-echo-specific-column-multi-dimensional-array
        $fruits  = array(
            array("Apples",4),
            array("Oranges",1.99),
            array("Bananas",0.89));
        
        
        
        
            foreach ( $fruits as $f)
        {
            echo
         "<tr>".
            "<td style='color:blue; text-align:center; padding:5px; border:1px solid black'>".$f[0]." cost" ."</td>".
            "<td style='text-align:center; padding:5px; border:1px solid black'>".$f[1] . "</td>"
        ."</tr>";
        }
        //echo sizeof($fruits);
        echo "<table>";
        ?>
       
       
       
    </body>
</html>
