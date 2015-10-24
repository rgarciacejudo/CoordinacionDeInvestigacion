<h4><?php echo $page_name; ?></h4>
<?php
echo $this->Html->link('Regresar', $this->request->referer(), array(
    'class' => 'button secondary tiny radius',
    'style' => 'margin-bottom: 1em;'
        )
);
?>
<div class="form-content small-12 medium-12 large-12">
    <div class="small-12 medium-6 large-6 columns profile-details">
        <h5>Información de publicación</h5>       
        <p><label>Título:</label><span><?php echo $publication['Publication']['title']; ?></span></p>
        <p><label>Descripción:</label><span><?php echo $publication['Publication']['description']; ?></span></p>       
        <?php $date = strtotime($publication['Publication']['publish_date']); ?>
        <p><label>Fecha de publicación:</label><span><?php echo strftime("%d/%m/%Y", $date); ?></span></p>
        <?php $date = strtotime($publication['Publication']['created']); ?>
        <p><label>Fecha de registro:</label><span><?php echo strftime("%d/%m/%Y", $date); ?></span></p>                
    </div>
    <div class="small-12 medium-6 large-6 columns profile-details">
        <h5>Detalle de pulicación</h5>        
        <?php foreach ($publication['Fields'] as $key => $value) { ?>
            <p>
                <label><?php echo $value['name']; ?>:</label>
                <?php if ($value['type'] === "Casilla de verificación") { ?>
                    <span><?php
                        echo $value['PublicationsSectionField']['value'] === "on" ?
                                "Habilitado" : "No habilitado";
                        ?></span>
                <?php } else if ($value['type'] === "Fecha") { ?>
                    <?php $date = strtotime($value['PublicationsSectionField']['value']); ?>
                    <span><?php echo strftime("%d/%m/%Y", $date); ?></span>
                <?php } else { ?>
                    <span><?php echo $value['PublicationsSectionField']['value']; ?></span>
                <?php } ?>                
            </p>
        <?php } ?>   
        <p><label>Archivo:</label>          
            <?php
            echo $this->Html->link('Ver archivo', array(
                'controller' => 'publication',
                'action' => 'download',
                $publication['Publication']['id']), array(
                'class' => 'button radius tiny secondary',
                'style' => 'margin-top: 1em;'
            ));
            ?>            
        </p>
    </div>
</div>