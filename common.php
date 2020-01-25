<?php // common.php

function makeTable($array){
    $table = "";
    foreach($array as $key => $row){
        $currentTableRow = "<tr>";
        foreach($row as $cell){
            $currentTableRow = $currentTableRow . "<td>" . $cell . "</td>";
        }
        $currentTableRow = $currentTableRow . "</tr>";

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
