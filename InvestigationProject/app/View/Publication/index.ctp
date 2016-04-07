<?php setlocale(LC_ALL, 'es_ES'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="row">
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
</div>
<div class="">
    <div class="large-6 medium-6 columns">
        <ul class="pagination" role="menubar" aria-label="Pagination">
            <?php echo $this->Paginator->prev('« Anterior', array(
                'tag' => 'li'
            )); ?>
            <?php echo $this->Paginator->numbers(array(
                'separator' => '',
                'currentClass' => 'current',
                'tag' => 'li',
                'currentTag' => 'a'
            )); ?>
            <?php echo $this->Paginator->next('Siguiente »', array(
                'tag' => 'li'
            )); ?> 
        </ul>
    </div>
    <div class="large-6 medium-6 columns">
        <label style="float: right;"><?php
            echo $this->Paginator->counter(array(
                'format' => 'Página {:page} de {:pages}, mostrando {:current} registros de 
                 {:count}.'
            ));
            ?>
        </label>
    </div>
</div>
