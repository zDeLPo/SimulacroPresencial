  <tr>
  <td width="36%" align="right">Tipo : </td>
  <td width="64%">
      <?php $pst=$oPostulante->iTipoColegioCodigo;?>
	  <label>
        <input type="radio" name="rbtTipoColegio" value="0" <?php if($oPostulante->iTipoInstitucion == 0) echo "checked='checked'";?> />
        Estatal</label>
      
      <label>
        <input type="radio" name="rbtTipoColegio" value="1" <?php if($oPostulante->iTipoInstitucion == 1) echo "checked='checked'";?> />
        Particular</label></td>
	</tr>
  <tr>
    <td align="right">Departamento del colegio  : </td>
    <td>
	  <?php
		if ($oPostulante->sDepartamentoColegioCodigo != 'Z')
		$pst = $oPostulante->sDepartamentoColegioCodigo;
		?>
	<select  class="CajaTexto" name="cboDepartamentoColegio"  >
        <option value = "z" >(Seleccione)</option>
        <?php obtenerLista("departamento","dep_vcCodigo","dep_vcNombre",$oPostulante->sDepartamentoColegioCodigo);?>
      </select>    </td>
  </tr>
  <tr>
    <td align="right"> A&ntilde;o en que termin&oacute; la educaci&oacute;n Secundaria : </td>
    <td><select class="CajaTexto" name="cboFinColegio">
        <option value="z" >(Seleccione)</option>
        
		
		<?php
		if($oPostulante->cModalidadCodigo != 'C') {
			for ($i = 2014; $i>1950; $i--) {
				$cadTemp = 'selected="selected"';
				if ($i == $oPostulante->iAnioEgresoColegio) {
					echo '<option value="'. $i.'" ' . $cadTemp;
				} else
					echo '<option value="' . $i . '" ';
				echo "> " . $i . "</option>";
			}
		
		} else {
			for ($i = 2014; $i>2012; $i--) {
				$cadTemp = 'selected="selected"';
				if ($i == $oPostulante->iAnioEgresoColegio) {
					echo '<option value="'. $i.'" ' . $cadTemp;
				} else
					echo '<option value="' . $i . '" ';
				echo "> " . $i . "</option>";
			}
		}
		
		
		?>
    </select></td>
  </tr>

