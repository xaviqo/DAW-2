<?php
    if (isset($_REQUEST['id']) || isset($_REQUEST['name'])){
        echo $_REQUEST['name'];
        echo $_REQUEST['id'];
    } else {
        echo "NO EXISTE";
    }
?>