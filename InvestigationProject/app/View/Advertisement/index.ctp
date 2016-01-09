<h4><?php echo $page_name; ?></h4>
<div class="form-content" style="margin-bottom: 1em;">
<?php foreach ($advertisements as $key => $ad) { ?>   	 
    <div class="small-12 medium-6 large-6 columns  profile-details">      
      <p>
        <?php
        echo $this->Html->image($ad['Advertisement']['file_path'], array(
            'alt' => 'Imagen de anuncio',
            'class' => 'th'
            ));
        ?>        
      </p>
      <p>
      	<label>Nombre:</label>
      	<span><?php echo $ad['Advertisement']['name']; ?></span>
      </p>
      <p>
      	<label>Descripción:</label>
      	<span><?php echo $ad['Advertisement']['description']; ?></span>
      </p>
      <p>
        <label>URL:</label>
        <span><?php echo $this->Html->link($ad['Advertisement']['url'], $ad['Advertisement']['url']); ?></span>
      </p>
      <p>
      	<label>Fecha límite de visualización:</label>
      	<span><?php echo $ad['Advertisement']['expiration_date']; ?></span>
      </p>
      <?php
        echo $this->Form->postLink('borrar »', array(
            'controller' => 'advertisement',
            'action' => 'delete', $ad['Advertisement']['id']), array(
            'confirm' => '¿Desea borrar permanentemente el anuncio?',
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