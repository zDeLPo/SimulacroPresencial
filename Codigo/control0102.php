<?php
require_once ($URLBASE . 'sql/accesos.php');
require_once ($URLBASE . 'libs/clases.php');
require_once ($URLBASE . 'sql/verifica.php');
// echo "Control0102";

$ti = $_POST['tipoInscripcion'];
 // establecemos el codigo de banco en 1 que corresponde al BANCO DE LA NACION
$iBanco = 1;
//Establecemos la modalidad por defecto a SECUNDARIA BACHILLERATO
$cModalidad = 'A';
//$sNumeroOperacion = $_POST['txtOperacion'];
$sCodigoOperacion = substr( trim($_POST['txtCodigoOperacion']),0,24);
//$sNumeroProspecto = $_POST['txtProspecto'];
$sNumeroProspecto = obtenerProspecto();//Obtiene prospecto generico
//$sNombreWeb = strtoupper(str_replace('�','',str_replace('�','',str_replace(' ','',$_POST['txtNombre']))));
$sEscuela = $_POST['cboEAPPostulacion'];
$formActual = $_POST['formActual'];


$sApellidoPaterno = $_POST['txtApellidoPaterno'];
$sApellidoMaterno = $_POST['txtApellidoMaterno'];
$sNombrePostulante = $_POST['txtNombresPostulante'];
$cTipoDocumento = $_POST['cboTipoDocumentoIdentidad'];
$sNumeroDocumento = $_POST['txtNumeroDocumento'];
$sTelefonoReferencia = $_POST['txtTelefonoReferencia'];
$cInvidente = $_POST['cboInvidente'];
$sCorreoElectronico = trim($_POST['txtEmail']);
$_POST['txtEmail']=$sCorreoElectronico;

//Vamos a forzar para que el codigooperacion represente el numero operacion
//Solo banco de la nacion
$sNumeroOperacion = $sCodigoOperacion;


//Obtenemos la Operacion
$aRegistrosPago = obtenerOperacion($iBanco, $sNumeroOperacion);

$oPostulante = new Postulante();
$oOperacion = new Operacion();

$oPostulante->sNumeroProspecto = $sNumeroProspecto;
$oPostulante->sNumeroOperacion = $sNumeroOperacion;
$oPostulante->sCodigoOperacion = $sCodigoOperacion;
$oPostulante->cModalidadCodigo = $cModalidad;
$oPostulante->sModalidadNombre = "";
$oPostulante->sEscuelaCodigo = getCampoClave($sEscuela);
$oPostulante->sEscuelaNombre = getCampoValor($sEscuela);
$oPostulante->dMontoAbonado = $aRegistrosPago[0][5];
$oPostulante->sFechaOperacion = $aRegistrosPago[0][6];
$oPostulante->sErrorDetectados = 0;
$oPostulante->cExonerado = $ti;
$oPostulante->iSedeCodigo = 1; // Por defecto Sede LIMA
$oPostulante->iFormaInscripcion = 1;
$oOperacion->sNumeroProspecto = $sNumeroProspecto;
$oOperacion->dMontoAbonado = $aRegistrosPago[0][5];
$oOperacion->sFechaOperacion = $aRegistrosPago[0][6];
// establecemos el codigo de banco en 1 que corresponde al BANCO DE LA NACION
$oOperacion->sBancoCodigo = $iBanco;
$oOperacion->iBancoNombre = "";
$oOperacion->cExonerado = $ti;
$oPostulante->iTipoInstitucion = 1; //Por Defecto Publica, es indiferente para simulacro 
$oPostulante->sFormularioActual = $formActual;





$oPostulante->sApellidoPaterno = $sApellidoPaterno;
$oPostulante->sApellidoMaterno = $sApellidoMaterno;
$oPostulante->sNombrePostulante = $sNombrePostulante;
$oPostulante->cTipoDocumentoCodigo = getCampoClave($cTipoDocumento);
$oPostulante->cTipoDocumentoNombre = getCampoValor($cTipoDocumento);
$oPostulante->sNumeroDocumento = $sNumeroDocumento;
$oPostulante->sTelefonoReferencia = $sTelefonoReferencia;
$oPostulante->cInvidente = $cInvidente;
$oPostulante->sCorreoElectronico = $sCorreoElectronico;




//Validamos formulario actual
if ($formActual != 'form01') {
	header("location:denegado.php");
	exit;
}

//evitamos que envie campos vacios
if ($sNumeroProspecto == NULL || $sNumeroOperacion == NULL) {
	header("location:form01.php?bd=8740");
	exit;
}
if ( $sNumeroDocumento ==NULL) {
	header("location:form01.php?bd=8742");
	exit;
}
if ($sApellidoPaterno == NULL || $sApellidoMaterno == NULL || $sNombrePostulante == NULL ) {
	header("location:form01.php?bd=8741");
	exit;
}
if (!preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$}',$_POST['txtEmail'])) {
	header("location:form01.php?bd=8744");
	exit;
}
if( strlen( $sTelefonoReferencia  )< 7 ) {
	header("location:form01.php?bd=8743");
	exit;
}



//Validamos el numero de operacion
$estadoOperacion = operacionValida($iBanco, $sNumeroOperacion);

if ($estadoOperacion != 0) {
	// Si existe algun problema con la operacion ERROR
	header("location:form01.php?bd=" . $estadoOperacion);
	exit;
}



// verificamos si postulante es rezagado  y/o puede inscribirse segun letra
$cPrimeraLetraApellido = substr($sApellidoPaterno, 0, 1);
$iCondicionRezagado = verificaRezagado($cPrimeraLetraApellido, $oPostulante->sFechaOperacion, $oPostulante->iFormaInscripcion, $oOperacion->sBancoCodigo);

//verifica que este en su fecha de incripcion
/*
*Condicion de Rezagado 
*1= No es rezagado y se puede inscribir
*3= es Rezagado ypuede inscribirse
*/

	
	
if ($iCondicionRezagado == 1 || $iCondicionRezagado == 3) {

	if ($iCondicionRezagado == 3) {
		// REZAGADO Y PUEDE INSCRIBIRSE
		$cRezagado = 'S';
	}
	if ($iCondicionRezagado == 1)
		$cRezagado = 'N';

	//Obtenemos el factor de multiplicacion de la tarifa
	$fFactor = obtenerFactor($oPostulante->iFormaInscripcion);

	//Validamos el monto ingresado 
	if (verificaMontoAbonado($oPostulante->cModalidadCodigo, $oPostulante->iTipoInstitucion, $cRezagado, $oPostulante->dMontoAbonado, $fFactor, $oPostulante->cExonerado) == 1) {

	} else {
		array_push($tmpErrores, 36); //Monto insuficiente
	}
} else {
	//No le corresponde inscripci�n

	array_push($tmpErrores, 16);
}        
        

// inicio de sesion y envio al siguiente
session_start();
$oPostulante->sFormularioActual = 'control0102';
$oPostulante->cErrorDetectados = $tmpErrores;

$sPostulante = serialize($oPostulante);
$sOperacion = serialize($oOperacion);
$_SESSION['sPostulante'] = $sPostulante;
$_SESSION['sOperacion'] = $sOperacion;



if ($oPostulante->cErrorDetectados != null)
	header("location:form01.php");
else
	header("location:form02.php");


?>
