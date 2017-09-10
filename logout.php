<?php
  session_destroy();
  $Link = $_GET['url'];
?>
<script>
  window.location.href =  "<?= 'http://examen.aaronvanleijenhorst.xyz'.$Link ?>";
</script>
