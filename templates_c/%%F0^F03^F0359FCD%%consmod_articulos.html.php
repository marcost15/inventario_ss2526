<?php /* Smarty version 2.6.26, created on 2012-04-07 00:22:49
         compiled from consmod_articulos.html */ ?>
﻿<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array('title' => "SS2526 - Consultas de Articulos")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h4>BUSQUEDA DE ARTICULOS</h4>
<p>Escriba en el cuadro texto para hacer una busqueda completa</p>

<?php echo $this->_tpl_vars['f1']; ?>


<?php if ($this->_tpl_vars['datos']): ?>
<h4>Articulos Solicitados</h4>
<div id="resultados">
<table class="enhancedtable" border="0" cellspacing="3" cellpadding="3" width="100%">
<thead>
	<tr> 
		<th>Descripción</th>
		<th>Marca</th>
		<th>Modelo</th>
		<th>Tipo</th>
		<th>&nbsp;</th>
	</tr>
</thead>
<tbody>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['datos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
	<tr>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['descripcion']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['marca']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['modelo']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo_id']; ?>
</td>
		<td><a href="modificar_articulos.php?id=<?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['id']; ?>
"><img onmouseover='overlib("<strong>Modificar</strong>",WIDTH, 70)' src="./imagenes/boton1.png" onmouseout='return nd();'/></a></td>
	</tr><?php endfor; endif; ?>
</tbody>
</table>
</div>
<?php else: ?>
	<?php if ($this->_tpl_vars['error1'] == 2): ?> 
		<h3>NO SE ENCONTRÓ ARTICULOS CON ESOS PARAMETROS, VERIFIQUE...</h3>
	<?php else: ?>
		<?php if ($this->_tpl_vars['error1'] == 1): ?> 
			<h3>NO SE ENCONTRÓ PERSONAL CUYO APELLIDO COMIENZA POR ESA LETRA, VERIFIQUE...</h3>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>