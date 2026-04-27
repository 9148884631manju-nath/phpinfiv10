<?php
require_once "lib/phpinfi10.php";foreach($_REQUEST as $k=>$v){$$k=$v;}
$page=(isset($page)=="")?"home":$page; 
$content=(isset($content)=="")?"home":$content;
$appconfig="lib/appconfig.json";
$php10 = new php10($appconfig,$content);
$con = $php10->con("dbcon.json","db");
?>