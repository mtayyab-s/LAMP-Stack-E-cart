<?php

/*
name: Muhammad Tayyab
id:1001256129
*/
session_start();
session_unset();
session_destroy();
header("location:index.php");
exit;
?>