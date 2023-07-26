<?php
        $servername ="localhost";
        $username = "root";
        $password ="";
        $dbname ="quanLySach";
        $conn = new mysqli($servername,$username,$password,$dbname)
            or die("Connect failed " . $conn->connect_error);
?>