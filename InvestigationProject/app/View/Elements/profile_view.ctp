<?php setlocale(LC_ALL, 'es_ES'); ?>
<div class="form-content" style="margin-bottom: 1em;">
    <div class="small-12 medium-3 large-3 columns">
        <figure>
            <?php
            echo $this->Html->image($user_profile['Member']['img_profile_path'] == null ?
                            'no_img_profile.png' : $user_profile['Member']['img_profile_path'], array(
                'alt' => 'Imagen de perfil',
                'class' => 'th avatar')
            );
            ?>        
        </figure>
    </div>   
    <div class="small-12 medium-3 large-3 columns profile-details">
        <p><label>Nombre:</label><span><?php echo $user_profile['Member']['name'] . ' ' . $user_profile['Member']['last_name']; ?></span></p>
        <p><label>Usuario:</label><span><?php echo $user_profile['User']['username']; ?></span></p>
        <p><label>Rol de usuario:</label><span>
                <?php
                switch ($user_profile['User']['role']) {
                    case 'super_admin':
                        echo 'Coordinador de investigación';
                        break;
                    case 'ca_admin':
                        echo 'Administrador de cuerpo académico';
                        break;
                    case 'member':
                        echo 'Investigador';
                        break;
                }
                ?>
            </span></p>
        <?php $date = strtotime($user_profile['User']['created']); ?>
        <p><label>Fecha de registro:</label><span><?php echo strftime("%A %d de %B del %Y", $date); ?></span></p>           
    </div>
    <div class="small-12 medium-3 large-3 columns profile-details">        
        <p><label>Grado académico:</label><span><?php echo $user_profile['Member']['grade']; ?></span></p>
        <p><label>Universidad de egreso:</label><span><?php echo $user_profile['Member']['university']; ?></span></p>
        <p><label>Línea de investigación:</label><span><?php echo $user_profile['Member']['research_line']; ?></span></p>        
    </div>
    <div class="small-12 medium-3 large-3 columns profile-details">
        <p><label>Dirección:</label><span><?php echo $user_profile['Member']['address']; ?></span></p>
        <p><label>Teléfono:</label><span><?php echo $user_profile['Member']['telephone']; ?></span></p>
    </div>
    <div class="small-12 medium-12 large-12 columns profile-details">
        <p><label>Acerca de mí:</label><span><?php echo $user_profile['Member']['additional_data']; ?></span></p>
    </div>  
    <?php
    if (!$detail) {
        echo $this->Html->link('ver perfil »', array(
            'controller' => 'user',
            'action' => 'detail',
            $user_profile['User']['id']), array(
            'class' => 'more-info'));
    }
    ?>
    <?php if ($detail) { ?>    
        <div class="columns profile-details">
            <p style="margin-bottom: 0.5em;"><label>Experiencia Profesional</label></p>            
            <div class="row">
            <?php foreach ($user_profile['Member']['Experience'] as $key => $value) { ?>
                <div class="small-12 medium-3 large-3 columns" style="float: left;">
                    <ul class="pricing-table">
                        <li class="title">Actividad <?php echo $key + 1; ?></li>
                        <li class="price"><?php echo $value['Institution']['name']; ?></li>
                        <li class="description"><?php echo $value['activities']; ?></li>
                        <li class="bullet-item">De <?php echo $value['from_date']; ?> a <?php echo $value['to_date']; ?></li>
                    </ul>
                </div>
            <?php } ?>
            </div>                
        </div>
    <?php } ?>
</div>