<?php // common.php

date_default_timezone_set("Asia/Baghdad");

function makeTable($index, $array){
    $table = "";
    foreach($array as $key => $row){
        $currentTableRow = "<tr id='$index'>";
        foreach($row as $cell){
            $currentTableRow = $currentTableRow . "<td>" . $cell . "</td>";
        }
        $currentTableRow = $currentTableRow . "<td><a class='btn btn-info' href='patientdetails.php?id=$index' role='button'>Edit</a></td></tr>";

        $table = $table."".$currentTableRow;
    }
    return $table;
}

function error($msg) {
    ?>
    <html>
    <head>
    <script language="JavaScript">
        alert("<?=$msg?>");
        history.back();
    </script>
    </head>
    <body>
    </body>
    </html>
    <?php
    exit;
}
?>
