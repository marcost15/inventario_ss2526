<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_ciudades.php';
include './modelo/bd_obt_estados.php';
include './modelo/bd_lista_estados.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('ciudades.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1=new dbFormHandler('ciudades',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->setConnectionResource($link,'ciudades','mysql');
$f1->borderStart('Agregar/Modificar Ciudades');
$f1->textField('Ciudad','nombre',FH_NOT_EMPTY,30,255,"onkeyup=\"ciudades.nombre.value=ciudades.nombre.value.toUpperCase();\"");
$f1->SelectField('Estado','estado_id',bd_lista_estados(),FH_NOT_EMPTY,true);
$f1->setHelpText('nombre','Por Favor Introduzca el Nombre de la Ciudad y asignele el estado correspondiente');
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="CIUDAD PROCESADA CORRECTAMENTE";
	ir('ciudades.php');
}
$ciudades = bd_obt_ciudades();
foreach ($ciudades as $i=>$c)
{
$ciudades[$i]['estado_id'] = bd_obt_estados($ciudades[$i]['estado_id']);
}

$ss2526->assign('ciudades',$ciudades);
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);