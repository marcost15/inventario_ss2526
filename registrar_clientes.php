<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_clientes.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_clientes.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$f1=new FormHandler('clientes',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->borderStart('Agregar Cliente');
$f1->textField($star.'Rif o Cedula','rif',FH_STRING,16,15,"onkeyup=\"clientes.rif.value=clientes.rif.value.toUpperCase();\"");
$f1->textField($star.'Nombre o Razon Social','razon_social',FH_STRING,30,255,"onkeyup=\"clientes.razon_social.value=clientes.razon_social.value.toUpperCase();\"");
$f1->TextArea($star.'Dirección','direccion',FH_TEXT,30,2,"onkeyup=\"clientes.direccion.value=clientes.direccion.value.toUpperCase();\"");
$f1->textField('Teléfono','tlf_fijo',_FH_DIGIT,15,11);
$f1->textField('Otro Telefono','tlf_movil',_FH_DIGIT,15,11);
$f1->textField('Correo','correo',_FH_EMAIL,30,50);
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
	$n=sql2value("SELECT COUNT(*) FROM clientes WHERE id LIKE '$rif'");
	if ($n==0)
	{  
		bd_guardar_clientes($d);
		$_SESSION['mensaje']="CLIENTE PROCESADO CORRECTAMENTE";
	}
	else
	{
		$_SESSION['mensaje']="EL RIF O CÉDULA YA EXISTE... VERIFIQUE... ";
		return false;
	}	
	ir('registrar_clientes.php');
}

$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);