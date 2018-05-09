<?php /* Smarty version 2.6.26, created on 2012-04-07 00:44:00
         compiled from registrar_dev_prov_manual.html */ ?>
﻿<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array('title' => "SS2526 - Registrar Devolucion a Proveedor")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($_SESSION['mensaje']): ?>
</p>
<div class="mensaje"><?php echo $_SESSION['mensaje']; ?>
</div>
<?php endif; ?>
<h3><font size=4>Devolución Equipos a Proveedor</font></h3> 
<table class="enhancedtable" cellspacing="0" cellpadding = "3" border="1" align="center" width="100%">
  <thead>
    <tr>
	  <td colspan="7" align="center"><font size=4><strong>Equipos</strong></font></td>
	</tr>
	<tr>
      <th>Articulo</th>
      <th>Serial</th>
	  <th>Cantidad</th>
	  <th><a href="#" onClick="flash('forma1')"><img onmouseover='overlib("<strong>Agregar &#237;tem</strong>",WIDTH, 70)' src="./imagenes/boton1.png" onmouseout='return nd();'/></a></th>
    </tr>
  </thead>
  <tbody>
<?php $this->assign('equipos', $_SESSION['dev_pro_manual']); ?> 
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['equipos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
    <tr>
      <td><?php echo $this->_tpl_vars['equipos'][$this->_sections['i']['index']]['articulo_nombre']; ?>
</td>
      <td><?php echo $this->_tpl_vars['equipos'][$this->_sections['i']['index']]['serial']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['equipos'][$this->_sections['i']['index']]['cantidad']; ?>
</td>
	  <td><a href="?accion=eliminar&amp;id=<?php echo $this->_sections['i']['index']; ?>
"><img onmouseover='overlib("<strong>Eliminar</strong>",WIDTH, 70)' src="./imagenes/eliminar.png" onmouseout='return nd();'/></a></td>
    </tr>
<?php endfor; endif; ?>    
  </tbody>
</table>
<p></p>
<?php if ($this->_tpl_vars['items'] > 0): ?>
<table border="0" width="100%">
	<tr> 
		<td align="center">
			<font size="3"><strong><a href="registrar_dev_prov_manual2.php" onClick="return confirm('Si los datos est&#225;n correctos pulse OK, de lo contrario Cancele y corrija')">Guardar Devolución a Proveedor<img onmouseover='overlib("<strong>Asignar</strong>",WIDTH, 70)' src="./imagenes/seleccionar.ico" onmouseout='return nd();'/></a></strong></font>
		</td>
	</tr>
</table>
<?php endif; ?>
</P>
<div id="forma1" style="display:none">
<?php echo $this->_tpl_vars['f1']; ?>

</div>
<p>&nbsp;</p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script>
function flash(a)
{
    document.getElementById(a).style.setProperty("display","inline","")
}
</script>
'; ?>