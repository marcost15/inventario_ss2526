<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_bancos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('bancos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1=new dbFormHandler('bancos',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->setConnectionResource($link,'bancos','mysql');
$f1->borderStart('Agregar/Modificar Bancos');
$f1->textField('Nombre del Banco','nombre',FH_NOT_EMPTY,30,255,"onkeyup=\"bancos.nombre.value=bancos.nombre.value.toUpperCase();\"");
$f1->setHelpText('nombre','Por Favor Introduzca el Banco');
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="BANCO PROCESADO CORRECTAMENTE";
	ir('bancos.php');
}
$ss2526->assign('bancos',bd_obt_bancos());
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);