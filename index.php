<?php
session_start();
$_SESSION=array();
session_destroy();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/funciones.php';
include './configs/fh3.php';
include './modelo/bd_verifica_login.php';
include './modelo/bd_verificar_privilegios.php';

$f1=new formHandler('login',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Registro de usuario');
$f1->textField('Login','usuario',FH_ALPHA_NUM,15,30);
$f1->passField('Clave','contrasena',FH_STRING,15,30);
$f1->submitButton('Aceptar','verificar');
$f1->borderStop();
$f1->onCorrect('procesar');

function procesar($d)
{
	if($res=bd_verifica_login($d))
	{
		session_start();
		$_SESSION['usuario']=$res;
		ir('principal.php');
	}
	else
	{   
	    ir('negacion_usuario.php');
	}
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();