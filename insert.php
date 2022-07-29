<?php
include_once 'con.php';
if(isset($_POST['submit'])){
    $name = $_POST['p_name'];
    $birthDate=$_POST['dob'];
    $comments = $_POST['comments'];
    $gender = $_POST['gender'];
    $service = $_POST['service'];

    $sql = "INSERT INTO tbl_patient (p_name, dob, comments) VALUES('$name','$birthDate','$comments')";
    $sql_gender = "INSERT INTO tbl_gender(type) VALUES('$gender')";
    $sql_service = "INSERT INTO tbl_service (type) VALUES('$service')"; 

    if(mysqli_query($conn, $sql)){
        echo'success';
    }
    if(mysqli_query($conn, $sql_gender)){
        echo'success gender';
    }
    if(mysqli_query($conn, $sql_service)){
        echo ' success service';
    }
    
}