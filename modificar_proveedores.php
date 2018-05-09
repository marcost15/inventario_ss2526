<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_ficha_proveedores.php';
include './modelo/bd_modificar_proveedores.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('modificar_proveedores.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$proveedores = bd_ficha_proveedores($_REQUEST['id']);
$f1=new FormHandler('proveedores',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->borderStart('Modificar Proveedor');
$f1->hiddenField('id', $proveedores['id']);
$f1->setValue('id', $proveedores['id']);
$f1->textField($star.'Rif','rif',FH_STRING,20,20,"onkeyup=\"proveedores.rif.value=proveedores.rif.value.toUpperCase();\"");
$f1->setValue('rif', $proveedores['rif']);
$f1->textField($star.'Razon Social','razon_social',FH_STRING,30,255,"onkeyup=\"proveedores.razon_social.value=proveedores.razon_social.value.toUpperCase();\"");
$f1->setValue('razon_social', $proveedores['razon_social']);
$f1->TextArea($star.'Dirección','direccion',FH_TEXT,30,2,"onkeyup=\"proveedores.direccion.value=proveedores.direccion.value.toUpperCase();\"");
$f1->setValue('direccion', $proveedores['direccion']);
$f1->textField('Teléfono','telf_fijo',_FH_DIGIT,15,11);
$f1->setValue('telf_fijo', $proveedores['telf_fijo']);
$f1->textField('Fax','fax',_FH_DIGIT,15,11);
$f1->setValue('fax', $proveedores['fax']);
$f1->textField('Correo','correo',_FH_EMAIL,30,50);
$f1->setValue('correo', $proveedores['correo']);
$f1->textField('Persona Contacto','persona_contacto',_FH_STRING,30,255,"onkeyup=\"proveedores.persona_contacto.value=proveedores.persona_contacto.value.toUpperCase();\"");
$f1->setValue('persona_contacto', $proveedores['persona_contacto']);
$f1->addLine($star ." = Campos Requeridos Obligatoriamente");
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Modificar','modificar');
$f1->resetButton();
$f1->borderStop();
$f1->onCorrect('procesar');

function procesar($d)
{
		bd_modificar_proveedores($d);
		ir('consmod_proveedores.php');
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();