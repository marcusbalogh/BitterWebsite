<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chapter 3 PHP</title>
    </head>
    <body>
        <?php
        // put your code here please
        /**
         * multi-line comment
         */

         $x = 5;
         $myName = "Jimmy";
         //echo $myNAme;
         echo $myName . "<BR>"; // string concatination
         echo ++$x;
         echo $myName .= " Jam"; // concatination and assign (like +=)
         print "<BR>Hello World<BR>";
         printf ("helo %s<BR>",$myName,$x);
         
         
         $value = (bool) true;
         $value = 'hello world';
         $value = 13264; // octal?.....
         $value = 0xad; // hex
         
         $students [0] = "jimmy";
         
         
         $X = 50;
         $myVar = "5";
         $myVar2= "10";
         // type-juggling
         echo $myVar + $myVar2 . "<BR>";
         echo gettype ($myVar) . "<BR>";
         
         
         // by value
         $myVar2 = $myVar;
         
         // by reference(changing the original also changes my var2)
         $myVar2 =& $myVar;
         echo $myVar2 . "<BR>";
                         
         const PI = 3.12345; // no dollar sign on constant
         echo PI . "<BR>";
         // define ("PI", 3.14);
         echo PI . "<BR>";
        
        ?>
        This is a 
        <?php echo $myName; ?>
        sentance
        
        <!-- short circuit tag -->
        This is a <?=$myName ?> sentance using a short circuit tag.
    </body>
</html>
