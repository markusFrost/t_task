<?php
 $numb = $_POST['numb'];
 $type = $_POST['group2'];
 
 require_once('DbHelper.php');

$dbHelper = new DbHelper();
$dbHelper->selectDate($numb, $type);
 
 
  
 
 
?>

