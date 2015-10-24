<?php setlocale(LC_ALL, 'es_ES'); ?>
<h4><?php echo $page_name; ?></h4>
<?php
echo $this->Html->link('Regresar', $this->request->referer(), array(
        'class' => 'button secondary tiny radius',
        'style' => 'margin-bottom: 1em;'
    )
);
?>
<?php foreach ($publications as $key => $value) { ?>
    <div class="small-12 medium-3 large-3 columns end profile-details">
        <div class="form-content" style="margin-bottom: 1em;">
            <p><label>Título:</label><span><?php echo $value['Publication']['title']; ?></span></p>
            <p><label>Descripción:</label><span><?php echo $value['Publication']['description']; ?></span></p>       
            <?php $date = strtotime($value['Publication']['publish_date']); ?>
            <p><label>Fecha de publicación:</label><span><?php echo strftime("%d/%m/%Y", $date); ?></span></p>
            <?php $date = strtotime($value['Publication']['created']); ?>
            <p><label>Fecha de registro:</label><span><?php echo strftime("%d/%m/%Y", $date); ?></span></p>
            <?php
            echo $this->Html->link('ver detalle »', array(
                'controller' => 'publication',
                'action' => 'detail', $value['Publication']['id']
                ), array(
                'class' => 'more-info'));
            ?>
        </div>
    </div>
<?php } ?>   