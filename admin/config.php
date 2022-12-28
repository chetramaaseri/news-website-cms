<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'news_cms';

date_default_timezone_set('Asia/Kolkata'); 
$HOSTADDRESS = 'http://localhost/projects/News_WebPhpCopy';
$conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if(!$conn){
    die(mysqli_connect_error()($conn));
}
?>