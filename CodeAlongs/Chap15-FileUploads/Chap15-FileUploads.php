<?php
//chapter 15 file uploads (sprint #3)
//https://www.w3schools.com/tags/att_form_enctype.asp
?>
<form action="chap15_proc.php" method="post" enctype='multipart/form-data'>
	Select your image (Must be under 1MB in size): 
	<input type="file" accept='image/*' name="pic" required><br><br>
	<input id="button" type="submit" name="submit" value="Submit">
</form>
