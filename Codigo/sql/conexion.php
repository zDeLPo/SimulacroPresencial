<?php
function Conectarse() 
{ 
/*
	$bd="simulacropre20151";
	$host = "192.168.0.6";
	$user="admin2009";
	$pass="servidor**2009";
*/

	$bd="simulacropre20151";
	$host = "192.168.0.199";
	$user="root";
	$pass="962929";

   if ( ($conexion=mysql_connect($host,$user,$pass)) ) { 
      mysql_select_db($bd,$conexion);  
   } 
   return $conexion; 
} 
//Conectarse();
?>
