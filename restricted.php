
<?php #admin/restricted.php
#####[make sure you put this code before any html output]#####

//starting the session
session_start();

//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
	//if the user is not allowed, display a message and a link to go back to login page
	echo "You are not allowed. <a href='index.php'>back to login page</a>";

	//then abort the script
	exit();
}

/**
 *      ####  CODE FOR LOG OUT #### click here to see the logout tutorial
 */

?>
<!-- RESTRICTED PAGE HTML GOES HERE -->
<?php #admin/restricted.php
// [...]
?>
<!-- RESTRICTED PAGE HTML GOES HERE -->
<!-- add a LOGOUT link before the form -->
<p>
	{ <a href="?log=out">log out</a> }
</p>
