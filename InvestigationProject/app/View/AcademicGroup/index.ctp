<h4><?php echo $page_name; ?></h4>
<?php setlocale(LC_ALL, 'es_ES'); ?>
<?php foreach ($academic_groups as $key => $academic_group) { ?>   
    <div class="form-content" style="margin-bottom: 1em;">
        <div class="small-12 medium-6 large-6 columns  profile-details">
            <p><label>Nombre:</label><span><?php echo $academic_group['AcademicGroup']['name']; ?></span></p>
            <p><label>Nivel:</label><span><?php echo $academic_group['AcademicGroup']['level']; ?></span></p>
            <?php $date = strtotime($academic_group['AcademicGroup']['created']); ?>
            <p><label>Fecha de registro:</label><span><?php echo strftime("%d/%m/%Y", $date); ?></span></p>
        </div>
        <div class="small-12 medium-6 large-6 columns  profile-details">
            <p>
                <label>Líder:</label><span><?php echo $academic_group['Leader']['username']; ?></span>
                <?php
                echo $this->Html->link('ver líder »', array(
                    'controller' => 'user',
                    'action' => 'detail',
                    $academic_group['Leader']['id']), array(
                    'class' => 'more-info'));
                ?>
            </p>
            <p><label>Descripción:</label><span><?php echo $academic_group['AcademicGroup']['description']; ?></span>
                <?php
                echo $this->Html->link('ver miembros »', array(
                    'controller' => 'user',
                    'action' => 'academicgroupmembers',
                    $academic_group['AcademicGroup']['id']), array(
                    'class' => 'more-info'));
                ?>
                <br />
                <?php
                echo $this->Html->link('ver producción »', array(
                    'controller' => 'publication',
                    'action' => 'index',
                    'ca', $academic_group['AcademicGroup']['id']), array(
                    'class' => 'more-info'));
                ?>
            </p>            
            <p>
                <?php                
                if (isset($this->params['pass'][0]) && $this->params['pass'][0] === 'admin' && $authUser["role"] === 'ca_admin') {
                    echo "<br />";
                    echo $this->Html->link('administrar »', array(
                        'controller' => 'academic_group',
                        'action' => 'admin',
                        $academic_group['AcademicGroup']['id']), array(
                        'class' => 'more-info'));
                }
                ?>
            </p>            
        </div> 
        <?php if(isset($isMembersDetail)){ ?>
        <div class="small-12 medium-12 large-12 columns profile-details" style="padding:0.5em; border:1px solid gainsboro;border-radius: 5px;">
            <p><label>Miembros:</label></p>
            <?php if(count($academic_group['Members']) === 0){ ?>
            <span>Este grupo académico aún no cuenta con miebros.</span>
            <?php } ?>
            <?php foreach ($academic_group['Members'] as $member) { ?>
            <div class="member-item row" style="padding:1em;">
                    <div class="small-3 medium-2 large-2 columns">
                        <figure>
                            <?php
                            echo $this->Html->image($member['img_profile_path'] == null ?
                                            'no_img_profile.png' : $member['img_profile_path'], array(
                                'alt' => 'Imagen de perfil',
                                'style' => 'height: 50px;width: 50px;',
                                'class' => 'th avatar')
                            );
                            ?>        
                        </figure>
                    </div>   
                    <div class="small-9 medium-10 large-10 columns">
                        <div class="small-12 medium-6 large-6 columns">
                            <p><label>Nombre:</label><span><?php echo $member['name'] . ' ' . $member['last_name']; ?></span></p>
                        </div>
                        <div class="small-12 medium-6 large-6 columns">
                            <p><label>Acerca de mí:</label>
                                <span>
                                    <?php echo empty($member['additional_data']) ? 
                                        'No registrado' : $member['additional_data']; ?>
                                </span>
                            </p>
                        </div>                    
                    </div>
                    <?php
                    echo $this->Html->link('ver perfil completo »', array(
                        'controller' => 'user',
                        'action' => 'detail',
                        $member['user_id']), array(
                        'class' => 'more-info'));
                    ?>    
                </div>
            <?php } ?>               
        </div>
        <?php } ?>
    </div>
<?php } ?>
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
