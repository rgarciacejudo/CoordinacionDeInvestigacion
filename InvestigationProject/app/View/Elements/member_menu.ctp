<li class="has-dropdown <?php echo $controller == 'section' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Mis Secciones', array('controller' => 'section', 'action' => 'index')); ?>
    <ul class="dropdown">    	
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'section', 'action' => 'index')); ?>
        </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'publication' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Mis Publicaciones', array('controller' => 'publication', 'action' => 'index')); ?>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Agregar', array('controller' => 'publication', 'action' => 'register')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'publication', 'action' => 'index')); ?>
        </li>
    </ul>
</li>