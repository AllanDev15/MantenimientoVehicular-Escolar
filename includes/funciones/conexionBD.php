<?php 
    $con = new mysqli('localhost', 'root', '', 'mantenimiento');
    if($con->connect_error) {
        echo $error -> $con->connect_error;
    }
?>