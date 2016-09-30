<div class="small-12 medium-3 large-3 columns end profile-details">
    <div class="form-content" style="margin-bottom: 1em;">
        <div class="publication-over">
            <p>
                <label>Publicó:</label>
                <span><?php echo $value['Member']['name'] . ' ' . $value['Member']['last_name']; ?></span>
            </p>
            <?php foreach ($value['Fields'] as $key => $field) { ?>
                <p>
                    <label><?php echo $field['name']; ?>:</label>
                    <?php if ($field['type'] === "Casilla de verificación") { ?>
                        <span><?php
                            echo $field['PublicationsSectionField']['value'] === "on" ?
                                    "Habilitado" : "No habilitado";
                            ?></span>
                    <?php } else if ($field['type'] === "Fecha") { ?>
                        <?php $date = strtotime($field['PublicationsSectionField']['value']); ?>
                        <span><?php echo strftime("%d/%m/%Y", $date); ?></span>
                    <?php } else { ?>
                        <span><?php echo $field['PublicationsSectionField']['value']; ?></span>
                    <?php } ?>                
                </p>
            <?php } ?>  
        </div>
        <?php if ($value['Publication']['file_path'] !== '') { ?>
        <p><label>Archivo:</label>          
            <?php        
            echo $this->Html->link('Ver archivo', array(
                'controller' => 'publication',
                'action' => 'download',
                $value['Publication']['id']), array(
                'class' => 'button radius tiny secondary',
                'style' => 'margin-top: 1em;'
            ));
            ?>            
        </p>
        <?php } ?>
        <?php if(isset($mine) && $mine === true){
            echo $this->Html->link('editar »', array(
                'controller' => 'publication',
                'action' => 'edit', $value['Publication']['id']), array(
                'class' => 'more-info'));
            echo '<br>';            
            echo $this->Form->postLink('borrar »', array(
                'controller' => 'publication',
                'action' => 'delete', $value['Publication']['id']), array(
                'confirm' => '¿Desea borrar permanentemente el producto?',
                'class' => 'more-info'));
            echo '<br>';
        }
        ?>
        <?php
        echo $this->Html->link('ver detalle »', array(
            'controller' => 'publication',
            'action' => 'detail', $value['Publication']['id']
            ), array(
            'class' => 'more-info'));
        ?>
    </div>
</div>