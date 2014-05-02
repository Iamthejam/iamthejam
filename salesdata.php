<?php

// Connect to MySQL
$link = mysql_connect( 'localhost', 'root', '' );
if ( !$link ) {
	die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'iamthejam', $link );
if ( !$db ) {
	die ( 'Error selecting database \'iamthejam\' : ' . mysql_error() );
}

$totalResult = mysql_query('SELECT SUM(price) AS price FROM orderdetail;'); 
$totalRow = mysql_fetch_assoc($totalResult); 

$product1Result = mysql_query('SELECT SUM(price) AS price FROM orderdetail WHERE productid = 1'); 
$product1Row = mysql_fetch_assoc($product1Result); 

$product2Result = mysql_query('SELECT SUM(price) AS price FROM orderdetail WHERE productid = 2'); 
$product2Row = mysql_fetch_assoc($product2Result); 

// Print out rows
$prefix = '';
echo "[\n";
    
	echo $prefix . " {\n";
	echo '"product":' . ' "Drugs and Gangs Book"' . ',' . ' "sales": '  . $product1Row['price'] . " },". "\n";
	echo '{ "product":' . ' "We Will Get Them CD"'. ',' . ' "sales": ' .$product2Row['price'] . " },". "\n";
	echo '{ "product": ' . '"Total Sales"' . ', ' .'"sales": ' . $totalRow['price'] . " }". "\n";
echo "\n]";

// Close the connection
mysql_close($link);

?>
