<?php
include "conexion.php";

function query($sql, $link ) 
{ 
 	$consulta=mysql_query($sql,$link); 
   	return $consulta; 
}
 
function extraer($consulta){
    $registros=array();
	if(mysql_num_rows($consulta)!= 0)
	{
		while ( $registro = mysql_fetch_array ($consulta) ) {
  	  		array_push ($registros, $registro);
	  		//echo "aaaa";
	 	}	
	 return $registros;
	}
 	
	 return NULL;
}

function contar($consulta){
	$filas=mysql_num_rows($consulta);
	return $filas;
}

function ejecutaConsulta( $sql, $link) { 
 	$consulta=mysql_query($sql,$link); 
   	return $consulta; 
} 
?>