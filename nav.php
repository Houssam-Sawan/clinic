    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">CLINIC</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php">Home</a>
                </li>
            <?php
            if(@$_SESSION['Username'] == 'admin'){
                echo '<li>
                        <a href="addpatient.php">Add Patient</a>
                    </li>
                    <li>
                        <a href="viewpatients.php">View Patient</a>
                    </li>
                    <li>
                        <a href="adddrugitem.php">Add Medicine</a>
                    </li>
                    <li>
                        <a href="addprescription.php">Add Prescription</a>
                    </li>
                    <li>
                        <a href="groups.php">Groups</a>
                    </li>
                    <li>
                        <a href="addgroup.php">Add Group</a>
                    </li>
                    <li>
                        <a href="users.php">Users</a>
                    </li>
                    <li>
                        <a href="adduser.php">Add User</a>
                    </li>';
            }
            if(@$_SESSION['LoggedIn'] == 1 ){
                
            }
            ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php
                if(@$_SESSION['LoggedIn'] == 1 ){
                    echo '<li>
                            <a href="index.php">
                            <span class="glyphicon glyphicon-user"></span>     '.@$_SESSION['Username'] .'</a>
                         </li>';
                    echo '<li>
                            <a href="logout.php">
                             <span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>';
                }else{
                    echo '<li>
                            <a href="index.php">
                            <span class="glyphicon glyphicon-log-in"></span> Login</a>
                        </li>';
                }
                 ?>
            </ul>
        </div>
    </nav>
