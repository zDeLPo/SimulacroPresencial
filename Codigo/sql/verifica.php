<?php
require_once ($URLBASE . 'libs/clases.php');
require_once ($URLBASE . 'sql/query.php');

// verifica si el banco esta en la tabla banco
// devuelve false si el banco no ha esta regisrado
// true en caso contrario

function existeBanco($iBanco) {
	$sql = "SELECT " .
	"   count(*) " .
	" FROM " .
	"   banco " .
	" WHERE " .
	"   ( " .
	"     ban_iCodigo = $iBanco " .
	"   )";

	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);
	if ($aEstado[0][0] == 0)
		$bError = false;
	else
		$bError = true;
	return $bError;
}

/**
 * Verifica si el nombre que se registra en el formulario coincide con el nombre
 * de la operación enviada por el banco, para ello compara X caracteres segun el parametro cantidad
 */
function esNombreCorrecto($sNumeroOperacion, $sNombreWeb, $Cantidad) {
	$sql = "SELECT " .
	"   trim(upper(ope_vcNombre)) " .
	" FROM " .
	"   operacion " .
	" WHERE " .
	"   ( " .
	"     ope_vcNumero = $sNumeroOperacion " .
	"   )";

	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aNombre = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);
	
	//$aNombreOperacion = strtoupper(str_replace(' ','',$aNombre[0][0]));
	$aNombreOperacion = strtoupper(str_replace('ñ','',str_replace('Ñ','',str_replace(' ','',$aNombre[0][0]))));
	//echo substr($aNombreOperacion,0,$Cantidad).'-'.substr($sNombreWeb,0,$Cantidad);exit;
	
	if (substr($aNombreOperacion,0,$Cantidad) == substr($sNombreWeb,0,$Cantidad))
		$bCorrecto = true;
	else
		$bCorrecto = false;
	return $bCorrecto;
}


// verifica si hay vacntes para la escuela y 
// modalidad escogida, devuelve true en caso afirmativo
// falso en caso contrario

function hayVacantes($sModalidad, $sEscuela) {
	$sql = "SELECT " .
	"   count(*) " .
	" FROM " .
	"   vacante " .
	" WHERE " .
	"   ( " .
	"     esc_vcCodigo = '" . $sEscuela . "'" .
	"     AND " .
	"     mod_cCodigo = '" . $sModalidad . "'" .
	"     AND " .
	"     vac_iCantidad > 0 " .
	"   )";

	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);
	if ($aEstado[0][0] == 0)
		$bError = false;
	else
		$bError = true;
	return $bError;
}

/*
 * Esta funcion verifica si el exonerado se puede inscribir en la escuela
 * que ha elegido. Primero mira la variable cTodas para constatar si la 
 * forma de inscripcion abarca a todas las escuelas en cuyo caso devuelve
 * verdadero.
 * Luego si es cTodas es falso procede a buscar la escuela elegida por el
 * postulante en la tabla (formainscripcionescuela) que guarda todas las 
 * escuela posibles para la forma de inscripcion elegida.
 */
function hayVacantesSegunFormaInscripcionEscuela($forins_iCodigo, $forins_cTodas, $esc_vcCodigo) {
	if ($forins_cTodas == 'S')
		return true;

	$sql = "SELECT " .
	"   count(*) " .
	" FROM " .
	"   formainscripcionescuela fie " .
	" WHERE " .
	"   ( " .
	"     forins_iCodigo = '" . $forins_iCodigo . "' " .
	"     AND " .
	"     esc_vcCodigo = '" . $esc_vcCodigo . "'" .
	"   )";

	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);
	if ($aEstado[0][0] == 0)
		$bError = false;
	else
		$bError = true;
	return $bError;
}

/*
 * Esta funcion verifica si el exonerado se puede inscribir en la Modalidad
 * que ha elegido. Primero mira la variable cTodas para constatar si la 
 * forma de inscripcion abarca a todas las Modalidades en cuyo caso devuelve
 * verdadero.
 * Luego si es cTodas es falso procede a buscar la Modalidad elegida por el
 * postulante en la tabla (formainscripcionModalidad) que guarda todas las 
 * modalidades posibles para la forma de inscripcion elegida.
 */
function hayVacantesSegunFormaInscripcionModalidad($forins_iCodigo, $forins_cTodas, $mod_cCodigo) {
	if ($forins_cTodas == 'S')
		return true;

	$sql = "SELECT " .
	"   count(*) " .
	" FROM " .
	"   formainscripcionmodalidad fim " .
	" WHERE " .
	"   ( " .
	"     forins_iCodigo = '" . $forins_iCodigo . "' " .
	"     AND " .
	"     mod_cCodigo = '" . $mod_cCodigo . "'" .
	"   )";

	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);
	if ($aEstado[0][0] == 0)
		$bError = false;
	else
		$bError = true;
	return $bError;
}

// verifica si hay vacntes para la escuela y 
// modalidad escogida, devuelve true en caso afirmativo
// falso en caso contrario

function operacionValida($iBanco, $sOperacion) {
	// no saca los extornos	
	$sql = "SELECT " .
	"   pro_vcCodigo," .
	"	cod_vcCodigo," .
	"	con_vcCodigo " .
	" FROM " .
	"   operacion " .
	" WHERE " .
	"   ( " .
	"     ban_iCodigo = " . $iBanco . " " .
	"     AND " .
	"     ope_vcCodigo = '" . $sOperacion . "'" .
	"     AND " .
	"     ope_cExtorno = '1'" .
	"   )";
        //echo $sql; exit;
	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);

	// no existe la operacion
	if ($aEstado == NULL) {
		return 7521;
	}

	// el prospecto no vino en esta operacion
	if ($aEstado[0][0] != $sProspecto) {
		return 7522;
	}

	// verifica si no ha sido usado
	// mirando si hay codigo de postulante
	if ($aEstado[0][1] != NULL) {
		return 7523;
	}
	/**
	 * Si el Numero de cuenta no es el correcto
	 */
	if ($aEstado[0][2] != '09517') {
		return 7594;
	}

	return 0;
}

//Verificamos que el codigo de exoneracion exista en la BD
function codigoExoneradoValido($sCodigoExonerado) {
	$sql = "SELECT " .
	"   opeexo_cAnulado, " .
	"   cod_vcCodigo " .
	" FROM " .
	"   operacionexonerado " .
	" WHERE " .
	"   ( " .
	"     codexo_vcCodigo = " . $sCodigoExonerado . " " .
	"   ) ";
    
	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);

	// no existe la operacion de exoneracion
	if ($aEstado == NULL) {
		return 1521;
	}

	// El codigo de exoneracion a sido anulado
	if ($aEstado[0][0] == 'S') {
		return 1522;
	}

	// verifica si no ha sido usado
	// mirando si hay codigo de postulante
	if ($aEstado[0][1] != NULL) {
		return 1523;
	}

	return 0;

}

// verfica el pago realziado por carpeta de exoneracion - Caso de exonerados primeros puestos
function verificaPagoCarpeta($sBanco, $sNumeroOperacion) {
	$sql = "SELECT  " .
	"  ope_fMonto , " .
	"  cod_vcCodigo  " .
	"FROM  " .
	"  operacion " .
	"WHERE " .
	"  ( " .
	"    ban_iCodigo = '$sBanco' " .
	"    	AND " .
	"    ope_vcNumero = '$sNumeroOperacion' " .
	"    	AND " .
	"    con_vcCodigo = '206066' " .
	"  )";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$registro = array ();
	$registro = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	if ($registro == NULL)
		return 9420;

	if ($registro[0][0] < 20.00)
		return 9421;

	if ($registro[0][1] != NULL)
		return 9422;

	return 0;
}

//Verificamos si el Postulante es rezagado segun la primera
//letra de su apellido
function verificaRezagado($cLetraNombre, $fechaOperacion, $formaInscripcion, $sBanco) {

	$sql = "	SELECT " .
	"   cro_dInicioRegular, " .
	"   cro_dFinRegular, 	" .
	"   cro_dInicioRezagado, " .
	"   cro_dFinRezagado 	" .
	" FROM " .
	"   cronograma " .
	" WHERE " .
	"   ( " .
	"    cro_cLetra = '$cLetraNombre' " .
	"   )";
    
	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegsitros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	//Capturamos la Fecha actual

	//$fFechaActual = strftime("%Y%m%d");
	$fFechaActual = str_replace('-', "", $fechaOperacion);
	$fInicioRegular = str_replace('-', "", $aRegsitros[0][0]);
	$fFinRegular = str_replace('-', "", $aRegsitros[0][1]);
	$fInicioRezagado = str_replace('-', "", $aRegsitros[0][2]);
	$fFinRezagado = str_replace('-', "", $aRegsitros[0][3]);
	
	if ($fFechaActual < $fInicioRegular) {
		$iSituacion = 0; //No es rezagado y no puede Inscribirse
	} else {
		if ($fFechaActual <= $fFinRegular) {
			$iSituacion = 1; //No es rezagado y  puede Inscribirse
		} else {
			if ($fFechaActual < $fInicioRezagado) {
				$iSituacion = 3; //Si es rezagado y  no puede Inscribirse
			} else {
				if ($fFechaActual <= $fFinRezagado) {
					$iSituacion = 3; //Si es rezagado y  si puede Inscribirse
				} else {
					$iSituacion = 4; //Periodo de Inscripciones Cerradas
				}

			}

		}
	}

	// Para permitir que los exonerados que no tienen operacion de pago puedan acceder en cualquier momento	
	if ($formaInscripcion != 1 && $formaInscripcion != 4)
		$iSituacion = 1;

	//Para permitir que los postulantes de provincia puedan inscribirse sin verificacion de cronograma
	//para dejar que sean validados
	/*if ($sBanco == 2)
		$iSituacion = 1;
    */
    
	return $iSituacion;
}

//verifica que lo que se pago en la operacion cubre lo que pide la arifa
// monto abonado entrar a la tabla tarifa 

function verificaMontoAbonado($sModalidadPostulante, $sTipoInstitucion, $cRezagado, $fMontoOperacion, $fFactor, $cFormaIns) {

	$sql = " SELECT " .
	"   t.tar_fMonto, t.tar_fMontoRezagado" .
	" FROM " .
	"   tarifa t " .
	" WHERE " .
	"   ( " .
	"    t.tipins_iCodigo = '$sTipoInstitucion' and " .
	"    t.mod_cCodigo = '$sModalidadPostulante' " .
	"   )";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	if ($cFormaIns == 'e') {
		$fMontoNormal = $aRegistros[0][0] * $fFactor;
		$fMontoRezagado = $aRegistros[0][1] * $fFactor;

	} else {
		$fMontoNormal = $aRegistros[0][0];
		$fMontoRezagado = $aRegistros[0][1];
	}
	//situacion: 0 : pago incorrecto 	1 : Pago Correcto
	$iSituacion = -1;

	if ($cRezagado == 'N') {
		if ($fMontoOperacion >= $fMontoNormal) {
			$iSituacion = 1; //pago correcto
		} else {
			$iSituacion = 0; //pago incorrecto
		}
	}

	if ($cRezagado == 'S') {
		if ($fMontoOperacion >= $fMontoRezagado) {
			$iSituacion = 1; //pago correcto
		} else {
			$iSituacion = 0; //pago incorrecto
		}
	}

	return $iSituacion;

}

//verifica si es valido(1) o invalido(0) la sede elegiada segun el departamento de residencia 
function verificarSede($iSedeCodigo, $iDepartamentoResidencia) {
	$sql = " SELECT " .
	"   dep_vcCodigo " .
	" FROM " .
	"   sededepartamento " .
	" WHERE " .
	"   ( " .
	"    sed_iCodigo = '$iSedeCodigo' " .
	"   )";
	
	$sql2 = " SELECT " .
	"   sed_cDepartamentoTodos " .
	" FROM " .
	"   sede " .
	" WHERE " .
	"   ( " .
	"    sed_iCodigo = '$iSedeCodigo' " .
	"   )";
	$db = Conectarse();
	$consulta = query($sql2, $db);
	$cEstado = extraer($consulta);
	mysql_free_result($consulta);
	
	$iSituacion = 0;	
	if( $cEstado[0][0] == 'S'){
		$iSituacion = 1;
		
	}else{
		$consulta = query($sql, $db);
		$aRegistros = extraer($consulta);
		$iFilas = contar($consulta);
		mysql_free_result($consulta);
			
		for ($i = 0; $i < $iFilas; $i++) {
			if ($aRegistros[$i][0] == $iDepartamentoResidencia) {
				$iSituacion = 1;
				$i = $iFilas;
			}
		}
	}
	mysql_close($db);
	return $iSituacion;
}

// verifica si el prospecto ya fue usado en prospecto
// devuelve 0 si el prospecto no ha sido usado
// <> 0 en caso contrario
function ProspectoUsado($numProspecto) {
	$sql = "SELECT " .
	"    pro_vcCodigo, pro_cUsado,pro_cAnulado " .
	" FROM " .
	"   prospecto " .
	" WHERE " .
	"   ( " .
	"     pro_vcCodigo = '$numProspecto' " .
	"   )";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$cEstado = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	if ($cEstado == 'null') {
		//Prospecto no existe
		$iSituacion = 3;
	} else {
		if ($cEstado[0][2] == 'Y') {
			//El prospecto fue anulado
			$iSituacion = 2;

		} else {
			if ($cEstado[0][1] == 'Y') {
				//Prospecto ya fue usado
				$iSituacion = 1;
			} else {
				//Vàlido para ser usado
				$iSituacion = 0;
			}

		}

	}

	return $iSituacion;
}

function verificaOperacion($sNumeroOperacion, $sNumeroProspecto) {
	$sql = "SELECT " .
	"    o.cod_vcCodigo, c.con_cValidoInscripcion " .
	" FROM " .
	"   operacion o, concepto c " .
	" WHERE " .
	"   ( " .
	"     ope_vcNumero = '$sNumeroOperacion' and
							  pro_vcCodigo = '$sNumeroOProspecto' and
							  o.con_vcCodigo=c.con_vcCodigo	" .
	"   )";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$aResultado = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	if ($aResultado == 'null') {
		$iSituacion = 3; //no existe Operacion pareja Operacion / Prospecto
	} else {
		if ($aResultado[0][1] == 'N') //cuenta habilitada o no
			{
			$iSituacion = 2; //existe pareja Operacion Prospecto pero la cuenta no esta habilitada 

		} else {
			if ($aResultado[0][0] != 'null') {
				$iSituacion = 1; //existe Pareja Operacion / Prospecto  cuenta Habilitada pero Numero de Operacion esta usado		
			} else {
				$iSituacion = 0; //existe pareja de Operacion / Prospecto cuenta habilitada y Numero de Operacion esta Libre

			}
		}

	}

	return $iSituacion;

}

// verfica que el numero de cuenta (concepto) sea
// valido para la inscripcion de postulantes. Esto lo hace
// concepto tenga activado el flag con_usado (1).
// devuelve un valor mayor que 0 en caso de que se pueda usar.
// cero en caso contrario
function verificaOperacionCuenta($sConcepto) { 
	$sql = "SELECT  " .
	"  * " .
	"FROM  " .
	"  concepto " .
	"WHERE " .
	"  ( " .
	"    con_vcCodigo = '$sConcepto' " .
	"    AND " .
	"    con_cValidoInscripcion = '1' " .
	"  )";
	$db = Conectarse();
	$consulta = query($sql, $db);
	$cuenta = contar($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	return $cuenta;
}

//verifica si la escuela elegida es valida se encuentra 
//dentro de su Area 
//0 dentro de area
//1 no esta en el area

function verificaEscuelaArea($sEscuelaPostulante, $sEscuelaOrigen) {

	//echo $sEscuelaPostulante. " - " .$sEscuelaOrigen;exit;
	$sql1 = " SELECT  " .
	"  are_cCodigo " .
	"FROM  " .
	"  escuela " .
	"WHERE " .
	"  (" .
	"esc_vcCodigo='" . $sEscuelaPostulante . "'" .
	"  )";

	$sql2 = " SELECT  " .
	"  are_cCodigo " .
	"FROM  " .
	"  escuela " .
	"WHERE " .
	"  (" .
	"esc_vcCodigo='" . $sEscuelaOrigen . "'" .
	"  )";

	$db = Conectarse();
	$consulta1 = query($sql1, $db);
	$registros1 = array ();
	$registros1 = extraer($consulta1);

	$consulta2 = query($sql2, $db);
	$registros2 = array ();
	$registros2 = extraer($consulta2);

	mysql_free_result($consulta1);
	mysql_free_result($consulta2);
	mysql_close($db);

	$iArea1 = $registros1[0][0];
	$iArea2 = $registros2[0][0];

	//echo $iArea1." - ".$iArea2;exit;
	if ($iArea1 == $iArea2) {

		return 0;
	} else {
		return 1;
	}
}

function verificaCodCole($codigo, $tipoColegio) {
	//se valida el tipo de colegio y codigo de colegio ingresado segun monto del pago realizado

	if ($tipoColegio == '0')
		$cad = " AND   tipins_iCodigo = '$tipoColegio' ";
	else
		$cad = '';

	$sql = " SELECT " .
	"  col_vcNombre " .
	" FROM  " .
	"  colegio " .
	" WHERE " .
	"  col_vcCodigo = '$codigo' " . $cad;

	$num = 0;
	$db = Conectarse();
	$consulta = query($sql, $db);
	$num = contar($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	return $num;
}

// Verifica que el colegio elegido sea del departamnto de Lima o e Callao sean correctos

function isColegioLIMACALLAO($sCodigoModularColegio) {

	$sql = "SELECT  " .
	"  col_vcDepartamento " .
	"FROM  " .
	"  colegio " .
	"WHERE " .
	"  ( " .
	"    col_vcCodigo = '$sCodigoModularColegio' " .
	"  )";
	$aRegistro = array ();
	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistro = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	if ($aRegistro[0][0] == "LIMA")
		return true;
	if ($aRegistro[0][0] == "CALLAO")
		return true;
	return false;

}
/*verifica que la escuela elegida convalida con la escuela de procedencia de otras universidades
*$EscuelaPostulacion es el codigo dela escuela en la UNMSM
*$EscuelaProcedencia es el Codigo de la Escuela en la Universidad de la que Viene
*$Universidad es la universidad de procedencia
*/
function isEscuelaValida($EscuelaPostulacion, $Universidad, $EscuelaProcedencia) {

	$sql = " 	SELECT  " .
	"  		esc_vcCodigo 	" .
	"	FROM  	" .
	"  		universidadescuela	 " .
	"	WHERE " .
	"  ( " .
	"    uniesc_iCodigo = " . $EscuelaProcedencia . " and  " .
	"    uni_vcCodigo = '" . $Universidad . "' " .
	"  )";

	$aRegistro = array ();
	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistro = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	if ($aRegistro[0][0] == $EscuelaPostulacion)
		return true;
	return false;

}

// verifica si hay vacntes para la escuela y 
// modalidad escogida, devuelve true en caso afirmativo
// falso en caso contrario

function esSuperNumerario($sModalidad) {

	$sql = "SELECT " .
	"   mod_cSuperNumerario " .
	" FROM " .
	"   modalidad " .
	" WHERE " .
	"   ( " .
	"     mod_cCodigo = '" . $sModalidad . "'" .
	"   )";
	//echo $sql;exit;
	
	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);

	//echo $aEstado[0][0];exit;
	if ($aEstado[0][0] == 'S')
		$bEstado = true;
	else
		$bEstado = false;
	return $bEstado;
}

function codigoFisicaValido($sCodigoFisica) {

	$sql = "SELECT " .
	"   codfis_cApto " .
	" FROM " .
	"   codigofisica " .
	" WHERE " .
	"   ( " .
	"     codfis_vcCodigo = '" . $sCodigoFisica . "'" .
	"   )";

	$db = Conectarse();
	$rConsulta = query($sql, $db);
	$aEstado = extraer($rConsulta);
	mysql_free_result($rConsulta);
	mysql_close($db);

	//echo $aEstado[0][0];exit;
	if ($aEstado[0][0] == 'S')
		$bEstado = true;
	else
		$bEstado = false;
	return $bEstado;

}
?>