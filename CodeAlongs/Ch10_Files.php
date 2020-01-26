<?php

$path = "D:\SCHOOL\TERM--5\PHP Programming\BITTERLIVE\CodeAlongs\phpDummyFiles/students.txt";

echo "File size of the file in bytes is: " . FILESIZE($path);
echo "<br>Name of file is " . basename($path,".txt");
echo "<br>Folder only is: " . dirname($path);


//relative path
$relPath = "phpDummyFiles/photo.jpg";

echo "<br>Name of file is " . basename($relPath,".txt");
echo "<br>Absolute path is " . realpath($relPath);
echo "<br>File size of the file in KB is: " . round(FILESIZE($relPath)/1024,1);

echo "disk space Remaining:" . disk_free_space("c:") . "<br>";

echo "disk space total GB:" .round(disk_total_space("c:")/1024/1024/1024,2) . "<br>";

//date_defalt_timezone_set("America/Halifax");
echo "file last accessed " . date("m-d-y G:m:sa", fileatime($relPath)) . "<br>";
echo "file last modified " . date("m-d-y G:m:sa", filemtime($relPath)) . "<br>";


//open the file
$myFile = fopen($path, "a+");
fwrite($myFile,"Johny");
rewind($myFile); //Rewind the position of a file pointer

//file end of file
while(!feof($myFile)){

        //echo fgetc($myFile)."<br>";
        echo fgets($myFile)."<br>";
       

        //echo fread($myFile,10). "<br>"; // fread ignores the linefeed character
}
fclose($myFile);
?>