<h3>Voeg Foto's Toe</h3>
<?php
require('../db_connect.php');
require('../functions.php');
?>
  <div id="fileUpload" class="fileUpload col-md-2" count='1'>
    <i id="removeImage" class="fa fa-times" style="font-size: 18px;" aria-hidden="true"></i>
    <img src="" id="formImage">
    <i id="uploadIcon" class="fa fa-upload fa-9x" aria-hidden="true" ></i>
    <p id="uploadImageText">Select or drag your image into this box</p>
    <input type="file" name="fileToUpload_1" id="fileToUpload" class="fileToUpload" value="Choose Image">
  </div>
