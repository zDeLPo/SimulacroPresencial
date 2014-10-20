<?php
	require_once ($URLBASE.'sql/accesos.php');
	require_once ($URLBASE.'libs/errores.php');
	// se obtiene la bandera de error y el tipo de inscripcion
	$bandError=$_GET['bd'];
	$ti=$_GET['ti'];
        
        
        session_start();
	$oPostulante = unserialize( $_SESSION['sPostulante'] );
	$oOperacion = unserialize( $_SESSION['sOperacion'] );
	
	
        
        
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>.: OCA :. Poceso de inscripci&oacute;n Simulacro Presencial - Paso 1</title>
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

<body  onload="initPage('form01');">
<?php 
	include ("cabecera.php");
	imprimeError( $bandError );
?>

<div  class="cuerpo">

<form  action="control0102.php" method="post" name="form01">
<input name="formActual" type="hidden"  value="form01" />

<input name="tipoInscripcion" type="hidden"  value="<?php echo $ti; ?>" />

<table width="80%" border="0" class="tablaFormulario" align="center">
  <tr>
    <td colspan="2"  class="filaTitulo">
		Ingrese correctamente los datos solicitados:
	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr class="fileTitulo">
        <td colspan="2" class="celdaTitulo">
      	&nbsp;1.0 Datos Personales (tal como aparecen en su partida de nacimiento)
        </td>
  </tr>


  <tr>
        <td align="right"> Tipo de Doc. de Identidad : </td>
        <td>
	  <?php
            if ($oPostulante->cTipoDocumentoCodigo != 'z')
                $pst = $oPostulante->cTipoDocumentoCodigo;
          ?>
            <select class="CajaTexto" name="cboTipoDocumentoIdentidad">
                <option value="z" >(Seleccione)</option>
                    <?php obtenerListaDominio("TIPODOC",$oPostulante->cTipoDocumentoCodigo);?>
            </select>
        </td>
   </tr>

   <tr>
        <td align="right"> N&uacute;mero de Doc. de Identidad : </td>
        <td><?php
            if ($oPostulante->sNumeroDocumento != NULL)
                $cadTemp = "value='$oPostulante->sNumeroDocumento'";
            else
                $cadTemp = '';
            ?>
          <input class="CajaTexto" type="text" name="txtNumeroDocumento" autocomplete="OFF" maxlength="18"<?php echo $cadTemp; ?> /></td>
    </tr>    
    
    <tr>
        <td class="lbl"> Apellido Paterno : </td>
            <td width="50%">
                <input class="CajaTexto" type="text" name="txtApellidoPaterno" 
                       accept=""autocomplete="OFF" onkeypress="return NoaceptaNum(event);" 
                       align=""accesskey=""maxlength="50" value="<?php echo $oPostulante->sApellidoPaterno; ?>" />
            </td>
   </tr>
   <tr>
        <td align="right">  Apellido Materno : </td>
        <td>
            <input class="CajaTexto" type="text" name="txtApellidoMaterno" 
                accept=""autocomplete="OFF" onkeypress="return NoaceptaNum(event);" 
		maxlength"50" value="<?php echo $oPostulante->sApellidoMaterno; ?>" />
        </td>
   </tr>
   <tr>
        <td class="lbl"> Nombres : </td>
        <td>
        <?php
            if ($oPostulante->sNombrePostulante != NULL)
                $cadTemp = "value='$oPostulante->sNombrePostulante'";
            else
                $cadTemp = '';
        ?>
        <input class="CajaTexto" type="text" name="txtNombresPostulante"  width="200" autocomplete="OFF" onkeypress="return NoaceptaNum(event);" <?php echo $cadTemp; ?> />      </td>
    </tr>
    <tr>
        <td align="right" > Correo electr&oacute;nico : </td>
        <td>
            <?php
                if ($oPostulante->sCorreoElectronico != NULL)
                    $cadTemp = "value='$oPostulante->sCorreoElectronico'";
                else
                    $cadTemp = '';
            ?>
          <input class="CajaTexto" type="text" name="txtEmail" autocomplete="OFF" size="40"  <?php echo $cadTemp; ?>/>
        </td>
    </tr>

    <tr>
        <td align="right"> Tel&eacute;fono Fijo o celular: </td>
        <td>
        <?php
            if ($oPostulante->sTelefonoReferencia != NULL)
                $cadTemp = "value='$oPostulante->sTelefonoReferencia'";
            else
                $cadTemp = '';
        ?>
        <input class="CajaTexto" type="text" name="txtTelefonoReferencia" autocomplete="OFF"  onkeypress="return aceptaNum(event);" maxlength="12" <?php echo $cadTemp; ?>/>
        </td>
    </tr>
    <tr>
        <td  align="right">¿Es usted invidente (Ciego)?  :</td>
        <td ><label>
            <?php
                if ($oPostulante->cInvidente != 0)
                $pst = $oPostulante->cInvidente;
            ?>
            <select name="cboInvidente" class="CajaTexto">
              <option value="N" <?php if($pst=='N') echo "selected='selected'";?>>No</option>
              <option value="S" <?php if($pst=='S') echo "selected='selected'";?>>Si</option>
            </select>
            </label>
        </td>
    </tr>

    
 <tr class="fileTitulo">
        <td colspan="2" class="celdaTitulo">
      	&nbsp;2.0 Escuela Academica Profesional
        </td>
  </tr>    
  <tr>
    <td class="lbl">Carrera profesional  : </td>
    <td>
	   	<select  class="CajaTexto" name="cboEAPPostulacion">
	        <option  value="z">(Seleccione)</option>
	        <?php obtenerListaFiltro( "escuela", "esc_vcCodigo", "esc_vcNombre", NULL, "esc_cActivo = 'S'" );?>
	    </select>
    </td>
  </tr>
  
<tr class="fileTitulo">
        <td colspan="2" class="celdaTitulo">
      	&nbsp;3.0 Banco de la Naci&oacute;n 
        </td>
  </tr>       
    
  <tr>
      <td class="lbl">C&oacute;digo de operaci&oacute;n  : </td>
    <td>
    	<input class="CajaTexto" name="txtCodigoOperacion" type="text"  
    		size="30" maxlength="24" autocomplete="OFF" />
        <label id="lblLongitud1" class="Indicadores" >24 Caract&eacute;res  - </label> <a href="#" onclick="mostrarAyuda(document.getElementById(1));">(Ver ayuda)</a>
    </td>
  </tr>    
    
  <tr>
	<td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td  align="center" colspan="2">	
		<input name="salir" type="button" value="Cancelar" onclick="cancelar();" />&nbsp;
		<input name="enviar"  type="button"  value="Siguiente"   onclick="validarForm01(this.form);"/>	
	</td>
  </tr>
</table>
</form>
<br />

</div>
<center>
<div id = "divHelpBancoNacion" class="divHelp">
	<label onclick="mostrarAyuda(this);" style="text-align:right;right:20px;cursor:pointer">Cerrar Ayuda <b>X</b></label>
	<h1 style="text-align:center;">Recibo de pago del Banco de la Naci&oacute;n</h1>
	<p style="text-align:justify; padding: 10px 10px 10px 10px;">El código de operación son los casilleros en recuadro, es decir: los 5 números de Concepto, los 6 de Secuencia, 2 del Día, 3 letras del Mes y 4 del Año, más 4 de Código de Oficina.
			Total de caracteres =  24  
	</p>	
	<center>
	<img src="imagenes/recibobanconacion.jpg" align="middle"  />
	</center>
</div>
</center>
</body>
</html>
