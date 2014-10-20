<?php
class Postulante {

	// 1. DATOS PERSONALES
	var $sApellidoPaterno = "";
	var $sApellidoMaterno = "";
	var $sNombrePostulante = "";
	var $cSexo = "";
	var $sFechaNacimiento, $cTipoDocumento, $sNumeroDocumento, $sTelefono, $cInvidente;

	// 2. DATOS I.E. PROCEDENCIA
	var $iTipoInstitucion, $sTipoColegioNombre, $sNombreColegio, $sDepartamentoColegio, $sProviciaColegio, $sDistritoColegio, $sCodigoColegio, $sUbicacionColegio, $iAnioEgresoColegio;

	//Datos de Postulacion
	var $iCreditosAcumulados;

	//  Modalidad discapacitado
	var $sCodigoConadis;

	// 3 Modalidad Miembros de Representaciones Diplomaticas
	var $sParentesco;

	//4. DATOS ADICIONALES
	var $sDepartamentoNacimiento, $sDepartamentoResidencia, $sDireccionActual, $sDistritoResidencia, $sCorreoElectronico, $cTipoPreparacion, $sPreparacion, $sNombreTutor, $sTelefonoTutor, $sMedioInformativo;

	//5. DATOS BANCO
	var $iBancoCodigo, $sBancoNombre, $sNumeroProspecto, $sNumeroOperacion, $dMontoAbonado, $cTipoOperacion, $sNumeroCarpetaExoneracion, $sFechaOperacion, $sIdOperacion;

	//6. DATOS DE INSCRIPCION - Facultad, Nro Codigo
	var $sEAPCodigo, $sEAPNombre, $sModalidadNombre, $iSedeCodigo, $sSedeNombre, $cModalidadCodigo;

	//7. Atributos para el control
	var $sFormularioActual, //Indica el formulario actual
	$cErrorDetectados; //0 si no hay errores, 1. si no hay errores

	// 8. DATOS GENERADOS
	var $sCodigoPostulante, $sNumeroIp, $sCodigoGrupo, $sNumeroGrupo;

	// 8. VARIABLES AUXILIARES
	var $iAnio, $iMes, $iDia;

}

class Operacion {

	//campos clave	
	var $iBancoCodigo, $sNumeroOperacion,$sCodigoOperacion, $sCodigoProspecto, $sOperacionNombre, $sConceptoCodigo, $dMonto, $fOperacionFecha, $cAgencia;

}

// PARAMETROS DE CONFIGURACION 


$URLBASE = $_SERVER['DOCUMENT_ROOT'] . "/app/simulacropre/";

$MAX_NUM_PROSPECTO = 81020000; //10074101;
$MIN_NUM_PROSPECTO = 81000001; //10050000;
$REZAGADO_MES = 9; // El periodo de rezagados inicia el 09/09/2006
$REZAGADO_DIA = 3;

/*
Las Funciones getCampoClave y GetCampo valor, separan el contenido del Value enviado 
por los imputs del formulario, esto para evitar multiples accesos a la Base de datos
*/
function getCampoClave($cadena) {
	if ($cadena == NULL)
		return 0;

	$array = explode('***', $cadena, 2);
	return $array[0];
}

function getCampoValor($cadena) {
	if ($cadena == NULL)
		return NULL;

	$array = explode('***', $cadena, 2);
	return $array[1];
}

//La super funcion Z  ayuda a insertar el texto NULL en la la cadena SQL de insertPostulante
//Solo para los casos donde CAMPO no empiece con la cifra CERO
//Todos las variables que se capturan DIGITADAS., deben capturarse con comillas simples
//Todas las variables que no se capturan por digitacion (NULL) durante la inscripcion se completara con texto NULL
function z($campo) {
	if ($campo == NULL)
		return 'NULL';
	return $campo;
}

function zNullChar($campo) {
	if ($campo == NULL)
		return "NULL";
	if ($campo == "z")
		return "NULL";
	return "'" . $campo . "'";
}

function zNullInt($campo) {
	if ($campo == NULL)
		return "NULL";
	return $campo;
}

function zNullCero( $campo ) {
	$c = trim( $campo );
	if ( strlen( $c ) == 0 ) {
		return "NULL";
	}
	return "'" . $campo . "'";
}
?>
