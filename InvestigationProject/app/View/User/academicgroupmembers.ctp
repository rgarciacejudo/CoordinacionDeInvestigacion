<h4><?php echo $page_name . ' - ' . $academic_group['AcademicGroup']['name']; ?></h4>
<?php if(!isset($print)) { ?>
<div class="row">
    <div class="large-12 medium-12 columns">
        <?php     
    	echo $this->Html->link('Regresar', array('controller'=>'academic_group', 'action'=>'index'), array(
            'class' => 'button secondary tiny radius',
            'style' => 'margin-bottom: 1em;'
        	)
    	); ?>
    	<a target="_blank" href="<?php echo $this->Html->url(array("controller" => "user", "action" => "academicgroupmembers", $academic_group_id, "print")); ?>"style="padding: 4px; float: right;" class="button secondary tiny radius"><i style="display: table-cell;" class="download-icon"></i> <span style="display: table-cell; vertical-align: middle;">PDF</span></a>
    </div>
</div>
<?php } ?>

<?php 
	foreach ($members as $key => $value) {
	    echo $this->element('profile_view', array('user_profile' => $value)) . 
	    	'<div style="page-break-before: always;"></div>';
	}
?>
<?php if(!isset($print)) { ?>
<div class="large-6 medium-6 columns">
    <ul class="pagination" role="menubar" aria-label="Pagination">
        <?php
        echo $this->Paginator->prev('« Anterior', array(
            'tag' => 'li'
        ));
        ?>
        <?php
        echo $this->Paginator->numbers(array(
            'separator' => '',
            'currentClass' => 'current',
            'tag' => 'li',
            'currentTag' => 'a'
        ));
        ?>
        <?php
        echo $this->Paginator->next('Siguiente »', array(
            'tag' => 'li'
        ));
        ?> 
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
<?php } ?>