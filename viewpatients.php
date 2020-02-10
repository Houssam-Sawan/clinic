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
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
       $("#btnExport").click(function(e) {
            e.preventDefault();
            //getting data from our table
            var data_type = 'data:application/vnd.ms-excel';
            var table_div = document.getElementById('table_wrapper');
            var table_html = table_div.outerHTML.replace(/ /g, '%20');

            var a = document.createElement('a');
            a.href = data_type + ', ' + table_html;
            //to do : add date instead of random number
            a.download = 'exported_data_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
            a.click();
        });
    });


    function filter(fName, culNum) {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById(fName);
        //filter = input.value;
        filter =  input.value.toUpperCase();
        table = document.getElementById("tab");
        tr = table.getElementsByTagName("tr");
        if(filter != "ALL"){
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[culNum];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                       tr[i].style.display = "filtered";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }else{
            for (i = 0; i < tr.length; i++) {
                        tr[i].style.display = "";
            }
        }

    }

    function filterAll(){
        clearFilter();
        var firstNameVal, lastNameVal, ageVal, genderVal, statusVal, bloodVal, addressVal, phoneVal, dateVal;
        firstNameVal = document.getElementById("first_name").value ;
        lastNameVal = document.getElementById("last_name").value ;
        ageVal = document.getElementById("age").value;
        genderVal = document.getElementById("gender").value;
        statusVal = document.getElementById("status").value ;
        bloodVal = document.getElementById("blood").value ;
        addressVal = document.getElementById("address").value ;
        phoneVal = document.getElementById("phone").value ;
        dateVal = document.getElementById("date").value ;
        if(firstNameVal != null && firstNameVal != ""){
            filter("first_name",0);
        }
        if(lastNameVal != null && lastNameVal != ""){
            filter("last_name",1);
        }
        if(ageVal != null && ageVal != ""){
            filter("age",2);
        }
        if(genderVal != null && genderVal != ""){
            filter("gender",3);
        }
        if(statusVal != null && statusVal != ""){
            filter("status",4);
        }
        if(bloodVal != null && bloodVal != ""){
            filter("blood",5);
        }
        if(addressVal != null && addressVal != ""){
            filter("address",6);
        }
        if(phoneVal != null && phoneVal != ""){
            filter("phone",7);
        }
        if(dateVal != null && dateVal != ""){
            filter("date",8);
        }
    }

    function clearFilter(){
        // Declare variables
        var table, tr, i;
        table = document.getElementById("tab");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
                        tr[i].style.display = "";
            }
    }

    function cleanFilter(){
        clearFilter();
        document.getElementById("first_name").value = "" ;
        document.getElementById("last_name").value = "" ;
        document.getElementById("age").value = "" ;
        document.getElementById("gender").value = "" ;
        document.getElementById("status").value = "" ;
        document.getElementById("blood").value = "" ;
        document.getElementById("address").value = "" ;
        document.getElementById("phone").value = "" ;
        document.getElementById("date").value = "" ;
    }

</script>

<body>
<?php
 include 'nav.php';
?>

<div class="container_fluid">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <h1 class="text-center login-title submit-title">Patients</h1>
            <div class="account-wall">
                <form class="form-add-item" >
                  <fieldset>
                    <input size="15" class="form-control2" placeholder="First Name"  onkeydown="filterAll()" oninput="filterAll()" value="" id="first_name"  name="first_name">
                    <input size="15" class="form-control2" placeholder="Last Name"  onkeydown="filterAll()" oninput="filterAll()" value="" id="last_name"  name="last_name">
                    <input size="1" class="form-control2" placeholder="age" onkeydown="filterAll()" oninput="filterAll()" value="" id="age" name="age">
                    <input size="2" class="form-control2" placeholder="Gender" onkeydown="filterAll()" oninput="filterAll()" value="" id="gender" name="gender">
                    <input size="1" class="form-control2" placeholder="Status" onkeydown="filterAll()" oninput="filterAll()" value="" id="status" name="status">
                    <input size="1" class="form-control2" placeholder="Blood" onkeydown="filterAll()" oninput="filterAll()" value="" id="blood" name="blood">
                    <input size="15" class="form-control2" placeholder="Address" onkeydown="filterAll()" oninput="filterAll()" value="" id="address" name="address">
                    <input size="10" class="form-control2" placeholder="Phone" onkeydown="filterAll()" oninput="filterAll()" value="" id="phone" name="phone">
                    <input size="10" class="form-control2" placeholder="Date" onkeydown="filterAll()" oninput="filterAll()" value="" id="date" name="date">
                    <button type="button" class="btn  btn-lg btn-primary" onclick="cleanFilter()">Clear filters</button>
                  </fieldset>
                  <br>

                  <h1 id="msg" class="text-center login-title"></h1>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    }

    $query =<<<EOF
     SELECT * FROM patients WHERE deleted_at IS NULL ;
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

                                if(! array_key_exists($patientID, $toShow)){
                                    $toShow[$patientID] = array();
                                }
                                array_push($toShow[$patientID], $currentRow);

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
        <th><h4 class="table-title">First Name</h4></th>
        <th><h4 class="table-title">Last Name</h4></th>
        <th style="max-width: 20px"><h4 class="table-title">Age</h4></th>
        <th style="max-width: 30px"><h4 class="table-title">Gender</h4></th>
        <th style="max-width: 30px"><h4 class="table-title">Status</h4></th>
        <th style="max-width: 25px"><h4 class="table-title">Blood</h4></th>
        <th><h4 class="table-title">Address</h4></th>
        <th><h4 class="table-title">Phone</h4></th>
        <th><h4 class="table-title">Date</h4></th>
      </tr>
      <?php

      $out = "";
      foreach($toShow  as $key => $sub ){
         $out = $out . makeTable($key, $sub);
      }
        echo $out;

        ?>

    </table>

    <button id="btnExport" class="btn btn-lg btn-primary store-btn btn-cntr" type="button" >Export to Excel</button>

</div>

    </body>
    </html>
