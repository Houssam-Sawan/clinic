    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">PHARMA</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php">Home</a>
                </li>
            <?php
            if(@$_SESSION['Username'] == 'admin' ){
                echo '<li>
                        <a href="viewproducts.php">View Products</a>
                    </li>
                    <li>
                        <a href="vieworders.php">View Orders</a>
                    </li>
                    <li>
                        <a href="register.php"> Add User</a>
                    </li>
                    <li>
                        <a href="additem.php"> Add Items</a>
                    </li>
                    <li>
                        <a href="addnews.php"> Publish Event</a>
                    </li>';
            }
            if(@$_SESSION['LoggedIn'] == 1 ){
                echo '<li>
                        <a href="submitinventory.php">Submit Invertory</a>
                    </li>';
                echo '<li>
                        <a href="submitorder.php">Submit Order</a>
                    </li>';
            }
            ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
<!--
                <li>
                    <a href="register.php">
                        <span class="glyphicon glyphicon-user"></span> Sign Up</a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="glyphicon glyphicon-log-in"></span> Login</a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="glyphicon glyphicon-log-out"></span> Logout</a>
                </li>
                <li>
                    <a href="#">testseparator</a>
                </li>
-->
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
