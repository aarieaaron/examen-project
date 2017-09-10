<?php
  session_destroy();
  $Link = $_GET['url'];
?>
<script>
  window.location.href =  "<?= $Link ?>";
</script>
