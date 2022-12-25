<?PHP
include 'connect.php';
$sessionUser='';
if(isset($_SESSION['user'])){
	$sessionUser=$_SESSION['user'];
}
$tpl="include/templets/";
$lang="include/languages/";
$func="include/functions/";
include $lang."eng.php";
include "include/functions/function.php";
?>