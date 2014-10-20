<?php
	require_once ($_SERVER['DOCUMENT_ROOT'].'/admision/sql/accesos.php');
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="/admision/libs/estilo.css" type="text/css" />
<script language="JavaScript" src="/admision/libs/scripts.js"> </script>
</head>

<body>
<table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%"  align="center">
			<h1 >Proceso de inscripci&oacute;n: Admisi&oacute;n 2007 - II </h1>
			</td>
          </tr>
		  <tr>
		  <td align="center" class="Titulo2">Busqueda de c&oacute;digo de colegios de Lima </td>
		  </tr>
</table>
<div  align="center" class="cuerpo">
<form action="#" method="post">
  <label>Parte del Nombre : 
  <input type="text" name="pnc" />
  </label>

  <label>Distrito
  <select name="dst">
  	<option value="0">(Seleccione)</option>
	<?php buscaDisColeLima();?>
  </select>
  </label>
  <label>
  <input type="submit" name="Submit" value="Buscar" />
  </label>
</form>
</div>

<div class="cuerpo">
<table width="96%" border="1" class="Tabla1" align="center">
 
  <tr>
    
    <td class="TituloTabla">CODIGO</td>
    <td class="TituloTabla">NOMBRE COLEGIO </td>
    <td class="TituloTabla">DIRECCION</td>
    <td class="TituloTabla">TIPO COLEGIO </td>
  </tr>
  <?php 
  	
	if($_POST['pnc']!=NULL && $_POST['dst']!= NULL)
	{
  	$parte_nom_col= $_POST['pnc'];
	$distritoCol=$_POST['dst'];

  	$registrosCole= array();
  	$registrosCole = buscaColeLima($parte_nom_col,$distritoCol) ;
	$cont=0;
  	foreach($registrosCole as $coles){
		 $cont++;
		
  ?>
  <tr>
    <td><?php echo $coles[0]?></td>
    <td><?php echo $coles[1]?></td>
    <td><?php echo $coles[2]?></td>
    <td><?php echo $coles[3]?></td>
  </tr>
  <?php 
     }//close Foreach
  }//close if
  ?>
</table>
</div>

</body>
</html>
