<?php
require_once ($URLBASE.'libs/clases.php');
require_once ($URLBASE .'libs/errores.php');
	
session_start();
$oPostulante = unserialize($_SESSION['sPostulante']);
$oOperacion = unserialize($_SESSION['sOperacion']);
$_GET['bd']='';

//Valida formulario actual

if ($oPostulante->sFormularioActual != 'control0102' && $oPostulante->sFormularioActual != 'control0203' && $oPostulante->sFormularioActual != 'form01' ) {
	session_destroy();
	header("location:denegado.php");
}

require_once ($URLBASE.'sql/accesos.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: OCA :. Poceso de inscripci&oacute;n - Paso 6</title>
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
<script language="JavaScript" src="libs/scripts.js"></script>
<?php include ("cabecera.php"); ?>
<?php
	if ( $oPostulante->errDetectados != NULL ) {
		imprimeErrores( $oPostulante->errDetectados );
		$oPostulante->errDetectados = NULL;
	}
?>

<div class="cuerpo">
<form action="control0203.php" method="post" name="form02">
<table  width="80%" class="tablaFormulario" align="center">
  <tr class="filaTitulo">
    <td colspan="2">
VERIFIQUE LOS DATOS QUE SERAN GRABADOS  PARA EL SIMULACRO </td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td  class="celdaTitulo" colspan="2">1.0 Datos Personales : </td>
  </tr>

  <tr>
    <td align="right"> Tipo de Doc. de Identidad : </td>
    <td><?php echo $oPostulante->cTipoDocumentoNombre;?></td>
  </tr>
  <tr>
    <td align="right"> N&uacute;mero de Doc. de Identidad : </td>
    <td><?php echo $oPostulante->sNumeroDocumento ; ?></td>
  </tr>
  
  <tr>
    <td width="54%" align="right">  Apellido Paterno : </td>
    <td width="50%"><?php echo $oPostulante->sApellidoPaterno;?></td>
  </tr>
  <tr>
    <td align="right">   Apellido Materno : </td>
    <td><?php echo $oPostulante->sApellidoMaterno;?></td>
  </tr>
  <tr>
    <td align="right"> Nombres :   </td>
    <td><?php echo $oPostulante->sNombrePostulante; ?></td>
  </tr>
   <tr>
    <td align="right"> Tel&eacute;fono de Referencia : </td>
    <td><?php echo $oPostulante->sTelefonoReferencia;?></td>
  </tr>
  <tr>
    <td align="right" > Correo electr&oacute;nico : </td>
    <td><?php echo $oPostulante->sCorreoElectronico  ;?></td>
  </tr>
    
   <tr>
    <td  align="right">¿Es usted invidente (Ciego)? : </td>
	<td><?php echo $oPostulante->cInvidente; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>

   <tr>
	<td   class="celdaTitulo" colspan="2">2.0 Datos de Postulaci&oacute;n :</td>
	</tr>
   <tr>
   <tr>
		<td  align="right"> Escuela a la que Postula :</td>
		<td><?php echo $oPostulante->sEscuelaNombre ;?></td>
   </tr>
	 
  
  <tr>
    <td colspan="2" >&nbsp;</td>
    </tr>
  
 
  <tr>
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="celdaTitulo" >Declaraci&oacute;n Jurada : </td>
    </tr>
  <tr>
    <td colspan="2" >Declaro bajo juramento que la informaci&oacute;n consignada en el presente registro es verdadera. </td>
    </tr>
  <tr>
    <td colspan="2" >Conozco y acepto todas las disposiciones del Reglamento de Simulacro  de Examen Admisi&oacute;n 2015-I</td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    </tr>
  <tr>
    <td  align="center" colspan="2">	
<input name="salir" type="button" value="Cancelar" onclick="cancelar();" />&nbsp;
<input name="salir" type="button"  value="Modificar" onclick="history.go(-1);" />&nbsp;
<input name="enviar" type="button"  value="Registrar" onclick="advertenciaFinal(this.form);" />	</td>
  </tr>
   <tr>
    <td colspan="2" >&nbsp;</td>
    </tr>
</table>
</form>
 
</body>
</html>

<?php

//Serializamos el Objeto
$oPostulante->sFormularioActual  = 'form04';
$sPostulante = serialize($oPostulante);
$_SESSION['sPostulante'] = $sPostulante;
?>
