<?php setlocale(LC_ALL, 'es_ES'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="row">
    <?php foreach ($publications as $key => $value) { ?>
        <?php echo $this->element('publication_view', array('value' => $value, 'mine' => isset($mine) ? $mine : false)); ?>
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
