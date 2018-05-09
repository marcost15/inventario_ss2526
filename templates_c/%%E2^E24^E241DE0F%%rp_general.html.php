<?php /* Smarty version 2.6.26, created on 2012-04-07 00:24:38
         compiled from rp_general.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array('title' => "SS2526 - Inventario")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="resultados">
<h3>INVENTARIO GENERAL</h3>
<p>
</p>
<table class="enhancedtable" cellspacing="0" cellpadding = "3" border="1" align="center" width="100%">
	<tr> 
		<th>Articulo</th>
	    <th>Almacenados</th>
		<th>Asignados</th>
		<th>Instalados</th>
		<th>Cambiados</th>
		<th>Desinstalados</th>
		<th>Entregados</th>
		<th>Totales</th>
		
	</tr>
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
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['alm']): ?>
			<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['alm']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['asig']): ?>
			<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['asig']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['inst']): ?>
			<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['inst']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['camb']): ?>
			<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['camb']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['desinst']): ?>
			<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['desinst']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['entregados']): ?>
			<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['entregados']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['total']; ?>
</td>
	</tr><?php endfor; endif; ?>
	<tr> 
		<th>Totales</th>
	    <th><?php echo $this->_tpl_vars['totalalm']; ?>
</th>
		<th><?php echo $this->_tpl_vars['totalasig']; ?>
</th>
		<th><?php echo $this->_tpl_vars['totalinst']; ?>
</th>
		<th><?php echo $this->_tpl_vars['totalcamb']; ?>
</th>
		<th><?php echo $this->_tpl_vars['totaldesint']; ?>
</th>
		<th><?php echo $this->_tpl_vars['totalentregados']; ?>
</th>
		<th><?php echo $this->_tpl_vars['totaltotal']; ?>
</th>
	</tr>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>