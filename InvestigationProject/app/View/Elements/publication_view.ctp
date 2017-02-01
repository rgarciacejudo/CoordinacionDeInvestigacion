<?php if(!isset($print)) : ?>
<div class="small-12 medium-12 large-12 columns end profile-details">    
    <div class="form-content" style="margin-bottom: 1em;">
        <div class="publication-over">
            <p>
                <label>Publicó:</label>
                <span><?php echo $value['Member']['name'] . ' ' . $value['Member']['last_name']; ?></span>
            </p>
            <p>
                <label>Fecha de Finalización / Obtención / Publicación:</label>
                <span><?php echo strftime("%d/%m/%Y", strtotime($value['Publication']['publication_date'])); ?></span>
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
        <!--<?php if ($value['Publication']['file_path'] !== '') { ?>
        <p>
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
        <?php } ?>-->
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
<?php else: ?>
    <tr>    
        <td><?php echo $value['Member']['name'] . ' ' . $value['Member']['last_name']; ?></td>
        <td><?php echo strftime("%d/%m/%Y", strtotime($value['Publication']['publication_date'])); ?></td>
        <?php if($value['Section']['with_authors'] === '1') : ?>
        <td>            
            <?php foreach ($value['Authors'] as $key => $author) {
                echo $author['author'] . ($key + 1 < count($value['Authors']) ? ', ' : '');
            } ?>
        </td>        
        <?php endif; ?>
        <?php if($value['Section']['with_members'] === '1') : ?>
        <td>
            <?php foreach ($value['Members'] as $key => $member) {
                echo $member['name']. ' ' . $member['last_name'];
            } ?>
        </td>
        <?php endif; ?>
        <?php foreach ($value['Fields'] as $key => $field) { ?>
            <td>                    
                <?php if ($field['type'] === "Casilla de verificación") { ?>
                    <?php
                        echo $field['PublicationsSectionField']['value'] === "on" ?
                                "Habilitado" : "No habilitado";
                    ?>
                <?php } else if ($field['type'] === "Fecha") { ?>
                    <?php $date = strtotime($field['PublicationsSectionField']['value']); ?>
                    <?php echo strftime("%d/%m/%Y", $date); ?>
                <?php } else { ?>
                    <?php echo $field['PublicationsSectionField']['value']; ?>
                <?php } ?>
            </td>
        <?php } ?>
    </tr>
<?php endif; ?>
