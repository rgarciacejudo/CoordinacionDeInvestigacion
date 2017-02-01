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
        <p>
            <label>Publicó:</label>
            <span><?php echo $publication['Member']['name'] . ' ' . $publication['Member']['last_name']; ?></span>
        </p>
        <p>
            <label>Fecha de Finalización / Obtención / Publicación:</label>
            <span><?php echo strftime("%d/%m/%Y", strtotime($publication['Publication']['publication_date'])); ?></span>
        </p>
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
        <?php if ($publication['Publication']['file_path'] !== '') { ?>
        <p>
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
        <?php } ?>
    </div>
	<div class="small-12 medium-6 large-6 columns profile-details">
        <?php if($publication['Section']['with_authors'] === '1') : ?>
            <h5>Autores</h5>        
            <?php foreach ($publication['Authors'] as $key => $value) { ?>
                <p><span><?php echo $value['author']; ?></span></p>
            <?php } ?>
        <?php endif; ?>
        <?php if($publication['Section']['with_members'] === '1') : ?>
            <h5>Integrantes de CA que participaron</h5>
            <?php foreach ($publication['Members'] as $key => $value) { ?>
                <p><span><?php echo $value['name']. ' ' . $value['last_name'] . ' ('. $value['User']['username'] .')'; ?></span></p>
            <?php } ?>
            <?php if(count($publication['Members']) === 0) : ?>
            <span>No hay integrantes</span>
            <?php endif; ?>
        <?php endif; ?>
	</div>
</div>
