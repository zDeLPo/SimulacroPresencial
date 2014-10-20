//Para controlar la opcion CANCELAR
function cancelar(){
var op=	confirm("¿Esta seguro que desea cancelar su inscripción?");
if(op){
	location='cancelado.php';
//	alert("salio :)");
	
	}
}


//Para Validar la entrada de datos en los formularios
function stopRKey(evt) { // Deshabilita la tecla ENTER
	var evt  = (evt) ? evt : ((event) ? event : null);
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
	if ((evt.keyCode == 13) && (node.type=="text")) { return false; }
	document.onkeypress = stopRKey;
}

function validarForm01(form){
	var vacio=false;
	if(form.cboTipoDocumentoIdentidad.value ==='z' || form.cboEAPPostulacion.value ==='z') vacio = true;
	//	else{if(form.txtNombre.value =="" ) vacio = true;}
	
	if(vacio)	alert("¡Se requiere que ingrese todos los datos obligatorios!");
        else if(form.txtCodigoOperacion.value.length != 24 ) alert("¡Verifique el codigó de operación!")        
	else form.submit();
	}


function validarForm010(form){
	var vacio=false;
	if(form.cboTipoDocumentoIdentidad.value ==='z' || form.cboEAPPostulacion.value ==='z') vacio = true;
        
     //   else{if(form.txtNombre.value =='' || form.txtApellidoPaterno.value =='' || 
      //           form.txtApellidoMaterno.value =='' || form.txtNombresPostulante.value =='' || form.txtEmail.value ==''  || form.txtTelefonoReferencia.value ==''    
      //          ) vacio = true;}
	
	if(vacio)	alert("¡Se requiere que ingrese todos los datos obligatorios!");
        else if(form.txtCodigoOperacion.value.length !== 24 ) alert("¡Verifique el codigó de operación!");        
	else  form.submit();
	}


function validarForm02(form){
	
	form.txtApellidoPaterno.value	=form.txtApellidoPaterno.value.toUpperCase();
	form.txtApellidoMaterno.value	=form.txtApellidoMaterno.value.toUpperCase();
	form.txtNombresPostulante.value	=form.txtNombresPostulante.value.toUpperCase();
	form.txtNombreTutor.value		=form.txtNombreTutor.value.toUpperCase();
	
	var vacio=false;
	
	if(form.txtApellidoPaterno.value =="" || form.txtApellidoMaterno.value =="") vacio=true;
	else{
		if(form.txtNombresPostulante.value ==""  )vacio=true;
		else{
			if(form.cboDia.value=='z' || form.cboMes.value=='z' || form.cboAnio.value=='z')vacio=true;
			else{
				if(form.cboTipoDocumentoIdentidad.value=='z' || form.txtNumeroDocumento.value=="")vacio=true;
				}
			}
		}
		
	if( form.cboInvidente.value =='z') vacio=true;
	else{
		if(form.cboConQuienReside.value =='z')vacio=true;
		else{
			if(form.cboCantidadPostulacion.value=='z' || form.cboTipoPreparacion.value=='z' )vacio=true;
			else{
				if(form.cboMedioInformacion.value=='z' )vacio=true;
				}
			}
		}
	

	if(vacio)	alert("¡Se requiere que ingrese todos los datos obligatorios!")
	else{
		var goodEmail = form.txtEmail.value.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\..{2,2}))$)\b/gi);
		
		if(form.txtEmail.value!='' && !goodEmail) alert("¡Debe ingresar un email válido!"); 
		else form.submit();
		}
}


/*****************************************************************/  
/* Regresa TRUE si el codigo del caracter corresponde a un numero,*/  
/* de lo contrario regresa FALSE.                                 */  
/*****************************************************************/ 
function aceptaNum(evt)
{
	//Validar la existencia del objeto event  
	evt = (evt) ? evt : event;  
	
	//Extraer el codigo del caracter de uno de los diferentes grupos de codigos  
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));  
	   
	//Predefinir como valido  
	var respuesta = true;  
	   
	//Validar si el codigo corresponde a los NO aceptables  
	if (charCode > 31 && (charCode < 48 || charCode > 57))   
	{  
		//Asignar FALSE a la respuesta si es de los NO aceptables  
		respuesta = false;  
	}  
	   
	//Regresar la respuesta  
	return respuesta;	
}

function NoaceptaNum(evt)
{	
	//Validar la existencia del objeto event  
	evt = (evt) ? evt : event;  
	
	//Extraer el codigo del caracter de uno de los diferentes grupos de codigos  
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));  
	   
	//Predefinir como valido  
	var respuesta = true;  
	   
	//Validar si el codigo corresponde a los NO aceptables  
	if (charCode > 31 && (charCode < 48 || charCode > 57))   
	{  
		//Asignar FALSE a la respuesta si es de los NO aceptables  
		respuesta = false;  
	}  
	   
	//Regresar la respuesta  
	return !(respuesta);  
}

function noAtras()
{
	history.go(1);
}

function mayusF3(){
	
	document.form3.c22nom_colf3.value=document.form3.c22nom_colf3.value.toUpperCase();
	document.form3.c62prov_colf3.value=document.form3.c62prov_colf3.value.toUpperCase();
	document.form3.c63dis_colf3.value=document.form3.c63dis_colf3.value.toUpperCase();
	
	//alert("despues de validar");
	//form3.submit();
	}
	
function buscaCole(){
	//alert(depCole);
	ventBuscador= window.open("buscacole.php","buscador","toolbar=1,location=1,directories=0,status=1,menubar=0,scrollbars=1,resizable=0,width=800,height=500");
	
	}

function aceptaCole( codigo){
	//alert(depCole);
	self.opener.document.form03.txtCodigoColegio.value = codigo;
	window.close();
	return false;
	}
function advertenciaFinal(form){
	if(confirm("Se procedera a grabar los datos suministrados \n ¿esta seguro de continuar?")){
			form.submit();
		}
	}
	
//ocultar 

function MostrarOcultar (objetoVisualizar) {
if (document.all[objetoVisualizar].style.display=='none') {
document.all[objetoVisualizar].style.display='block';
} else {
document.all[objetoVisualizar].style.display='none';
}
}
	
	
function cambiar(form){
	form.nombre.value="SSSSS";
	}
        
//
function mostrarOcultar(idObjetoMostar, ver) {
	dis= ver ? '' : 'none';
	oMan = document.getElementById(idObjetoMostar);
	oMan.style.display=dis;
	return true;
}

function mostrarAyuda(oSelect){
        //oSelect = document.getElementById(sSelect);
        var iBanco = oSelect.selectedIndex + 0;

        //if(oSelect.id == 'idBanco')
        //    sIdLabel = 'lblLongitud';

        //oLabel = document.getElementById(sIdLabel);
		
	if(iBanco == 1){
		mostrarOcultar('divHelpBancoNacion', true);
		mostrarOcultar('divHelpBancoPropio', false);
		//oLabel.innerHTML = '(24 Caracteres)';
                //document.getElementById("lblLongitud1").innerHTML = '(24 Caracteres)' ;
	}else if (iBanco == 2){
		mostrarOcultar('divHelpBancoNacion', false);
		mostrarOcultar('divHelpBancoPropio', true);
		//oLabel.innerHTML = '(X Caracteres)';
                //document.getElementById("lblLongitud1").innerHTML = '(X Caracteres)' ;
	}else{
		mostrarOcultar('divHelpBancoNacion', false);
		mostrarOcultar('divHelpBancoPropio', false);
		//oLabel.innerHTML = '';
                //document.getElementById("lblLongitud1").innerHTML = '' ;           
	}
	
	return true;
}

function initPage(sPage){
	if(sPage == 'form01'){
		mostrarAyuda(document.getElementById('idBanco'));
	}
}