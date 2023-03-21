<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

        <h1>Image Management</h1><br>

        <p>Welcome to the image management page</p><br>
        <p>Please select one of the options below</p><br>

        <h2>Add New Vehicle Image</h2><br>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Vehicle</label>
 <br>
	<?php echo $prodSelect; ?>
	<fieldset>
		<label>Is this the main image for the vehicle?</label>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset>
 <label>Upload Image:</label>
 <input type="file" name="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form><br>
<hr>
<h2>Existing Images</h2><br>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>

<?php unset($_SESSION['message']); 

?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>