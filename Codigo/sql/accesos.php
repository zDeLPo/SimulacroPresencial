<?

require_once ($URLBASE.'libs/clases.php');
require_once ($URLBASE.'sql/query.php');


function obtenerLista($tabla, $campoValue, $campoMostrado, $selected) {
	$sql = " SELECT $campoValue, $campoMostrado FROM $tabla ORDER BY $campoMostrado ";
	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	foreach ($registros as $registro) {
		if ($selected == $registro[0]) {
			$cadTemp = 'selected="selected"';
			echo '<option value="' . $registro[0] . '***' . $registro[1] . '" ' . $cadTemp;
		} else
			echo '<option value="' . $registro[0] . '***' . $registro[1] . '" ';
		echo "> " . $registro[1] . "</option>";
	}
}

function obtenerListaFiltro($tabla, $campoValue, $campoMostrado, $selected, $filtro ) {
	$sql = " SELECT $campoValue, $campoMostrado FROM $tabla WHERE " . $filtro . " ORDER BY $campoMostrado ";
	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	
	foreach ($registros as $registro) {
		if ($selected == $registro[0]) {
			$cadTemp = 'selected="selected"';
			echo '<option value="'. $registro[0] . '***' . $registro[1] . '" ' . $cadTemp;
		} else
			echo '<option value="' . $registro[0] . '***' . $registro[1] . '" ';
		echo "> " . $registro[1] . "</option>"; 
	}
}


function obtenerListaDominio($variable, $selected) {
	$sql = " 
					SELECT domdet_iCodigo, domdet_vcNombre
					FROM dominiodetalle
					WHERE dom_vcCodigo='$variable' and domdet_cHabilitado='S'
					Order by domdet_iCodigo";
	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	foreach ($registros as $registro) {
		if ($selected == $registro[0]) {
			$cadTemp = 'selected="selected"';
			echo '<option value="' . $registro[0] . '***' . $registro[1] . '" ' . $cadTemp;
		} else
			echo '<option value="' . $registro[0] . '***' . $registro[1] . '" ';
		echo "> " . $registro[1] . "</option>";
	}
}

/**
 * Obtener el prospecto asociado al numero de operación ingresado
 */ 
function obtenerProspecto() {
	$sql = " SELECT " .
	"   pro_vcCodigo	" .
	" FROM " .
	"   prospecto " .
	"   limit 1 ";
	//echo $sql;exit;
	
	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	return $aRegistros[0][0];
}

//Obtiene la lista de distritos de Lima
function obtenerDistritosLima( $selected ) {
	$sql = " SELECT dep_vcCodigo, pro_vcCodigo, dis_vcCodigo, dis_vcNombre " .
		" FROM " .
		"	distrito " .
		"WHERE " .
		"	dep_vcCodigo = '15'" .
		" OR " .
		"	dep_vcCodigo = '07'" .
		"ORDER BY dis_vcNombre ";
	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	foreach ($registros as $registro) {
		if ( $selected == $registro[0] . $registro[1] . $registro[2] ) {
			$cadTemp = 'selected="selected"';
			echo '<option value="' . $registro[0] . $registro[1] . $registro[2] . '***' . $registro[3] . '" ' . $cadTemp;
		} else
			echo '<option value="' . $registro[0] . $registro[1] . $registro[2] .  '***' . $registro[3] . '" ';
		echo "> " . $registro[3] . "</option>";
	}
}


/* Devuelve la forma de inscripcion del postulante exonerado
 * con el fin de saber si puede inscribirse en cualquier escuela
 * o su inscripcion esta condicionada solo a algunas escuelas
 */
function obtieneFormaInscripcion( $sCodigoExonerado ) {
	$sql = "SELECT " .
	"   fi.forins_iCodigo, " .
	"   fi.forins_cModalidadTodo ," .
	"   fi.forins_cEscuelaTodo " . 
	" FROM " .
	"   codigoexonerado ce " .
	"   join " .
	"   formainscripcion fi " .
	"   on " .
	"   ce.forins_iCodigo = fi.forins_iCodigo " .
	" WHERE " .
	"   ce.codexo_vcCodigo = '" . $sCodigoExonerado . "'";

	$db = Conectarse();
	$rConsulta = query( $sql, $db );
	$aEstado = extraer( $rConsulta );
	mysql_free_result( $rConsulta );
	mysql_close($db);
    return $aEstado; 	
}


//Obtener el factor de multiplicacion de 
function obtenerFactor ($cFormaInscripcion) {
	$sql = " SELECT " .
	"   forins_fFactor	" .
	" FROM " .
	"   formainscripcion " .
	" WHERE " .
	"   ( " .
	"    forins_iCodigo = '$cFormaInscripcion'  " .
	"   )";
	//echo $sql;exit;
	
	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	return $aRegistros[0][0];
}


//Retorna la descripcion del tipo de institucion educativa

function getNombreTipoInstitucion($iTipoInstitucion) {
	$sql = " SELECT " .
	"   tipins_vcNombre" .
	" FROM " .
	"   tipoinstitucion " .
	" WHERE " .
	"   ( " .
	"    tipins_iCodigo = '$iTipoInstitucion'" .
	"   )";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	return $aRegistros[0][0];
}

//obtiene el identificador del colegio segun su codigo modular

function obtenerIdColegio($sCodigoModular) {

	$sql = " SELECT " .
	"   col_iCodigo" .
	" FROM " .
	"   colegio " .
	" WHERE " .
	"   ( " .
	"    col_vcCodigo='$sCodigoModular'" .
	"   )";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	return $aRegistros[0][0];

}


// recupera el registro de operacion
// por su numero
function obtenerOperacion( $tipoBanco ,$numOperacion) {
	$sql = "  SELECT  " .
	"  	ban_iCodigo, " .
	"  	ope_vcNumero, " .
	"  	pro_vcCodigo, " .
	"  	ope_vcNombre, " .
	"  	con_vcCodigo, " .
	"  	ope_fMonto, " .
	"  	ope_dFecha, " .
	"  	ope_iAgencia, " .
	"  	ope_tHora , " .
	"  	ope_cExtorno, " .
	"  	ope_dFechaSistema, " .
	"  	cod_vcCodigo," .
	"	usu_vcCodigo " .
	"  FROM  " .
	"  	operacion " .
	"  WHERE " .
	"  (" .
	"    ban_iCodigo = '$tipoBanco' " .
	"    AND " .
	"    ope_vcCodigo = '$numOperacion' " .

	"  )";


	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	return $registros;
}


function buscaCole($col_dep, $parte_nom_col, $prov_col, $tip_col) {

	if ($tip_col == 0)
		$cadena = "AND tipins_iCodigo='$tip_col'";
	else
		$cadena = '';

	$sql = "SELECT " .
	"  col_vcCodigo, " .
	"  col_vcNombre, " .
	"  col_vcDireccion, " .
	"  col_vcDistrito, " .
	"  col_vcNivel " .
	"FROM " .
	"  colegio " .
	"WHERE " .
	"  ( " .
	"    col_vcNombre LIKE '%$parte_nom_col%' " .
	"    AND " .
	"    col_vcProvincia= '$prov_col' " .
	"    AND " .
	"    col_vcDepartamento='$col_dep' " .
	"    $cadena " .
	"  ) " .
	"ORDER BY " .
	"  col_vcNombre ";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);
	return $registros;
}

function buscaProvCole($depCole, $provcole) {
	$sql = "SELECT " .
	"	DISTINCT " .
	"		col_vcProvincia " .
	"	FROM " .
	"		colegio " .
	"	WHERE " .
	"		col_vcDepartamento='$depCole' " .
	"	ORDER BY " .
	"		col_vcProvincia";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	foreach ($registros as $registro) {
		if ($provcole == $registro[0])
			echo '<option value="' . $registro[0] . '" selected="selected"> ' . $registro[0] . "</option>";
		else
			echo '<option value="' . $registro[0] . '"> ' . $registro[0] . "</option>";
	}
}

function obtenerNombreColegio($sCodigoColegio) {

	$sql = "SELECT " .
	"		col_vcNombre " .
	"	FROM " .
	"		colegio " .
	"	WHERE " .
	"		col_iCodigo = '$sCodigoColegio' ";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$registros = array ();
	$registros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	return $registros[0][0];
}

/*Funcion que obtiene el tipo de gestion que tiene una institucion universitaria
* de gestion Privada = 1
* de Gstion Estatal = 0
*/
function obtenerTipoUniversidad($uni_vcCodigo) {

	$sql = 
	" SELECT " .
	"   tipins_iCodigo" .
	" FROM " .
	"   universidad " .
	" WHERE " .
	"   ( " .
	"    uni_vcCodigo='$uni_vcCodigo'" .
	"   )";

	$db = Conectarse();
	$consulta = query($sql, $db);
	$aRegistros = extraer($consulta);
	mysql_free_result($consulta);
	mysql_close($db);

	return $aRegistros[0][0];

}



?>
