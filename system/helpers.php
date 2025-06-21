<?php

// Sessions For login
function userLogin($user_id) {
	$_SESSION['XPUser'] = $user_id;
    $_SESSION['flash_success'] = 'You are now logged in!';
    redirect(PROOT . 'app/');
}

function user_is_logged_in() {
	if (isset($_SESSION['XPUser']) && $_SESSION['XPUser'] > 0) {
		return true;
	}
	return false;
}

// Redirect admin if !logged in
function user_login_redirect($url = 'auth/login') {
	$_SESSION['flash_error'] = 'You must be logged in to access that page.';
	redirect(PROOT . $url);
}


///////////////////////////////////////////////////

// Sessions For login
function adminLogin($user_id) {
	$_SESSION['XPADMIN'] = $user_id;
    $_SESSION['flash_success'] = 'You are now logged in!';
    redirect(PROOT . 'xd192/');
}

function admin_is_logged_in() {
	if (isset($_SESSION['XPADMIN']) && $_SESSION['XPADMIN'] > 0) {
		return true;
	}
	return false;
}

// Redirect admin if !logged in
function admin_login_redirect($url = 'xd192/logout') {
	$_SESSION['flash_error'] = 'You must be logged in to access that page.';
	redirect(PROOT . $url);
}



// get user details by id
function get_id_details($dbConnection, $id) {
	$statement = $dbConnection->query("SELECT * FROM xpto_users WHERE user_id = '" . $id . "'")->fetch(PDO::FETCH_ASSOC);
	return $statement;
}

 // count transactions by a user
 function count_user_transactions($dbConnection, $id) {
	$statement = $dbConnection->query("SELECT * FROM xpto_transactions WHERE transaction_by = '" . $id . "'")->rowCount();
	return $statement;
 }