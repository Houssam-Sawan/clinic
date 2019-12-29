<?php 
    $title = 'New User';
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
if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $fullName = trim(@$_POST['fullname']);
    $userType = trim($_POST['type']);
    $groubid = trim($_POST['groubid']);
    $city = trim($_POST['city']);
    $phone = trim(@$_POST['phone']);
    $email = trim(@$_POST['email']);

    $postid = $_POST['username'];
    $sql = "SELECT * FROM user WHERE userid = '$postid'";

    $result = @mysqli_query($dbc, $sql);
    if($result){
        while( $row = mysqli_fetch_array($result)){
            if($row['userid'] == $username)
            error('A user already exists with your chosen userid.\\n'.
                'Please try another.');
        }

    }else {
        error('A database error occurred in processing your '.
        'submission.\\nIf this error persists, please '.
        'contact regester@pharmacy.com.');
    }

    $newpass = $password;
    $postname = $username;
    $newfullname = $fullName;
    $newtype = strtoupper($userType);
    if( strcmp($newtype , "ADMIN") != 0 && strcmp($newtype , "DOCTOR") != 0 )
                           // || strcmp($newtype , "USER") != 0  )
                            {
                                $newtype = "USER";
                            }
    $newgroubid = $groubid;
    $newcity = $city;
    $newphone = $phone;
    $postemail = $email;
    $postnotes = '';

    $query = "INSERT INTO user(ID, userid, password, previligs, fullname, groubid, city, phone, email, notes)
    VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($dbc, $query);

    mysqli_stmt_bind_param($stmt, "sssssssss", $postid, $newpass,$newtype, $newfullname,
                                $newgroubid, $newcity, $newphone ,$postemail, $postnotes);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);

    if($affected_rows == 1){
        //echo '<h1>User added successfuly<h1>';
        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
        echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <h1 class="text-center login-title main-title">User added successfuly</h1>
                <h1 class="text-center login-title">To add another user please click
                <a href="adduser.php">here</a></h1>
        </div></div></div>';
       // echo "<p>We are now redirecting you to login area.</p>";
        //echo <meta http-equiv="refresh" content="2;url=http://example.com/" />
        //echo "<meta http-equiv='refresh' content='=2;url=index.php' />";
       /*echo '<script language="javascript" type="text/javascript">
        location.href = "adduser.php";
        </script>
        ';*/
    }else{
        echo "Error occurred </br>";
        echo @mysqli_error();
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
            <h1 class="text-center login-title main-title">Add User</h1>
            <h1 class="text-center login-title">Please enter your details below to add user.</h1>
                <div class="account-wall">
                    <form class="form-add-user" method="post" action="adduser.php" name="registerform" id="registerform">
                    <fieldset>
                        <input class="form-control2" placeholder="Uername *" type="text" name="username" id="username" required/>
                        <input class="form-control2" placeholder="Password *" type="password" name="password" id="password" required/>
                        <input class="form-control2" placeholder="Full Name" type="text" name="fullname" id="fullname"/>
                        <input class="form-control2" placeholder="User Type *" value="" name="type" id="type" list="types" required/>
                        <input class="form-control2" placeholder="Group Id *" type="text" name="groubid" id="groubid" required/>
                        <input class="form-control2" placeholder="City *" type="text" name="city" id="city" required/>
                        <input class="form-control2" placeholder="Email" type="email" name="email" id="email"/>
                        <input class="form-control2" placeholder="Phone Number" type="tel" name="phone" id="phone" />
                        <input class="btn btn-lg btn-primary btn-cntr" type="submit" name="register" id="register" value="Add User" />
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
    <option value="Admin"></option>
    <option value="DOCTOR"></option>
    <option value="User"></option>
</datalist>
</div>
</body>
</html>