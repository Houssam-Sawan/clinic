<?php
$title = 'New Medicin';
include 'head.php';
    if($_SESSION['LoggedIn'] != 1 || $_SESSION['prev'] != "ADMIN"){
        echo '<script language="javascript" type="text/javascript">
        location.href = "index.php";
        </script>
        ';
    }
 ?>
 <body>
 <?php
  include 'nav.php';

  if(!empty($_POST['medicin']))
  {
      $medName = trim($_POST['medicin']);
      $medType = trim(@$_POST['type']);
      $medDose = trim(@$_POST['dose']);
      $notes = trim(@$_POST['notes']);
  
      $sql =<<<EOF
          SELECT * FROM drugs WHERE drug_name = '$medName';
EOF;
  
      $db = new MyDB();
      if(!$db) {
      echo $db->lastErrorMsg();
      } 
  
      $result = $db->query($sql);
      if($result){
          while( $row = $result->fetchArray(SQLITE3_ASSOC)){
              if($row['drug_name'] == $medName){
              error('This medicin already exists.\\n'.
                  'Please try another.');
              }
          }
  
      }else {
          error('A database error occurred in processing your '.
          'submission.\\nIf this error persists, please '.
          'contact Support.');
      }
      $db->close();
      unset($db);
  
      $query =<<<EOF
      INSERT INTO drugs(drug_name, type, dose, notes) 
                    VALUES('$medName', '$medType','$medDose', '$notes');
EOF;
  
      $db = new MyDB();
          if(!$db) {
          echo $db->lastErrorMsg();
          } 
      $result = $db->exec($query);
      if(!$result) {
      echo $db->lastErrorMsg();
      } else {
          echo '<div class="container">
          <div class="row">
              <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                  <h1 class="text-center login-title main-title">Medicin added successfuly</h1>
                  <h1 class="text-center login-title">To add another Medicin please click
                  <a href="adddrugitem.php">here</a></h1>
          </div></div></div>';
      }
      $db->close();
      unset($db);
  
  }
  else
  {
 ?>

 <div class="container">
     <div class="row">
         <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
             <h1 class="text-center login-title main-title">Add Medicin</h1>
             <h1 class="text-center login-title">Please enter Medicin details below to add Medicin.</h1>
                 <div class="account-wall">
                     <form class="form-add-user" method="post" action="adddrugitem.php" name="registerform" id="registerform">
                     <fieldset>
                         <input class="form-control2" placeholder="Medicin*" type="text" name="medicin" id="medicin" autofocus required/>
                         <input class="form-control2" placeholder="Type " value="" name="type" id="type" list="types"/>
                         <input class="form-control2" placeholder="Dose " type="text" name="dose" id="dose"/>
                         <input class="form-control2" placeholder="Notes " type="text" name="notes" id="notes" />
                         <input class="btn btn-lg btn-primary btn-cntr" type="submit" name="adddrugitem" id="adddrugitem" value="Add Medicin" />
                     </fieldset>
                     </form>
                 </div>
         </div>
     </div>
 </div>
 <?php
}
?>
<datalist id="types">
    <option value="Pill"></option>
    <option value="IV"></option>
    <option value="Other"></option>
</datalist>
</div>
</body>
</html>