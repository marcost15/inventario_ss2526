<?php /* Smarty version 2.6.26, created on 2012-10-11 14:59:09
         compiled from rp_cons_devoluciones.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'rp_cons_devoluciones.html', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array('title' => "SS2526 - Lista de Devoluciones")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="resultados">
<h3>DEVOLUCIONES</h3>
<p>
<div id = "indice">Total de Devoluciones: <?php echo $this->_tpl_vars['n']; ?>
</br>
		<?php unset($this->_sections['z']);
$this->_sections['z']['name'] = 'z';
$this->_sections['z']['loop'] = is_array($_loop=$this->_tpl_vars['indice']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['z']['show'] = true;
$this->_sections['z']['max'] = $this->_sections['z']['loop'];
$this->_sections['z']['step'] = 1;
$this->_sections['z']['start'] = $this->_sections['z']['step'] > 0 ? 0 : $this->_sections['z']['loop']-1;
if ($this->_sections['z']['show']) {
    $this->_sections['z']['total'] = $this->_sections['z']['loop'];
    if ($this->_sections['z']['total'] == 0)
        $this->_sections['z']['show'] = false;
} else
    $this->_sections['z']['total'] = 0;
if ($this->_sections['z']['show']):

            for ($this->_sections['z']['index'] = $this->_sections['z']['start'], $this->_sections['z']['iteration'] = 1;
                 $this->_sections['z']['iteration'] <= $this->_sections['z']['total'];
                 $this->_sections['z']['index'] += $this->_sections['z']['step'], $this->_sections['z']['iteration']++):
$this->_sections['z']['rownum'] = $this->_sections['z']['iteration'];
$this->_sections['z']['index_prev'] = $this->_sections['z']['index'] - $this->_sections['z']['step'];
$this->_sections['z']['index_next'] = $this->_sections['z']['index'] + $this->_sections['z']['step'];
$this->_sections['z']['first']      = ($this->_sections['z']['iteration'] == 1);
$this->_sections['z']['last']       = ($this->_sections['z']['iteration'] == $this->_sections['z']['total']);
?>
		<a href="?li=<?php echo $this->_tpl_vars['indice'][$this->_sections['z']['index']]['li']; ?>
">[<?php echo $this->_tpl_vars['indice'][$this->_sections['z']['index']]['li']; ?>
-<?php echo $this->_tpl_vars['indice'][$this->_sections['z']['index']]['ls']; ?>
]</a> <?php endfor; endif; ?><a href="?accion=todos">[Todos]</a>
	</div>
</p>
<table class="enhancedtable" border="1" cellspacing="3" cellpadding="3" width="100%">
	<tr> 
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>Fecha</th>
		<th>Personal</th>
		<th>Tipo</th>
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
	<tr class="linea<?php echo smarty_function_cycle(array('values' => '1,2'), $this);?>
">
	    <th><?php echo $this->_sections['p']['index_next']; ?>
</th>
		<td><a href="rp_detalle_devoluciones.php?id=<?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['id']; ?>
&tipo=<?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo']; ?>
"><img onmouseover='overlib("<strong>Examinar</strong>",WIDTH, 70)' src="./imagenes/ver.ico" onmouseout='return nd();'/></a></td>
		<td><b><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['fecha']; ?>
</b></td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['personal_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo']; ?>
</td>
	</tr><?php endfor; endif; ?>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>