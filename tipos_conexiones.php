<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_tipos_conexiones.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('tipos_conexiones.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1=new dbFormHandler('tipos_conexiones',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->setConnectionResource($link,'tipos_conexiones','mysql');
$f1->borderStart('Agregar/Modificar Tipos de Conexiones');
$f1->textField('Tipo de Conexión','nombre',FH_NOT_EMPTY,30,255,"onkeyup=\"tipos_conexiones.nombre.value=tipos_conexiones.nombre.value.toUpperCase();\"");
$f1->setHelpText('nombre','Por Favor Introduzca el nombre de la Conexión');
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="CONEXIÓN PROCESADA CORRECTAMENTE";
	ir('tipos_conexiones.php');
}
$ss2526->assign('conexiones',bd_obt_tipos_conexiones());
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);