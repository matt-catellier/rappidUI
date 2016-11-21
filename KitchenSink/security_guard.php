<?php
/*
this page:
-----------------------------------------------------------------------
- determines if user is already logged in
	- if logged in, determines if user's login time has expired
		- if time is expired, forwards them to the logout page
		- if time is NOT expired, do nothing else
	- if not logged in, forwards user to login page
-----------------------------------------------------------------------
*/
session_start();

const SALT = "E%^#@$";
$strong_id =  SALT . $_SERVER["HTTP_USER_AGENT"] . session_id(). $_SERVER["REMOTE_ADDR"] . SALT;

// compare strong_id to the sessions strong_id
// do you need to check the user name still?
if(isset($_SESSION['strong_id']) ) { // logged in
} else { // not logged in
	// echo json_encode(['message'=>'Not authorized.']);
	setcookie('error','Not authorized.');
}
