<li class="<?php echo $controller == 'section' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Secciones', array('controller' => 'section', 'action' => 'index')); ?>    
</li>
<li class="has-dropdown <?php echo $controller == 'publication' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Publicaciones', array('controller' => 'publication', 'action' => 'index')); ?>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Mis Publicaciones', array('controller' => 'publication', 'action' => 'index', 'mine')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Agregar', array('controller' => 'publication', 'action' => 'register')); ?>
        </li>
    </ul>
</li>