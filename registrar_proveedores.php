<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_proveedores.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_proveedores.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1=new FormHandler('proveedores',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->borderStart('Agregar Proveedor');
$f1->textField($star.'Rif','rif',_FH_STRING,20,20,"onkeyup=\"proveedores.rif.value=proveedores.rif.value.toUpperCase();\"");
$f1->textField($star.'Razon Social','razon_social',FH_STRING,30,255,"onkeyup=\"proveedores.razon_social.value=proveedores.razon_social.value.toUpperCase();\"");
$f1->TextArea($star.'Dirección','direccion',FH_TEXT,30,2,"onkeyup=\"proveedores.direccion.value=proveedores.direccion.value.toUpperCase();\"");
$f1->textField($star.'Teléfono','telf_fijo',FH_DIGIT,15,11);
$f1->textField('Fax','fax',_FH_DIGIT,15,11);
$f1->textField('Correo','correo',_FH_EMAIL,30,50);
$f1->textField($star.'Persona Contacto','persona_contacto',FH_STRING,30,255,"onkeyup=\"proveedores.persona_contacto.value=proveedores.persona_contacto.value.toUpperCase();\"");
$f1->addLine($star ." = Campos Requeridos Obligatoriamente");
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Registrar','registrar');
$f1->resetButton();
$f1->borderStop();
$f1->onCorrect('proceso');

function proceso($d)
{  
	$rif=$d['rif'];
	$n=sql2value("SELECT COUNT(*) FROM proveedores WHERE rif LIKE '$rif'");
	if ($n==0)
	{  
		bd_guardar_proveedores($d);
		$_SESSION['mensaje']="PROVEEDOR PROCESADO CORRECTAMENTE";
	}
	else
	{
		$_SESSION['mensaje']="EL RIF YA EXISTE... VERIFIQUE... ";
		return false;
	}	
	ir('registrar_proveedores.php');
}

$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);