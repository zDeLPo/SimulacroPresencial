<?php
session_start();
require_once ($URLBASE.'libs/clases.php');
$oPostulante = unserialize($_SESSION['sPostulante']);

//validamos FORMULARIO ACTUAL

if ($oPostulante->sFormularioActual != 'control0203') {
	session_destroy();
	header("location:denegado.php");
}


require_once ($URLBASE.'sql/accesos.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: OCA :. Poceso de inscripci&oacute;n - Paso 7</title>
	<link rel="stylesheet" href="./estilo/estilo.css" type="text/css" />
	<script language="JavaScript" src="./libs/scripts.js"> </script>
	<script language="Javascript" type="text/javascript">
		stopRKey;function stopRKey(evt) {
			var evt  = (evt) ? evt : ((event) ? event : null);
			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
			if ((evt.keyCode == 13) && (node.type=="text")) { return false; }
		}
		document.onkeypress = stopRKey;
	</script>
	
</head>

<body >
<?php include ("cabecera.php"); ?>

<div class="cuerpo">
<table width="60%" class="tablaFormulario" align="center">
  <tr>
    <td colspan="2"  class="filaTitulo"> &iexcl; Inscripci&oacute;n realizada con &eacute;xito ! </td>
  </tr>
  <tr>
     <td  colspan="2" align="center">SU C&Oacute;DIGO DE PARTICIPANTE ES :</td>
  </tr>
 
  
  <tr>
    <td  colspan="2"  align="center"  > <h1 class="codigoPostulante"><?php echo $oPostulante->sCodigoPostulante; ?></h1></td>
  </tr>
  <!--
  <tr>
    <td  colspan="2" >La modalidad por la que postula es: </td>
  </tr>
  <tr>
    <td  colspan="2" align="center" ><h2><?php echo $oPostulante->sModalidadNombre; ?></h2></td>
  </tr>
  -->
  <tr>
    <td  colspan="2" >Anote su CODIGO DE PARTICIPANTE arriba mostrado, le servir&aacute; para ubicar el lugar donde rendir&aacute; el examen.</td>
  </tr>
  <tr>
    <td  colspan="2" >Apellido paterno / Apellido materno / Nombres :</td>
  </tr>
  <tr>
    <td  colspan="2" align="center" ><h2><?php echo $oPostulante->sApellidoPaterno.' '.$oPostulante->sApellidoMaterno.' '.$oPostulante->sNombrePostulante; ?></h2></td>
  </tr>
  <tr>
    <td  colspan="2" >Escuela acad&eacute;mico profesional a la que postula :</td>
  </tr>
  <tr>
    <td  colspan="2" align="center" ><h2><?php echo $oPostulante->sEscuelaNombre;?></h2></td>
  </tr>
  <!--
  <tr>
    <td  colspan="2" >Usted rendir&aacute; el examen en la ciudad de : </td>
  </tr>
  <tr>
    <td  colspan="2" align="center" ><h2><?php echo $oPostulante->sSedeNombre;?></h2></td>
  </tr>
  -->
  <tr>
    <td  colspan="2" align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="2" align="center" ><input type="button" value="Imprimir" name="imprimir"  onclick="window.print();" /></td>
  </tr>
   <tr>
    <td  colspan="2" align="center" ><br />
      (Por su seguridad, cierre esta ventana luego de imprimir) </td>
  </tr>
</table>
<?php
session_destroy(); //Destruye la session para evitar retornos...
?>
</div>
</body>
</html>
