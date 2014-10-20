<?php
	session_start();
	require_once ($URLBASE . 'libs/clases.php');
	$oPostulante=unserialize($_SESSION['sPostulante']);


	if($oPostulante->sFormularioActual!='control0203' && $oPostulante->sFormularioActual!='control0304' && $oPostulante->sFormularioActual!='form03'){
		session_destroy();
		header("location:denegado.php");
		}

	require_once ($URLBASE . 'sql/accesos.php');
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: OCA ::. Buscador de colegios</title>
	<link rel="stylesheet" href="./estilo/estilo.css" type="text/css" />
	<script language="JavaScript" src="./libs/scripts.js"> </script>
	
</head>

<body>
<table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%"  align="center">
			<h1 >Simulacro Presencial </h1>
			</td>
          </tr>
		  <tr>
		  <td align="center" class="Titulo2">
		  Busqueda de c&oacute;digo de colegios  del departamento: <?php echo $oPostulante->sDepartamentoColegioNombre; ?>		   </td>
		  </tr>
</table>
<div  align="center" class="cuerpo">
<form action="#" method="post">
  <label>Debe ingresar parte del Nombre :
  <input name="pnc" type="text" class="CajaTexto" />
</label>
	&nbsp;&nbsp;
  Provincia :
  <select name="prv" class="CajaTexto">
  	<option value="0">(Seleccione)</option>
	<?php buscaProvCole($oPostulante->sDepartamentoColegioNombre,$_POST['prv']);?>
  </select>
  
  &nbsp;&nbsp;
  <input type="submit" name="Submit" value="Buscar" />
 
</form>
</div>



  <?php 
  	
	if($_POST['pnc']!=NULL && $_POST['prv']!= NULL)
	{
  	$parte_nom_col= $_POST['pnc'];
	$prov_Col=$_POST['prv'];
	$oPostulante->sProvinciaColegioNombre=$prov_Col;
	$registrosCole= array();
  	$registrosCole = buscaCole($oPostulante->sDepartamentoColegioNombre,$parte_nom_col,$oPostulante->sProvinciaColegioNombre,$oPostulante->iTipoInstitucion) ;
	
		
  ?>
  
<div class="cuerpo" >
<table width="96%" border="1" class="tablaFormulario" align="center">
 <tr>
   <td  class="celdaTitulo" colspan="5" >Seleccione el colegio haciendo click en el c&oacute;digo de colegio  de la lista siguiente : </td>
 </tr>
 <tr>
		  <td align="center" class="Titulo2" colspan="5">Colegios de la Provincia: <?php echo $oPostulante->sProvinciaColegioNombre; ?> </td>
    </tr>
  <tr class="filaTitulo">
    
    <td >CODIGO</td>
    <td >NOMBRE COLEGIO </td>
    <td >DISTRITO</td>
    <td >DIRECCION</td>
	<td >NIVEL</td>
  </tr>
<?php 
	$cont=0;
	if($registrosCole != NULL){
	
  		foreach($registrosCole as $coles){
		 $cont++;
?>
  <tr>
    <td  class="LinkResaltante"><a href=# onclick="aceptaCole( '<?php echo $coles[0]?>')"><?php echo $coles[0]?></a></td>
    <td><a href=# onclick="aceptaCole( '<?php echo $coles[0]?>')"><?php echo $coles[1]?></a></td>
    <td><?php echo $coles[3]?></td>
    <td><?php echo $coles[2]?></td>
	<td><?php echo $coles[4]?></td>
  </tr>
  <?php 
     }//close Foreach
	 }//Close if NULL
  }//close if
  ?>
</table>
</div>
<?php
	 //Serializamos el Objeto
	$oPostulante->sFormularioActual='form03';
	$sPostulante=serialize($oPostulante);
	$_SESSION['sPostulante']=$sPostulante;
?>
</body>
</html>
