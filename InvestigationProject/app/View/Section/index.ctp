<?php setlocale(LC_ALL, 'es_ES'); ?>
<h4><?php echo $page_name; ?></h4>
<?php foreach ($sections as $key => $value) { ?>
    <div class="small-12 medium-3 large-3 columns end profile-details">
        <div class="form-content" style="margin-bottom: 1em;">
            <p><label>Nombre:</label><span><?php echo $value['Section']['name']; ?></span></p>
            <p><label>Descripción:</label><span><?php echo $value['Section']['description']; ?></span></p>        
            <?php $date = strtotime($value['Section']['created']); ?>
            <p><label>Fecha de registro:</label><span><?php echo strftime("%A %d de %B del %Y", $date); ?></span></p>
            <?php
            echo $this->Html->link('ver publicaciones »', array(
                'controller' => 'publication',
                'action' => 'index', 'section',
                $value['Section']['id']), array(
                'class' => 'more-info'));
            ?>
        </div>
    </div>
<?php } ?>      