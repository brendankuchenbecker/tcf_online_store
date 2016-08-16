<?php
//Force the browser to clear the shopping cart when it closes.
session_set_cookie_params(0);
//Start a session to save data.
session_start();
//Include store functions.
include ('store_000_functions.php');
//Connect to the correct database.
require ('store_db_connect.php');
echo'
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>TCF Online Store</title>
	<meta charset="utf-8" />
	<link type="text/css" href="css/store.css" rel="stylesheet" media="screen" />
	<link type="text/css" href="css/buttons.css" rel="stylesheet" />
	<script type="text/javascript" src="store_002_javascript_functions.js"></script>
</head>';
?>