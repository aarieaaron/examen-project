<div class="headerInner">
  <?php
  if(hasRole("admin")){
    ?>
    <a href="index.php?content=admin"><div id="adminButton">

    </div>Beheerder</a>
    <?php
  }

  if(hasRole("medewerker")){
    ?>
    <a href="index.php?content=medewerker"><div id="employeeButton">

    </div>Medewerker</a>
    <?php
  }
  ?>
</div>
