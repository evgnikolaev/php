<?
session_start();
if ($_SESSION['auth_user']) {
	echo 'Secret info';
} else {
	echo 'simple page';
}