<?php
/*
 * Created on 05/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

function imprimeError( $iBandError ) {
	if ( $iBandError != NULL) $sError = "";
	if ( $iBandError==4567 ) $sError="El banco seleccionado no es válido";
	if ( $iBandError==8740 ) $sError="Debe ingresar un numero de prospecto y un numero de operación";
	
        if ( $iBandError==8741 ) $sError="Debe ingresar sus apellido paterno, apellido materno y nombres";
	if ( $iBandError==8742 ) $sError="Debe ingresar un numero de documento";
	if ( $iBandError==8743 ) $sError="Debe ingresar un numero de telefono valido ";
	if ( $iBandError==8744 ) $sError="Debe ingresar su cuenta de correo electronico  valido";

        
        if ( $iBandError==8543 ) $sError="Debe ingresar un numero de exoneración";
	if ( $iBandError==1521 ) $sError="El codigo de exoneracion es incorrecto o no existe";
	if ( $iBandError==1522 ) $sError="El codigo de exoneracion a sido anulado";
	if ( $iBandError==1523 ) $sError="El codigo de exoneracion ya a sido usado";
	if ( $iBandError==7743 ) $sError="El Numero de Prospecto ya fue utilizado";
	if ( $iBandError==7521 ) $sError="El numero de operacion es incorrecto o no existe";
	if ( $iBandError==7522 ) $sError="El numero de prospecto u operaci&oacute;n no existe o es incorrecto";
	if ( $iBandError==7523 ) $sError="El numero de operacion ya fue usado";
	if ( $iBandError==1485 ) $sError="No puede exonerarse para la escuela escogida";
	if ( $iBandError==1787 ) $sError="No puede exonerarse para la modalidad escogida";
	if ( $iBandError==9420 ) $sError="Numero de operacion por Carpeta de exoneracion no válido.";
	if ( $iBandError==9421 ) $sError="Monto pagado por carpeta de exoneracion insuficiente";
	if ( $iBandError==9422 ) $sError="El Numero de operacion por carpeta de exoneracion ya fue usado";
	if ( $iBandError==7198 ) $sError="El nombre que intenta registrar no es válido, por favor verifique su comprobante de pago.";
	if ( $iBandError==7594 ) $sError="El concepto de pago no corresponde a Simulacro, por favor comuníquese con la OCA o el banco.";
			
	if ( $iBandError != NULL ) {
		echo "<table width='50%' align='center' class='errores'>";
		echo "<tr>";
		echo "    <td >Por favor, verifique los siguientes datos: </td>";
		echo "  </tr>";
		echo "  <tr>";
		echo "    <td><b>" . $sError . "</b></td>";
		echo "  </tr>";
		echo "  <tr>";
		echo "    <td>&nbsp;</td>";
		echo "  </tr>";
		echo "</table>";
	}
}

function imprimeErrores( $aErrores ) {
	$eLista = array ();
	$eLista[0] = "Datos de transaccion bancaria Incorrectos";
	$eLista[1] = "El monto depositado no corresponde con la modalidad de postulacion";
	$eLista[2] = "Debe ingresar los datos del colegio de procedencia";
	$eLista[3] = "Debe seleccionar el sexo - Masculino o Femenino";
	$eLista[4] = "Debe indicar la provincia del colegio";
	$eLista[5] = "Debe indicar el distrito del colegio";
	$eLista[6] = "Debe ingresar el código de colegio. ";
	$eLista[7] = "Código de colegio no válido. ";
	$eLista[8] = "Debe seleccionar una Escuela academico profesional";
	$eLista[9] = "Debe elegir un documento sustentatorio";
	$eLista[10] = "Monto abonado insuficiente 1";
	$eLista[11] = "Monto abonado insuficiente 2";
	$eLista[12] = "Debe seleccionar el departamento del colegio de procedencia";
	$eLista[13] = "Debe seleccionar una modalidad de postulación";
	$eLista[14] = "Debe ingresar el numero de Resolución del CONADIS";
	$eLista[15] = "Modalidad de Postulacion inválida";
	$eLista[16] = "Por la Primera letra de su apellido paterno NO le corresponde la Inscripción en esta fecha. Revise el Cronograma de Inscripción.<br>Por su seguridad debe cerrar esta ventana para realizar la verificación del Cronograma";

	$eLista[17] = "Problemas al momento de conectarse para registrar su inscripción. Por favor reintentelo más tarde o de lo contrario COMUNIQUESE con la Oficina Central de Admisión de la UNMSM";
	$eLista[18] = "Problemas al actualizar su codigo de educacion física, por favor COMUNIQUESE con la Oficina Central de Admisión de la UNMSM"; 
	$eLista[19] = "Problemas al momento de actualizar la operación. Por favor reintentelo más tarde o de lo contrario COMUNIQUESE con la Oficina Central de Admisión de la UNMSM";
	$eLista[20] = "Problemas al actualizar Operacion Exonerado , por favor COMUNIQUESE con la Oficina Central de Admisión de la UNMSM";
	$eLista[21] = "Problemas al momento de actualizar el grupo. Por favor reintentelo más tarde o de lo contrario COMUNIQUESE con la Oficina Central de Admisión de la UNMSM";
	$eLista[22] = "Problemas al momento de actualizar la tabla de codigos. Por favor reintentelo más tarde o de lo contrario COMUNIQUESE con la Oficina Central de Admisión de la UNMSM";
	$eLista[23] = "Problemas al actualizar el estado del prospecto, por favor intentelo de nuevo más tarde.";
	$eLista[24] = "Problemas al registrar sus datos de postulación, vuelva a intentarlo de lo contrario COMUNIQUESE con la Oficina Central de Admisión de la UNMSM. ";
	$eLista[25] = "El codigo de exonerado que ingresó ya fué usado por otro postulante. COMUNIQUESE con la Oficina Central de Admisión de la UNMSM.";
	$eLista[26] = "El código de postulante que se trató de registrar ya esta usado, vuelva a intentarlo.";
	$eLista[27] = "El numero de prospecto que intenta registrar ya fué usado por otro postulante. COMUNIQUESE con la Oficina Central de Admisión de la UNMSM.";
	$eLista[28] = "El numero de operación que intenta registrar ya fué usado por otro postulante, por favor verifique sus datos. COMUNIQUESE con la Oficina Central de Admisión de la UNMSM.";
	$eLista[29] = "EL codigo de educación física ya fue usado";
			
	//$eLista[27] = "El numero de operacion de carpeta de exoneracion no es válido o ya fue usado.";
	//$eLista[28] = "Debe ingresar el numero de su carpeta de exoneración.";
	//$eLista[29] = "Por la primera Letra de su apellido paterno, falta para que sea fecha de su inscripcion .";
	$eLista[30] = "no es Rezagado y puede inscribirse.";
	$eLista[31] = "es Rezagado y no puede inscribirse.";
	$eLista[32] = "es Rezagado y puede inscricibirse";
	$eLista[33] = "El periodo de inscripcion se ha cerrado";
	$eLista[34] = "La sede seleccionada no corresponde con el departamento de residencia";
	$eLista[35] = "No se permite postular a asa escuela por que no se encuentra dentro del mismo Area";
	$eLista[36] = "El monto abonado es insuficiente";
	$eLista[37] = "Debe de Seleccionar todos los datos obligatorios relativos a la modalidad";
	$eLista[38] = "La escuela de origen y de destino no pertenecen al mismo area"; 
	$eLista[39] = "Por la ubicacion departamental del colegio de procedencia no puede Postular en esta modalidad"; 
	$eLista[40] = "La escuela de la que proviene no convalida con la escuela a la que postula";
	$eLista[41] = "Debe de seleccionar todos sus datos de procedencia obligatorios";
	$eLista[42] = "El Codigo de educación Física ingresado es incorrecto o no existe";

	if ( aErrores != NULL ) { 	
		echo "<table class='errores' width='50%' align='center' >";
		echo "  <tr>";
		echo "    <td>Por favor, verifique los siguientes datos:</td>";
		echo "  </tr>";
		echo "  <tr>";
		echo "    <td><b>";
		$i = 0;
		foreach ( $aErrores as $iError ) {
			$i++;
			echo "<br /> " . $i . ' : ' . $eLista[$iError].'('.$iError.')';
		}
		echo "</td>";
		echo "  </tr>";
		echo "  <tr>";
		echo "    <td>&nbsp;</td>";
		echo "  </tr>";
		echo "</table>";
	}
}

?>
