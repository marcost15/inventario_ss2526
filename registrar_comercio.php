<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_comercio.php';
include './modelo/bd_lista_estados.php';
include './modelo/bd_lista_tipos_conexiones.php';
include './modelo/bd_lista_bancos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_comercio.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$f1=new FormHandler('comercios',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->borderStart('Agregar Comercio');
$f1->textField($star.'Razon Social','razon_social',FH_STRING,30,255,"onkeyup=\"comercios.razon_social.value=comercios.razon_social.value.toUpperCase();\"");
$f1->textField($star.'Nombre Fantasia','nombre_fantasia',FH_STRING,30,255,"onkeyup=\"comercios.nombre_fantasia.value=comercios.nombre_fantasia.value.toUpperCase();\"");
$f1->textField($star.'Sucursal','sucursal',FH_STRING,30,100,"onkeyup=\"comercios.sucursal.value=comercios.sucursal.value.toUpperCase();\"");
$f1->TextArea($star.'Dirección','direccion',FH_TEXT,30,2,"onkeyup=\"comercios.direccion.value=comercios.direccion.value.toUpperCase();\"");
$f1->textField('Rif','rif',_FH_STRING,20,20,"onkeyup=\"comercios.rif.value=comercios.rif.value.toUpperCase();\"");
$f1->textField('Teléfono','tlf_local',_FH_DIGIT,15,11);
$f1->textField('Persona Contacto','persona_contacto',_FH_STRING,30,255,"onkeyup=\"comercios.persona_contacto.value=comercios.persona_contacto.value.toUpperCase();\"");
$f1->selectField($star."Estado", "estado_id",bd_lista_estados(),FH_NOT_EMPTY,true);
$f1->selectField($star."Ciudad", "ciudad_id",array(),FH_NOT_EMPTY,true);
$f1->textField('Nro de Cajas','nro_cajas',_FH_DIGIT,5,3);
$f1->selectField($star."Tipo de Conexion","conexion_id",bd_lista_tipos_conexiones(),FH_NOT_EMPTY,true);
$f1->textField('Nro de Tienda','nro_tienda',_FH_DIGIT,5,4);
$f1->selectField($star."Banco Principal", "banco_id",bd_lista_bancos(),FH_NOT_EMPTY,true);
$f1->addLine($star ." = Campos Requeridos Obligatoriamente");
$f1->linkSelectFields("casiajax.php", "estado_id", "ciudad_id");
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
	$nro_tienda=$d['nro_tienda'];
	if ($nro_tienda <> '')
	{
		$n=sql2value("SELECT COUNT(*) FROM comercios WHERE nro_tienda LIKE '$nro_tienda'");
	}
	else
	{
		$n = 0;	
	}
	if ($n == 0)
	{  
		bd_guardar_comercio($d);
		$_SESSION['mensaje']="COMERCIO PROCESADO CORRECTAMENTE";
	}
	else
	{
		$_SESSION['mensaje']="EL NUMERO DE TIENDA YA EXISTE.. VERIFIQUE... ";
		return false;
	}	
	ir('registrar_comercio.php');
}

$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);
