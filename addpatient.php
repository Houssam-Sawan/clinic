<?php 
    $title = 'New Patient';
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
if(!empty($_POST['first_name']) && !empty($_POST['age']) && !empty($_POST['gender']) 
    && !empty($_POST['marital_status']) 
        && !empty($_POST['blood_group']) )
{
    $firstName = trim($_POST['first_name']);
    $lastName = trim(@$_POST['last_name']);
    $age = trim($_POST['age']);
    $gender = trim($_POST['gender']);
    $maritalStatus = trim($_POST['marital_status']);
    $bloodGroup = trim($_POST['blood_group']);
    $address = trim(@$_POST['address']);
    $phone = trim(@$_POST['phone']);

    $sql = "SELECT * FROM patients WHERE first_name = '$firstName'";

    $result = mysqli_query($dbc, $sql);
    if($result){
        while( $row = mysqli_fetch_array($result)){
            $foundMatch = $row['first_name'] == $firstName 
            && $row['last_name'] == $lastName
            && $row['age'] == $age
            && strtolower($row['gender']) == strtolower($gender)
            && strtolower($row['marital_status']) == strtolower($maritalStatus)
            && strtolower($row['blood_group']) == strtolower($bloodGroup)
            && strtolower($row['address']) == strtolower($address)
            && $row['phone_number'] == $phone;
        
            if($foundMatch)
            error('This Patient already exists.\\n');
        }

    }else {

        error('A database error occurred in processing your '.
        'submission.\\nIf this error persists, please '.
        'contact support.');

    }

    $query = "INSERT INTO patients(patientID, first_name, last_name, age, gender, marital_status, blood_group, address, phone_number )
    VALUES(Null, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($dbc, $query);

    mysqli_stmt_bind_param($stmt, "ssisssss", $firstName, $lastName, $age, 
                                                $gender, $maritalStatus, $bloodGroup, $address, $phone);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);

    if($affected_rows == 1){
        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
        echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <h1 class="text-center login-title main-title">Patient added successfuly</h1>
                <h1 class="text-center login-title">To add another Patient please click
                <a href="addpatient.php">here</a></h1>
        </div></div></div>';
       
    }else{
        echo "Error occurred </br>";
        echo mysqli_error($dbc);
        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
    }
}
else
{
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <h1 class="text-center login-title main-title">Add Patient</h1>
            <h1 class="text-center login-title">Please enter patient details below.</h1>
                <div class="account-wall">
                    <form class="form-add-patient" method="post" action="addpatient.php" name="patientregisterform" id="patientregisterform">
                    <fieldset>
                        <input class="form-control2" placeholder="First Name *" type="text" name="first_name" id="first_name" required/>
                        <input class="form-control2" placeholder="Last Name" type="text" name="last_name" id="last_name" />
                        <input class="form-control2" placeholder="age *" type="number" min="0" name="age" id="age" required/>
                        <input class="form-control2" placeholder="Gender *" value="" name="gender" id="gender" list="gender_list" required/>
                        <input class="form-control2" placeholder="Marital Status *" value="" name="marital_status" id="marital_status" list="marital_status_list" required/>
                        <input class="form-control2" placeholder="Blood Group *" value="" name="blood_group" id="blood_group" list="blood_group_list" required/>
                        <input class="form-control2" placeholder="Address" type="text" name="address" id="address" />
                        <input class="form-control2" placeholder="Phone Number" type="tel" name="phone" id="phone" />

                        <input class="btn btn-lg btn-primary btn-cntr" type="submit" name="add_patient" id="add_patient" value="Add Patient" />
                    </fieldset>
                    </form>
                </div>
        </div>
    </div>
</div>
<?php
}
?>
<datalist id="gender_list">
    <option value="Male"></option>
    <option value="Female"></option>
    <option value="Other"></option>
</datalist>
<datalist id="marital_status_list">
    <option value="Single"></option>
    <option value="Married"></option>
    <option value="Other"></option>
</datalist>
<datalist id="blood_group_list">
    <option value="A+"></option>
    <option value="A-"></option>
    <option value="B+"></option>
    <option value="B-"></option>
    <option value="AB+"></option>
    <option value="AB-"></option>
    <option value="O+"></option>
    <option value="O-"></option>
    <option value="Other"></option>
</datalist>
</div>
</body>
</html>