<?php if(!isset($section["SectionsField"])){ ?>
<div class="small-12 medium-6 large-6 columns end profile-details">    
    <div class="form-content" style="margin-bottom: 1em;">
<?php } else { ?>
<div class="section-detail form-content">
    <div class="small-12 medium-6 large-6 columns end profile-details">
<?php } ?>    
        <p>
            <span>
            <?php echo $this->Html->image($section['Section']['icon'] == null ? 'no_img_section.png' : 
                $section['Section']['icon'], array(
            'alt' => $section['Section']['name'],
            'class' => 'th avatar'));?>
            </span>
        </p>
        <p><label>Nombre:</label><span><?php echo $section['Section']['name']; ?></span></p>
        <p><label>Descripción:</label><span><?php echo $section['Section']['description']; ?></span></p>        
        <?php
        if(!isset($section["SectionsField"])){
            echo $this->Html->link('ver detalle »', array(
                'controller' => 'section',
                'action' => 'detail', $section['Section']['id']), array(
                'class' => 'more-info'));
            if ($this->Session->read('Auth.User.role') == 'super_admin') {
                echo "<br />";
                echo $this->Html->link('administrar »', array(
                    'controller' => 'section',
                    'action' => 'admin', $section['Section']['id']), array(
                    'class' => 'more-info'));
                echo "<br />";
                echo $this->Form->postLink('borrar »', array(
                    'controller' => 'section',
                    'action' => 'delete', $section['Section']['id']),
                    array('class' => 'more-info'),
                    'Está seguro de eliminar la sección?'
                );
            }   
        } 
        ?> 
    </div>
    <?php if(isset($section["SectionsField"])) { ?>    
    <div class="small-12 medium-6 large-6 columns end profile-details">
        <p><label>Estructura</label></p>
        <?php foreach ($section["SectionsField"] as $key => $value) { ?>
            <div class="small-12 medium-6 large-6 columns end profile-details">
                <p><label>Campo: </label><span><?php echo $value["name"]; ?></span></p>
            </div>
            <div class="small-12 medium-6 large-6 columns end profile-details">
                <p><label>Tipo: </label><span><?php echo $value["type"]; ?></span></p>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>