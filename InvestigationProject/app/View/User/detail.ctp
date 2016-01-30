<h4><?php echo $page_name; ?></h4>
<?php
if(!isset($print)){
	echo $this->Html->link('Regresar', $this->request->referer(), array(
	        'class' => 'button secondary tiny radius',
	        'style' => 'margin-bottom: 1em;'
	    )
	);
}
?>
<?php echo $this->element('profile_view', array('user_profile' => $user, 'detail' => true)); ?>