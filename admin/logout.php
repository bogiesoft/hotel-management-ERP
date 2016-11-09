<?php
session_start();
session_destroy();
unset( $_SESSION['admin_user'] );
unset( $_SESSION );
include_once("../functions/functions.php"); ### contains the redirect() function
redirect("index.php");
?>