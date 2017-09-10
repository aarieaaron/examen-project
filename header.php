<div class="headerInner">
  <?php
  if(hasRole("admin")){
    ?>
    <a href="/admin"><div id="adminButton">

    </div>Beheerder</a>
    <?php
  }

  if(hasRole("medewerker")){
    ?>
    <a href="/medewerker"><div id="employeeButton">

    </div>Medewerker</a>
    <?php
  }
  ?>
</div>
