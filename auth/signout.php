<?php 

	// USER SIGNOUT FILE

    require_once ("../system/DatabaseConnector.php");

    unset($_SESSION['LVNUser']);
    unset($_SESSION['LVNLC']);
    unset($_SESSION['LVE']);
    unset($_SESSION['sound_played']);

	redirect(PROOT . 'auth/signin');
    