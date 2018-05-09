<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_ficha_comercios.php';
include './modelo/bd_modificar_comercios.php';
include './modelo/bd_lista_estados.php';
include './modelo/bd_lista_ciudades.php';
include './modelo/bd_lista_tipos_conexiones.php';
include './modelo/bd_lista_bancos.php';
include './modelo/bd_verificar_privilegios.php';
if (bd_verificar_privilegios('modificar_comercios.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
$comercio = bd_ficha_comercios($_REQUEST['id']);
$f1=new FormHandler('comercios',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->borderStart('Agregar Comercio');
$f1->hiddenField('id', $comercio['id']);
$f1->setValue('id', $comercio['id']);
$f1->textField($star.'Razon Social','razon_social',FH_STRING,30,255,"onkeyup=\"comercios.razon_social.value=comercios.razon_social.value.toUpperCase();\"");
$f1->setValue('razon_social', $comercio['razon_social']);
$f1->textField($star.'Nombre Fantasia','nombre_fantasia',FH_STRING,30,255,"onkeyup=\"comercios.nombre_fantasia.value=comercios.nombre_fantasia.value.toUpperCase();\"");
$f1->setValue('nombre_fantasia', $comercio['nombre_fantasia']);
$f1->textField($star.'Sucursal','sucursal',FH_STRING,30,100,"onkeyup=\"comercios.sucursal.value=comercios.sucursal.value.toUpperCase();\"");
$f1->setValue('sucursal', $comercio['sucursal']);
$f1->TextArea($star.'Dirección','direccion',FH_TEXT,30,2,"onkeyup=\"comercios.direccion.value=comercios.direccion.value.toUpperCase();\"");
$f1->setValue('direccion', $comercio['direccion']);
$f1->textField('Rif','rif',_FH_STRING,20,20,"onkeyup=\"comercios.rif.value=comercios.rif.value.toUpperCase();\"");
$f1->setValue('rif', $comercio['rif']);
$f1->textField('Teléfono','tlf_local',_FH_DIGIT,15,11);
$f1->setValue('tlf_local', $comercio['tlf_local']);
$f1->textField('Persona Contacto','persona_contacto',_FH_STRING,30,255,"onkeyup=\"comercios.persona_contacto.value=comercios.persona_contacto.value.toUpperCase();\"");
$f1->setValue('persona_contacto', $comercio['persona_contacto']);
$f1->selectField($star."Ciudad", "ciudad_id",bd_lista_ciudades(),FH_NOT_EMPTY);
$f1->setValue('ciudad_id', $comercio['ciudad_id']);
$f1->textField('Nro de Cajas','nro_cajas',_FH_DIGIT,5,3);
$f1->setValue('nro_cajas', $comercio['nro_cajas']);
$f1->selectField($star."Tipo de Conexion","conexion_id",bd_lista_tipos_conexiones(),FH_NOT_EMPTY,true);
$f1->setValue('conexion_id', $comercio['conexion_id']);
$f1->textField('Nro de Tienda','nro_tienda',_FH_DIGIT,5,4);
$f1->setValue('nro_tienda', $comercio['nro_tienda']);
$f1->selectField($star."Banco Principal", "banco_id",bd_lista_bancos(),FH_NOT_EMPTY);
$f1->setValue('banco_id', $comercio['banco_id']);
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
	bd_modificar_comercios($d);
	ir('consmod_comercios.php');
}

$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);