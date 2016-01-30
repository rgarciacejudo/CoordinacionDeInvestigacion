<h4><?php echo $page_name; ?></h4>
<?php if(!isset($print)) {
	echo $this->Html->link('Regresar', $this->request->referer(), array(
        'class' => 'button secondary tiny radius',
        'style' => 'margin-bottom: 1em;'
    	)
	); ?>
	<a target="_blank" href="<?php echo $this->Html->url(array("controller" => "academic_group", "action" => "members", $academic_group_id, "print")); ?>"style="padding: 4px; float: right;" class="button secondary tiny radius"><i style="display: table-cell;" class="download-icon"></i> <span style="display: table-cell; vertical-align: middle;">PDF</span></a>
<?php } ?>

<?php 
	foreach ($members as $key => $value) {
	    echo $this->element('profile_view', array('user_profile' => $value)) . 
	    	'<div style="page-break-before: always;"></div>';
	}
?>