<?php

$conn =new mysqli('localhost','root','','homecare');
if(!$conn)
{
    die(mysqli_error($conn));
} 

?>