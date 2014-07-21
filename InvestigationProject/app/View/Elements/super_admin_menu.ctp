<li class="has-dropdown <?php echo $controller == 'project' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Cuerpos Académicos', array('controller' => 'academic_group', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Registrar', array('controller' => 'academic_group', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'academic_group', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'user' && $action != 'edit' && $action != 'manage'  ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Líderes C.A.', array('controller' => 'user', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Registrar', array('controller' => 'user', 'action' => 'register')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'user', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>