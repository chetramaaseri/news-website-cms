<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'news_cms';

$PUBLICHOSTADDRESS = 'http://localhost/projects/News_WebPhpCopy';
$conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if(!$conn){
    die(mysqli_connect_error()($conn));
}
?>