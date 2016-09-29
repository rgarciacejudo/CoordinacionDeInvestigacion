<li class="has-dropdown <?php echo $this->params['controller'] == 'academic_group' ? 'active' : ''; ?>">
    <a>Cuerpos académicos</a>
    <ul class="dropdown">        
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'academic_group', 'action' => 'index')); ?>
        </li>
        <li class="has-dropdown">
			<a>Investigadores</a>            
            <ul class="dropdown">                
                <li class="has-dropdown">
                    <a>Consultar</a>
                    <ul class="dropdown">
                        <li>
                            <?php echo $this->Html->link('Todos', array('controller' => 'user', 'action' => 'index', 'all'));
                            ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('Por Cuerpo Académico', array('controller' => 'academic_group', 'action' => 'index', 'members'));
                            ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</li>
<!--<li class="<?php echo $controller == 'section' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Secciones', array('controller' => 'section', 'action' => 'index')); ?>
</li>-->
<li class="has-dropdown <?php echo $controller == 'publication' ? 'active' : ''; ?>">
    <a>Producción</a>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Mi Producción', array('controller' => 'publication', 'action' => 'index', 'mine')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Agregar', array('controller' => 'publication', 'action' => 'register')); ?>
        </li>
    </ul>
</li>