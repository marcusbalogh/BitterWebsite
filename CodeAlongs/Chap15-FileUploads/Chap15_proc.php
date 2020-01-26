<?php
//chapter 15 processing
if(isset($_POST['submit'])) {
    //Attempt to upload file
    
    if(empty($_FILES["pic"]["name"])){
        echo 'Error: Please select a file!';

    }
    if($_FILES['pic']['size']>(1024*1024)){ //biiger than 1mb
        unlink($_FILES['pic']['tmp_name']);
        echo 'file to big' ;       
    }
    else{// good scenario
        

        if(move_uploaded_file($_FILES['pic']['tmp_name'],"../../Images/profilepics/" . $_FILES['pic']['name'])){

            echo 'nice message here stating that pic uploaded crrectly';
        }
        else{

            unlink($_FILES['pic']['tmp_name']);
            // back to upload page with a get message saying uploaded failed
            echo 'it failed'; 
        }
        //echo $_FILES['pic'];
        // print_r($_FILES['pic']);
   
        // echo $_FILES['pic']['tmp_name'];
    }   
}
?>