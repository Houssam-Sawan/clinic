<?php
    $title = 'Patient Details';
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

  $patientID = $_GET['id'];
  echo $patientID;

  $db = new MyDB();
  if(!$db){
      echo $db->lastErrorMsg();
  }

  $query =<<<EOF
   SELECT * FROM patients WHERE patientID = $patientID ;
EOF;

  $result = $db->query($query);

  $toShow = array();

  if($result){
      while( $row = $result->fetchArray(SQLITE3_ASSOC)){

          $patientID = $row['patientID'];
          $firstName = $row['first_name'];
          $lastName =  $row['last_name'];
          $age = $row['age'] ;
          $gender = ucfirst($row['gender']);
          $maritalStatus =  ucfirst($row['marital_status']);
          $bloodGroup = ucfirst($row['blood_group']) ;
          $address = ucfirst($row['address']);
          $phone = $row['phone_number'] ;
          $createdAtStamp = $row['created_at'] ;
          $createdAt = @date("Y-m-d H:i:s", $createdAtStamp);

          $currentRow = array($firstName, $lastName, $age, $gender,
                              $maritalStatus, $bloodGroup, $address, $phone, $createdAt);
      }

  }else {

      error('A database error occurred in processing your '.
      'submission.\\nIf this error persists, please '.
      'contact support.');

  }

  $db->close();
  unset($db);

  ?>
  <div class="container_fluid">
    <?php
    echo $patientID;
    echo $firstName;
    echo $lastName;
    echo $age;
     ?>
  </div>
</body>
</html>
