<?php 

	// USER SIGNOUT FILE

    require_once ("../system/DatabaseConnector.php");

    unset($_SESSION['LVNUser']);

	redirect(PROOT . 'auth/signin');