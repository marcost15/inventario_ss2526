<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_modificar_clientes.php';
include './modelo/bd_ficha_clientes.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('modificar_clientes.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$clientes = bd_ficha_clientes($_REQUEST['id']);
$f1=new FormHandler('clientes',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->borderStart('Agregar Cliente');
$f1->hiddenField('id', $clientes['id']);
$f1->textField($star.'Nombre o Razon Social','razon_social',FH_STRING,30,255,"onkeyup=\"clientes.razon_social.value=clientes.razon_social.value.toUpperCase();\"");
$f1->setValue('razon_social', $clientes['razon']);
$f1->TextArea($star.'Dirección','direccion',FH_TEXT,30,2,"onkeyup=\"clientes.direccion.value=clientes.direccion.value.toUpperCase();\"");
$f1->setValue('direccion', $clientes['direccion']);
$f1->textField('Teléfono','tlf_fijo',_FH_DIGIT,15,11);
$f1->setValue('tlf_fijo', $clientes['tlf_fijo']);
$f1->textField('Otro Telefono','tlf_movil',_FH_DIGIT,15,11);
$f1->setValue('tlf_movil', $clientes['tlf_movil']);
$f1->textField('Correo','correo',_FH_EMAIL,30,50);
$f1->setValue('correo', $clientes['correo']);
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
$f1->onCorrect('proceso');

function proceso($d)
{  
	bd_modificar_clientes($d);
	ir('consmod_clientes.php');
}

$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);