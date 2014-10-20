<?php


/*
 * Created on 08/08/2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

require_once ($URLBASE . 'libs/clases.php');
require_once ($URLBASE . 'sql/query.php');

function buscaCodigoGrupo($link, $eap) {
	$sql = "SELECT " .
	"	gru_iCodigo " .
	"FROM " .
	"	escuela " .
	"WHERE" .
	"	esc_vcCodigo = '$eap'";
	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	return $registros[0][0];
}

function buscaPunteroGrupo($link, $grupo) { // busca puntero
	$sql = "SELECT " .
	"	gru_iUltimo " .
	" FROM " .
	"	grupo " .
	" WHERE " .
	"	gru_iCodigo = " . $grupo;
	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	return $registros[0][0];
}

function buscaCodigoPostulante($link, $gruCod, $gruNum) {
	$sql = "SELECT " .
	"	cod_vcCodigo " .
	"FROM " .
	"	codigo " .
	"WHERE " .
	"	gru_iCodigo =" . $gruCod .
	"   AND " .
	"	cod_iNumero =" . $gruNum;

	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	return $registros[0][0];
}

function buscaAreaPostulacion($link, $eap) {
	$sql = "SELECT " .
	"	are_cCodigo " .
	"FROM " .
	"	escuela " .
	"WHERE" .
	"	esc_vcCodigo = '$eap'";
	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	return $registros[0][0];
}


function codigoFisicaUsado($link, $sCodigoEducacionFisica){
	$sql = "SELECT " .
	"	cod_vcCodigo  " .
	"FROM " .
	"	codigofisica " .
	"WHERE" .
	"	codfis_vcCodigo  = '".$sCodigoEducacionFisica. "' " ;


	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);

	if ($registros[0][0] != null)
		return true;
	else
		return false;
	
}

function operacionUsado($link, $ban_iCodigo, $ope_vcNumero) {
	$sql = "SELECT " .
	"	cod_vcCodigo , " .
	"	ope_cExtorno " .
	"FROM " .
	"	operacion " .
	"WHERE" .
	"	ban_iCodigo  = $ban_iCodigo " .
	"	AND " .
	"	ope_vcCodigo = '" . $ope_vcNumero . "'";

	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);

	if ($registros[0][0] != "" || $registros[0][1] == '2')
		return true;
	else
		return false;
}

function prospectoUsadoFinal($link, $numProspecto) {
	$sql = "SELECT " .
	"   pro_cUsado ,  " .
	"   pro_cAnulado  " .
	" FROM " .
	"   prospecto " .
	" WHERE " .
	"   ( " .
	"     pro_vcCodigo = '$numProspecto' " .
	"   )";

	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);

	if ($registros[0][0] == 'S' || $registros[0][1] == 'S')
		return true;
	else
		return false;
}

function codigoUsado($link, $codigo) {
	$sql = "SELECT " .
	"   cod_cUsado   " .
	" FROM " .
	"   codigo " .
	" WHERE " .
	"   ( " .
	"     cod_vcCodigo = '$codigo' " .
	"   )";

	$consulta = ejecutaConsulta($sql, $link);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);

	if ($registros[0][0] == 'S')
		return true;
	else
		return false;
}

function codigoExoneradoUsado($link, $codigoExonerado, $bExonerado) {

	if ($bExonerado == 'e') {
		$sql = "SELECT " .
		"   cod_vcCodigo ,  " .
		"   opeexo_cAnulado   " .
		" FROM " .
		"   operacionexonerado " .
		" WHERE " .
		"   ( " .
		"     codexo_vcCodigo = '$codigoExonerado' " .
		"   )";

		//echo $sql;exit;
		$consulta = ejecutaConsulta($sql, $link);
		$registros = array ();
		$registros = extraer($consulta);
		mysql_free_result($consulta);

		if ($registros[0][0] != "" || $registros[0][1] == 'S')
			return true;

	}

	return false;

}

/* Funciones de actualizacion de las tablas transaccionales  */

function actualizaOperacion($link, $iBanco, $sNumeroOperacion, $sCodigoPostulante) {
	$sql = " UPDATE " .
	"	operacion " .
	"SET " .
	"	cod_vcCodigo='" . $sCodigoPostulante . "'" .
	" WHERE " .
	"	ope_vcCodigo = '" . $sNumeroOperacion . "' " .
	" AND	 " .
	"	ban_iCodigo = " . $iBanco;

	$consulta = mysql_query($sql, $link);
	return $consulta;
}

function actualizaProspecto($link, $sCodigoProspecto) {
	$sql = " UPDATE " .
	"	prospecto " .
	" SET " .
	"	pro_cUsado = 'N' " .
	" WHERE " .
	"	pro_vcCodigo = '" . $sCodigoProspecto . "'";
	$consulta = mysql_query($sql, $link);
	// echo $sql;exit;  //Para depurar errores de insercion
	return $consulta;
}

function actualizaCodigo($link, $sCodigoPostulante) {
	$sql = " UPDATE " .
	"	codigo " .
	"SET " .
	"	cod_cUsado = 'S'" .
	"WHERE " .
	"	cod_vcCodigo = '" . $sCodigoPostulante . "'";
	$consulta = mysql_query($sql, $link);
	return $consulta;
}

//Actualiar las banderas de la tabla grupo !!!!!
function actualizaGrupo($link, $gruCod, $gruNum) {
	$sql = "UPDATE " .
	"	grupo " .
	" SET " .
	"	gru_iUltimo = " . $gruNum .
	" WHERE " .
	"	gru_iCodigo = " . $gruCod;

	 $consulta = mysql_query($sql, $link);
	return $consulta;
}

function actualizaOperacionExonerado($link, $sCodigoOperacionExonerado, $sCodigoPostulante) {
	$sql = " UPDATE " .
	"	operacionexonerado " .
	" SET " .
	"	cod_vcCodigo = '$sCodigoPostulante' " .
	" WHERE " .
	"	codexo_vcCodigo = '" . $sCodigoOperacionExonerado . "' ";
	$consulta = mysql_query($sql, $link);
	return $consulta;
}

function actualizaCodigoFisica($link, $sEscuelaCodigo, $sCodigoEducacionFisica, $sCodigoPostulante) {
	if ($sEscuelaCodigo == '062xx') {//Simulacro no requiere codigoEducacionFISICA
		$sql = " UPDATE " .
		"	codigofisica " .
		" SET " .
		"	cod_vcCodigo = '$sCodigoPostulante' " .
		" WHERE " .
		"	codfis_vcCodigo = '" . $sCodigoEducacionFisica . "' ";
		$consulta = mysql_query($sql, $link);
		return $consulta;
	} else
		return true;
}

function insertaPostulante($link, $oPostulante) {
	$fecha = date("Y-m-d");
	$hora = date("H:i:s");

	//para el campo anulado del postulante
	$cAnulado = 'N';


	$sql = "INSERT " .
	"INTO `postulante` " .
	"		( " .
	"		cod_vcCodigo,	" .
	"		pro_vcCodigo,	" .
	"		pos_fMonto,		" .
	"		forins_iCodigo,	" .
	"		esc_vcCodigo,	" .
	"		mod_cCodigo,	" .
	"		pos_vcPaterno,	" .
	"		pos_vcMaterno,	" .
	"		pos_vcNombre,	" .
	"		pos_vcTelefono,	" .
	"		pos_vcEmail,	" .
	"		pos_cInvidente,		" .
	"		pos_dFechaInscripcion,	" .
	"		pos_tHorainscripcion,	" .
	"		pos_vcIp,				" .
	"		sed_iCodigo,	" .
	"		tipdoc_iCodigo,	" .
	"		pos_vcDocumento," .
	"		dep_vcCodigoNacimiento," .
	"		proadm_vcCodigo				" .
	"	) " .
	"VALUES " .
	"   (" .
	"	'" . $oPostulante->sCodigoPostulante . "',	" .
	"	'" . $oPostulante->sNumeroProspecto . "',	" .
	"	'" . $oPostulante->dMontoAbonado . "',		" .
	"	'" . $oPostulante->iFormaInscripcion . "',	" .
	"	'" . $oPostulante->sEscuelaCodigo . "',		" .
	"	'" . $oPostulante->cModalidadCodigo . "',	" .
	"	'" . $oPostulante->sApellidoPaterno . "',	" .
	"	'" . $oPostulante->sApellidoMaterno . "',	" .
	"	'" . $oPostulante->sNombrePostulante . "',	" .
	"	" . zNullChar($oPostulante->sTelefonoReferencia) . "," .
	"	" . zNullChar($oPostulante->sCorreoElectronico) . ",	" .
	"	'" . $oPostulante->cInvidente . "',			" .
	"	'" . $fecha . "',		" .
	"	'" . $hora . "',		" .
	"	'" . $oPostulante->ip_host . "',	" .
	"	'" . $oPostulante->iSedeCodigo . "',	" .
	"	'" . $oPostulante->cTipoDocumentoCodigo . "',		" .
	"	'" . $oPostulante->sNumeroDocumento . "',			" .
	"	'" ."15" ."',			" .
	"	'" ."2015-I" ."' ".
	");";

	// echo $sql;exit;  //Para depurar errores de insercion
	$consulta = mysql_query($sql, $link);
	return $consulta;
}
?>
