<?php
require_once ($URLBASE . 'sql/accesos.php');
require_once ($URLBASE . 'sql/verifica.php');
require_once ($URLBASE . 'libs/clases.php');
require_once ($URLBASE . 'sql/actualiza.php');

session_start();
$oPostulante = unserialize($_SESSION['sPostulante']);
$oOperacion = unserialize($_SESSION['sOperacion']);

//validamos FORMULARIO ACTUAL
if ($oPostulante->sFormularioActual != 'form04') {
	session_destroy();
	header("location:denegado.php");
	exit;
}

// validar
$tmpErrores = array ();

$error = 0;
$db = Conectarse();
if (!$db)
	array_push($tmpErrores, 17);
else {
	mysql_query("SET AUTOCOMMIT=0", $db);
	mysql_query("BEGIN", $db);

	$gruCod = buscaCodigoGrupo($db, $oPostulante->sEscuelaCodigo);
	$gruNum = buscaPunteroGrupo($db, $gruCod);
	$gruNum++;
	$codPos = buscaCodigoPostulante($db, $gruCod, $gruNum);

	$oPostulante->sCodigoPostulante = $codPos;
	$oPostulante->iGrupoCodigo = $gruCod;
	$oPostulante->iGrupoUltimo = $gruNum;
	$oPostulante->are_pos = buscaAreaPostulacion($db, $oPostulante->sEscuelaCodigo);
	$oPostulante->ip_host = $_SERVER['REMOTE_ADDR'];

	if (!codigoFisicaUsado($db, $oPostulante->sCodigoEducacionFisica)) {
		if (!operacionUsado($db, $oOperacion->sBancoCodigo, $oPostulante->sNumeroOperacion)) {
			if (!prospectoUsadoFinal($db, $oPostulante->sNumeroProspecto) || true) { //Simulacro no requiere Simulacro
				if (!codigoUsado($db, $oPostulante->sCodigoPostulante)) {
					if (!codigoExoneradoUsado($db, $oPostulante->sCodigoExonerado, $oOperacion->cExonerado)) {
						if (insertaPostulante($db, $oPostulante) > 0) {
							if (actualizaProspecto($db, $oPostulante->sNumeroProspecto) > 0) {
								if (actualizaCodigo($db, $oPostulante->sCodigoPostulante) > 0) {
									if (actualizaGrupo($db, $oPostulante->iGrupoCodigo, $oPostulante->iGrupoUltimo) > 0) {
										if (actualizaOperacionExonerado($db, $oPostulante->sCodigoExonerado, $oPostulante->sCodigoPostulante) > 0) {
											if (actualizaOperacion($db, $oOperacion->sBancoCodigo, $oPostulante->sNumeroOperacion, $oPostulante->sCodigoPostulante) > 0) {
												if (actualizaCodigoFisica($db, $oPostulante->sEscuelaCodigo, $oPostulante->sCodigoEducacionFisica, $oPostulante->sCodigoPostulante) > 0) {
													$error = 0;
												} else {
													$error = 1;
												}
											} else {
												$error = 2;
											}
										} else {
											$error = 3;
										}
									} else {
										$error = 4;
									}
								} else {
									$error = 5;
								}
							} else {
								$error = 6;
							}
						} else {
							$error = 7;
						}
					} else {
						$error = 8;
					}
				} else {
					$error = 9;
				}
			} else {
				$error = 10;
			} //fin de condicionales de transaccion
		} else {
			$error = 11;
		}
	} else {
		$error = 12;
	}

	if ($error == 0) {
		mysql_query("COMMIT", $db);
	} else {
		mysql_query("ROLLBACK", $db);
	}

	mysql_close($db);

	if ($error != 0)
		array_push($tmpErrores, 17 + $error);
}

//Serializamos el Objeto
$oPostulante->sFormularioActual = 'control0203';
$oPostulante->errDetectados = $tmpErrores;
$sPostulante = serialize($oPostulante);
$_SESSION['sPostulante'] = $sPostulante;
if ($oPostulante->errDetectados != null)
	header("location:form02.php");
else
	header("location:form03.php");
?>
