<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';

$filter = $_POST['filter'];
switch( $_POST['field'] ) {
    case 'ciudad_id':
        if( $filter != 0 ) 
		{
		    $ciudad_id = sql2opciones("SELECT id,nombre FROM ciudades WHERE estado_id = '$filter'"); 
        	$n = count($ciudad_id);
			if ($n != 0)
            {
                FormHandler::setDynamicOptions($ciudad_id); 
				break;
			}
		}
       default:
          FormHandler::setDynamicOptions( array() );
      break;          
}  