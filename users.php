<?php 
    $title = 'Users';
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

    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    }

    $query =<<<EOF
     SELECT * FROM user;
EOF;

    $result = $db->query($query);

    $toShow = array();
    
    if($result){
        while( $row = $result->fetchArray(SQLITE3_ASSOC)){

            $id = $row['ID'];
            $userid = $row['userid'];
           // $password = $row['password'];
            $previligs =  $row['previligs'];
            $fullName = $row['fullname'] ;
            $groupid = $row['groubid'];
            $city = $row['city'];
            $email = $row['email'];
            $phone = $row['phone'] ;
            $notes = $row['notes'] ;

            $currentRow = array($userid, $previligs, $fullName, $groupid, $city, $email, $phone, $notes);

                                if(! array_key_exists($id, $toShow)){
                                    $toShow[$id] = array();
                                }
                                array_push($toShow[$id], $currentRow);

        }

    }else {

        error('A database error occurred in processing your '.
        'submission.\\nIf this error persists, please '.
        'contact support.');

    }

    $db->close();
    unset($db);
?>

<div id="table_wrapper" class="container_fluid account-wall">
    <table class="table table-striped table-bordered table-hover" id="tab">
      <tr>
        <th><h4 class="table-title">User ID</h4></th>
        <th><h4 class="table-title">Previligs</h4></th>
        <th style="max-width: 20px"><h4 class="table-title">Full Name</h4></th>
        <th><h4 class="table-title">Group ID</h4></th>
        <th style="max-width: 30px"><h4 class="table-title">City</h4></th>
        <th><h4 class="table-title">Email</h4></th>
        <th><h4 class="table-title">Phone</h4></th>
        <th><h4 class="table-title">Notes</h4></th>
      </tr>
      <?php
      

      $out = "";
      foreach($toShow  as $sub ){
         $out = $out . makeTable($sub);
      }
        echo $out;

        ?>

    </table>
</div>

    </body>
    </html>