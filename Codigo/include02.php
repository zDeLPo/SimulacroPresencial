<?php 
session_start();
$oPostulante = unserialize($_SESSION['sPostulante']);
$oOperacion = unserialize($_SESSION['sOperacion']);
 	 
	$cModalidad = $oPostulante->cModalidadCodigo;
	switch($cModalidad)
	{
		case F :// Modalidad Traslado Externo Nacional?>
		
				
				<tr>
					<td height="29"><div align="right">&Uacute;ltima Matr&iacute;cula :</div></td>
				  <td><select  class="CajaTexto" name="cboUltimaMatricula">
                    <option  value="z">(Seleccione)</option>
                    <?php obtenerListaDominio("AnioEgreso",$oPostulante->iUltimaMatriculaCodigo);?>
                  </select></td>
				</tr>
				 
				 <tr>
					<td height="29"><div align="right">Cr&eacute;ditos Acumulados:</div></td>
					<td>
						<select  class="CajaTexto" name="cboCreditosAcumulados">
							  <option  value="z">(Seleccione)</option>
							   	<?php
										for ($i = 36; $i<=300; $i++) {
										$cadTemp = 'selected="selected"';
										if ($i == $oPostulante->iCreditos) {
										echo '<option value="'. $i.'" ' . $cadTemp;
										} 
										else
										echo '<option value="' . $i . '" ';
										echo "> " . $i . "</option>";
										}
								?>
						</select>
					</tr>
<?php	break;
		case G :// Modalidad Traslado Internacional ?>
				<tr>
					<td><div align="right">Pa&iacute;s de Procedencia :</div></td>
				<td><select  class="CajaTexto" name="cboPais">
                  <option  value="z">(Seleccione)</option>
                  <?php obtenerLista( "pais","pai_vcCodigo","pai_vcNombre",$oPostulante->sPaisProcedenciaCodigo); ?>
                </select>
				</tr>
				<tr>
					<td height="29"><div align="right">&Uacute;ltima Matr&iacute;cula :</div></td>
					<td><select  class="CajaTexto" name="cboUltimaMatricula">
					  <option  value="z">(Seleccione)</option>
					  <?php obtenerListaDominio("AnioEgreso",$oPostulante->iUltimaMatriculaCodigo);?>
					</select>
					</td>
				</tr>
				 
				<tr>
					<td height="29"><div align="right">Cr&eacute;ditos Acumulados:</div></td>
					<td>
						<select  class="CajaTexto" name="cboCreditosAcumulados">
							  <option  value="z">(Seleccione)</option>
							   	<?php
										for ($i = 36; $i<=300; $i++) {
										$cadTemp = 'selected="selected"';
										if ($i == $oPostulante->iCreditos) {
										echo '<option value="'. $i.'" ' . $cadTemp;
										} 
										else
										echo '<option value="' . $i . '" ';
										echo "> " . $i . "</option>";
										}
								?>
						</select>
				</tr>

				
<?php	break;
		case E :// Modalidad Graduados y Titulados ?>
				

<?php	break;

		case L :// Modalidad Convenios Especificos?>
		
				<tr>
				<td height="29"><div align="right">    Tipo de Convenio:</div></td>
				<td><input class="CajaTexto" type="text" name="txtTipoConvenio" value="<?php echo $oPostulante->sTipoConvenio; ?>"  size="40" autocomplete="OFF"/>
				</tr>
<?php	break;
		case M :// Modalidad Comunidades Nativas ?>
				<tr>
					<td height="29"><div align="right">Comunidad Nativa a la que pertenece   :</div></td>
				<td><input class="CajaTexto" type="text" name="txtComunidadNativa" value="<?php echo $oPostulante->sComunidadNativa; ?>" size="40" autocomplete="OFF"/>				</tr>
				<tr>
					<td height="29"><div align="right">Lengua nativa que habla diferente al castellano    :</div></td>
				<td><input class="CajaTexto" type="text" name="txtLenguaNativa" value="<?php echo $oPostulante->sLenguaNativa; ?>" size="40" autocomplete="OFF"/>
				</tr>	

<?php			
		break;
		case C :// Modalidad Primeros Puestos ?>
		
				<tr>
					<td height="29"><div align="right">Orden de M&eacute;rito que obtuvo :</div></td>
					<td><select  class="CajaTexto" name="cboOrdenMerito">
                      <option  value="z">(Seleccione)</option>
                      <?php obtenerListaDominio("OrdenMer",$oPostulante->iOrdenMeritoCodigo);?>
                    </select>
				</tr>
				

<?php
		break;
		case N :// Modalidad Persona con Discapacidad ?>
				<tr>
					<td height="29"><div align="right">Resoluci&oacute;n Directoral del CONADIS:</div></td>
				<td><input class="CajaTexto" type="text" name="txtResolucionCONADIS" value="<?php echo $oPostulante->sResolucionCONADIS;?>" size="40" autocomplete="OFF"/>				</tr>
				 
				<tr>
					<td height="29"><div align="right">Discapacidad que padece:</div></td>
				    <td><input class="CajaTexto" type="text" name="txtDiscapacidad" value="<?php echo $oPostulante->sDiscapacidad;?>"  size="40" autocomplete="OFF" />
				</tr>

<?php
		break;
		case K :// Modalidad Miembros de Representaciones Diplomaticas?>
				<tr>
					<td><div align="right">Modalidad de Estudios :</div></td>
					<td>
						<select  class="CajaTexto" name="cboModalidadEstudio">
					  		<option  value="z">(Seleccione)</option>
					  		<?php obtenerListaDominio("MODESTUDIO",$oPostulante->iModalidadEstudioCodigo );?>
						</select>					</td>	
				</tr>
				<tr>
					<td><div align="right">Pa&iacute;s de Procedencia :</div></td>
				<td><select  class="CajaTexto" name="cboPais">
                  <option  value="z">(Seleccione)</option>
                  <?php obtenerLista( "pais","pai_vcCodigo","pai_vcNombre",$oPostulante->sPaisProcedenciaCodigo); ?>
                </select>
				</tr>
				<tr>
					<td><div align="right"> Parentesco con el Diplom&aacute;tico:</div></td>
					<td>
						<select  class="CajaTexto" name="cboParentescoDiplomado">
					  		<option  value="z">(Seleccione)</option>
					  		<?php obtenerListaDominio( "Parentesco",$oPostulante->iParentescoDiplomadoCodigo); ?>
				 </select>				 </tr>

<?php		
		break;
		case J : //Modalidad Héroes de Guerra y Victimas del Terror ?>
		
				<tr>
					<td height="29"><div align="right">Resoluci&oacute;n Directoral que lo considere como HGVT:</div></td>
				<td><input class="CajaTexto" type="text" name="txtResolucionHGVT" value="<?php $oPostulante->sResolucionHGVT;?>" size="40" autocomplete="OFF" />				</tr>		


<?php					
		break;
		case D :// Modalidad Traslado Interno ?>
				<tr>
					<td width="54%" align="right">EAP de Origen  : </td>
					<td width="50%">
						<select  class="CajaTexto" name="cboEAPOrigen">
							<option  value="z">(Seleccione)</option>
							<?php obtenerLista( "escuela","esc_vcCodigo","esc_vcNombre",$oPostulante->iEAPOrigenCodigo ); ?>
						</select>					
					</td>
				</tr>  
				<tr>
					<td width="54%" align="right">Ultima Matr&iacute;cula : </td>
					<td width="50%">
						<select  class="CajaTexto" name="cboUltimaMatricula">
							<option  value="z">(Seleccione)</option>
							<?php obtenerListaDominio("AnioEgreso",$oPostulante->sUltimaMatriculaCodigo);?>
						</select>					</td>
				 </tr>
				  
				 <tr>
					<td width="54%" align="right">Cr&eacute;ditos Acumulados  : </td>
					<td width="50%">
					<select  class="CajaTexto" name="cboCreditos">
							<option  value="z">(Seleccione)</option>
							<?php
										for ($i = 36; $i<=150; $i++) {
										$cadTemp = 'selected="selected"';
										if ($i == $oPostulante->iCreditos) {
										echo '<option value="'. $i.'" ' . $cadTemp;
										} 
										else
										echo '<option value="' . $i . '" ';
										echo "> " . $i . "</option>";
										}
								?>
					</select>					</td>
				 </tr>

<?php
	break;
	case B :	// Modalidad CEPUSM ?>
				
				<tr>
					<td width="54%" align="right">Ciclo en el que estudi&oacute; : </td>
					<td width="50%">
					<select  class="CajaTexto" name="cboCicloEstudio">
						<option  value="z">(Seleccione)</option>
					<?php obtenerListaDominio( "Ciclo", $oPostulante->iCicloEstudioCodigo);?>
					</select>					</td>
				</tr>
<?php
		break;
		case H:// Modalidad Deportista Calificado de Alto Nivel ?>
				
				<tr>
					<td class="lbl">Documento del Comit&eacute; Ol&iacute;mpico que los representa como DECAN: </td>
					<td><input class="CajaTexto" type="text" name="txtDocumentoOlimpico" value="<?php echo $oPostulante->sDocumentoOlimpico?>" size="40" autocomplete="OFF"/></td>
				</tr>
				<tr>
					<td class="lbl">Federación a la que pertenece :</td>
					<td><select name="cboFederacion"  class="CajaTexto" id="cboFederacion">
					  	<option  value="z">(Seleccione)</option>
					  	<?php obtenerListaDominio( "DEPORTES",$oPostulante->iFederacionCodigo); ?>
						</select>
					</td>
				</tr>
<?php  } ?>
