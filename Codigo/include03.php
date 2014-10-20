  <tr>
    <td width="50%" align="right" >Departamento de nacimiento : </td>
    <td width="50%">
	<?php
		if ($oPostulante->sDepartamentoNacimientoCodigo != 'Z')
		$pst = $oPostulante->sDepartamentoNacimientoCodigo;
	?>
	<select class="CajaTexto" name="cboDepartamentoNacimiento">
        <option value="z" >(Seleccione)</option>
        <?php obtenerLista("departamento","dep_vcCodigo","dep_vcNombre",$oPostulante->sDepartamentoNacimientoCodigo);?>
    </select></td>
  </tr>
  <tr>
    <td align="right" >Departamento de residencia : </td>
    <td>
	<?php
		if ($oPostulante->sDepartamentoResidenciaCodigo != 'z')
			$pst = $oPostulante->sDepartamentoResidenciaCodigo;
	?>
	<select class="CajaTexto" name="cboDepartamentoResidencia">
        <option value="z" >(Seleccione)</option>
        <?php obtenerLista("departamento","dep_vcCodigo","dep_vcNombre",$oPostulante->sDepartamentoResidenciaCodigo);?>
    </select></td>
  </tr>
  <tr>
    <td align="right" >Direcci&oacute;n : </td>
    <td>
	<?php
	if 	($oPostulante->sDireccionActual != NULL)
			$cadTemp = "value='$oPostulante->sDireccionActual'";
	else 	$cadTemp = '';
	?>
        <input class="CajaTexto" type="text" name="txtDireccion"  size="40" autocomplete="OFF"<?php echo $cadTemp; ?>/></td>
  </tr>
  <tr>
    <td align="right" >Distrito de residencia : </td>
    <td>
	<select class="CajaTexto" name="cboDistritoResidencia">
        <option value="z" >(Seleccione)</option>
        <?php 
        	obtenerDistritosLima( 
        		$oPostulante->sDistritoResidenciaCodigo 
        	);
        ?>
      </select>
      (Si vive en Lima o Callao)</td>
  </tr>
