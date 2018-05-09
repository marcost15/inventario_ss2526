<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_estados.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('estados.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1=new dbFormHandler('estados',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->setConnectionResource($link,'estados','mysql');
$f1->borderStart('Agregar/Modificar Estados');
$f1->textField('Estados','nombre',FH_NOT_EMPTY,30,255,"onkeyup=\"estados.nombre.value=estados.nombre.value.toUpperCase();\"");
$f1->setHelpText('nombre','Por Favor Introduzca el nombre del Estado');
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="ESTADO PROCESADO CORRECTAMENTE";
	ir('estados.php');
}
$ss2526->assign('estados',bd_obt_estados());
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);