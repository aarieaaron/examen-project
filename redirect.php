<?php
	if (isset($_GET["content"]))			{	include(strtolower($_GET["content"]).".php");	}
  else                              { include("homepage.php");          }
?>
