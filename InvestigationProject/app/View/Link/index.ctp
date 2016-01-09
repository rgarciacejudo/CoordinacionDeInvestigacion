<h4><?php echo $page_name; ?></h4>
<div class="form-content" style="margin-bottom: 1em;">
<?php foreach ($links as $key => $link) { ?>   
	
    <div class="small-12 medium-6 large-6 columns  profile-details">
      <p>
      	<label>Nombre:</label>
      	<span><?php echo $link['Link']['name']; ?></span>
      </p>
      <p>
      	<label>Texto de link:</label>
      	<span><?php echo $link['Link']['display_name']; ?></span>
      </p>
      <p>
      	<label>URL:</label>
      	<span><?php echo $this->Html->link($link['Link']['url'], $link['Link']['url']); ?></span>
      </p>
      <?php
        echo $this->Form->postLink('borrar »', array(
            'controller' => 'link',
            'action' => 'delete', $link['Link']['id']), array(
            'confirm' => '¿Desea borrar permanentemente el link?',
            'class' => 'more-info'));
      ?>
    </div>  
<?php } ?>
</div>
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