<?php 
    $title = 'View Patients';
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

$sql = "SELECT * FROM patients ";

$date = new DateTime();
    $result = mysqli_query($dbc, $sql);
    if($result){
        $i=1;
        while( $row = mysqli_fetch_array($result)){
            echo '<br>Patient'.$i.': ';
            
            echo $row['first_name'];
            echo '||' . $row['last_name'];
            echo '||'. $row['age'] ;
            echo '||'. strtolower($row['gender']);
            echo '||'. strtolower($row['marital_status']);
            echo '||'. strtolower($row['blood_group']) ;
            echo '||'. strtolower($row['address']);
            echo '||'. $row['phone_number'] ;
            echo '|||||'. $date->gettimeofday() ;
        
            $i++;

        }

    }else {

        error('A database error occurred in processing your '.
        'submission.\\nIf this error persists, please '.
        'contact support.');

    }


    ?>

    </body>
    </html>