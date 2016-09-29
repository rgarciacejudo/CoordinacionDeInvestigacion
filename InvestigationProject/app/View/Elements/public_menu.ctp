<li class="has-dropdown <?php echo $this->params['controller'] == 'academic_group' ? 'active' : ''; ?>">
    <a>Cuerpos Académicos</a>
    <ul class="dropdown">        
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'academic_group', 'action' => 'index')); ?>
        </li>
        <li class="has-dropdown">
            <a>Líderes C.A.</a>
            <ul class="dropdown">               
                <li>
                    <?php echo $this->Html->link('Consultar', array('controller' => 'user', 'action' => 'index', 'leaders')); ?>
                </li>
            </ul>
        </li>
    </ul>
</li>
<!--<li <?php
echo ($this->params['controller'] == 'section' ?
        'class = "active"' : '');
?>>
        <?php
        echo $this->Html->link('Secciones', array(
            'controller' => 'section',
            'action' => 'index',
            'all'
                )
        );
        ?>
</li>-->
<li class="has-dropdown" <?php
echo ($this->params['controller'] == 'user' ?
        'class = "active"' : '');
?>>
    <a>Investigadores</a>
    <ul class="dropdown">               
        <li>
            <?php echo $this->Html->link('Todos', 
                    array('controller' => 'user', 'action' => 'index', 'all')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Por Cuerpo Académico', 
                    array('controller' => 'AcademicGroup', 'action' => 'index', 'members')); ?>
        </li>
    </ul>
</li>