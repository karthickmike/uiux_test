<?php require_once('inc/StudentClass.php'); 
$std = new Student();

$id = (isset($_GET['id']) && is_numeric($_GET['id']))?$_GET['id']:null; 
$res = $std->addStudentMark($id);
echo $res;