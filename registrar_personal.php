<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_personal.php';
include './modelo/bd_lista_niveles.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_personal.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$foto = array(
  "path"        => './upload/personal',
  "type" 		=> "JPG jpg JPEG jpeg GIF gif PNG png BMP bmp",
  "required"    => false,
  "exists"      => "overwrite"
);

$f1=new FormHandler('personal',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->borderStart('Agregar Personal');
$f1->textField($star.'Cédula','id',FH_DIGIT,12,11);
$f1->textField($star.'Nombre','nombre',FH_STRING,30,35);
$f1->textField($star.'Apellido','apellido',FH_STRING,30,35,"onkeyup=\"personal.apellido.value=personal.apellido.value.toUpperCase();\"");
$f1->TextArea($star.'Dirección','direccion',_FH_TEXT,30,4,"onkeyup=\"personal.direccion.value=personal.direccion.value.toUpperCase();\"");
$f1->textField('Teléfono Fijo','tlf_fijo',_FH_DIGIT,15,11);
$f1->textField('Teléfono Movil','tlf_movil',_FH_DIGIT,15,11);
$f1->textField($star.'Login','login',FH_STRING,15,30);
$f1->passField($star."Clave", "clave",FH_PASSWORD,15,20);
$f1->passField($star."Confirmar Clave", "clave2",FH_PASSWORD,15,20);
$f1->checkPassword("clave","clave2");
$f1->textField('Correo Electronico','email',_FH_EMAIL,30,50);
$f1->selectField($star."Nivel de Acceso", "nivel_id",bd_lista_niveles(),FH_NOT_EMPTY,true);
$f1->jsDateField('Fecha de Ingreso','fecha_ing','validafecha',1,'d-m-y',"10:00");
$f1->uploadField('Foto', 'foto', $foto);
$f1->addLine($star ." = Campos Requeridos Obligatoriamente");
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
$f1->onCorrect("procesar");
function procesar($d)
{
	$cedula=$d['id'];
	$n=sql2value("SELECT COUNT(*) FROM personal WHERE id LIKE '$cedula'");
	if ($n==0)
	{
		$login=$d['login'];
		$n=sql2value("SELECT COUNT(*) FROM personal WHERE login LIKE '$login'");
		if ($n==0)
		{
		    $d['fecha_ing'] = f2f("$d[fecha_ing]");
			bd_guardar_personal($d);
			$_SESSION['mensaje']="PERSONAL REGISTRADO CORRECTAMENTE";	
		}
		else
		{
			$_SESSION['mensaje']="EL LOGIN YA EXISTE, POR FAVOR INTRODUZACSA UNO NUEVO";
			return false;
		}
	}
	else
	{
		$_SESSION['mensaje']="LA CÉDULA YA EXISTE, POR FAVOR INTRODUZCA UNA NUEVA";
		return false;
	}
	ir('registrar_personal.php');
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);