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
