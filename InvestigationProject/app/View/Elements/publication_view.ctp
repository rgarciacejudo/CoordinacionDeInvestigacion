<div class="form-content" style="margin-bottom: 1em;">		
	<div class="small-12 medium-12 large-12 columns profile-details">
		<p>
			<label>Creada por:</label>
			<span>
				<?php 
				echo $member["name"].' '.$member["last_name"].' - '.$user["username"]; 
				if(!isset($print)){
					echo $this->Html->link('ver perfil »', array(
		                'controller' => 'user',
		                'action' => 'detail',
		                $user['id']), array(
		                'class' => 'more-info'));
	            } ?>
			</span>
		</p>		
		<p><label>Título:</label><span><?php echo $publication["title"]; ?></span></p>
		<p><label>Descripción:</label><span><?php echo $publication["description"]; ?></span></p>
		<p><label>Fecha de publicación:</label><span><?php echo $publication["publish_date"]; ?></span></p>
		<?php if($publication["file_path"] != '') { ?> 
			<p><label>Descargar:</label>
				<?php if(!isset($print)){
					echo $this->Html->link('', array(
						'controller' => 'publication', 
						'action' => 'download', 
						$publication["id"]), array(
	    			'class' => 'button secondary tiny radius download-icon',
	    			'style' => 'margin-top: 0.25em;'
						)
					); 
				} else { ?>
				<a class="button secondary tiny radius download-icon" style="margin-top: 0.25em;"></a>
				<?php } ?>					
			</p>
		<?php } ?>			
	</div>
</div>