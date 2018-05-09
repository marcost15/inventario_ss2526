<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_recordatorio.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_recordatorio.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$tipo = array(
'PRIVADO' => 'PRIVADO',
'PUBLICO' => 'PÚBLICO'
);
$f1=new dbFormHandler('recordatorio',NULL,'onclick="highlight(event)"');
$f1->borderStart('Registro de Recordatorio');
$f1->hiddenField('personal_id', $_SESSION['usuario']['id']);
$f1->textarea('Asunto','asunto',FH_TEXT,50,2);
$f1->setMaxLength("asunto", 255);
$f1->selectField("Tipo", "tipo", $tipo, FH_NOT_EMPTY, true);
$f1->onCorrect('proceso');
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Registrar','registrar');
$f1->resetButton('Limpiar','limpiar'); 
$f1->borderStop();

function proceso($d)
{  
	$personal_id=$d['personal_id'];
	$n=sql2value("SELECT COUNT(*) FROM personal WHERE id LIKE '$personal_id'");
	if ($n<>0)
	{  
		bd_guardar_recordatorio($d);
		$_SESSION['mensaje']="RECORDATORIO PROCESADO CORRECTAMENTE";
	}
	else
	{
		$_SESSION['mensaje']="EL PERSONAL NO EXISTE.. VERIFIQUE O INICIE NUEVAMENTE SESSION";
		return false;
	}	
	ir('registrar_recordatorio.php');
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);