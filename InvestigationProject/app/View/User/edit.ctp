<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<?php echo $this->Html->css('linecons'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="form-content">       
    <div class="small-12 medium-6 large-6 columns">
        <h6>Cuenta</h6>           
        <div class="row">
            <div class="column">
                <?php
                echo $this->Form->create('User', array(
                    'type' => 'file',
                    'url' => array('controller' => 'user', 'action' => 'img_change')
                ));
                ?>
                <label>Imagen de perfil
                    <figure class="text-center">
                        <?php
                        echo $this->Html->image($img_profile == null ? 'no_img_profile.png' : $img_profile, array(
                            'alt' => 'Imagen de perfil',
                            'class' => 'th avatar'));
                        ?>
                        <span id="selected_file">No se ha seleccionado un archivo.</span>
                        <?php
                        echo $this->Form->input('img', array(
                            'label' => false,
                            'type' => 'file',
                            'hidden' => '1'
                        ));
                        ?>
                    </figure>                
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <?php
                echo $this->Form->end(array(
                    'label' => 'Cambiar imagen',
                    'class' => 'button tiny radius right',
                    'div' => array(
                        'class' => 'columns'
                    )
                ));
                ?>
            </div>
        </div>  
        <?php echo $this->Form->create(); ?>
        <div class="row">
            <div class="column">
                <label>Usuario
                    <?php
                    echo $this->Form->input('User.username', array(
                        'label' => false,
                        'placeholder' => 'contraseña actual',
                        'class' => 'radius',
                        'readonly' => '1'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">                
                <?php
                echo $this->Html->link('Cambiar contraseña', array(
                    'controller' => 'user',
                    'action' => 'manage'
                        ), array(
                    'class' => 'button tiny radius right'
                        )
                );
                ?>
            </div>
        </div>        
    </div>       
    <div class="small-12 medium-6 large-6 columns">        
        <h6>Información personal</h6>
        <div class="row">
            <div class="column">
                <label>Nombre(s)                
                    <?php
                    echo $this->Form->input('Member.name', array(
                        'label' => false,
                        'placeholder' => 'nombre(s)',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Apellidos
                    <?php
                    echo $this->Form->input('Member.last_name', array(
                        'label' => false,
                        'placeholder' => 'apellidos',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Dirección
                    <?php
                    echo $this->Form->input('Member.address', array(
                        'label' => false,
                        'placeholder' => 'dirección',
                        'rows' => '3',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Teléfono
                    <?php
                    echo $this->Form->input('Member.telephone', array(
                        'label' => false,
                        'placeholder' => 'teléfono',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>        
    </div>    
    <div class="small-12 medium-12 large-12 columns">
        <div class="row">
            <div class="column">
                <label>Acerca de mí
                    <?php
                    echo $this->Form->input('Member.additional_data', array(
                        'label' => false,
                        'placeholder' => 'queremos conocerte',
                        'rows' => '4',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
    </div>
    <div class="small-12 medium-6 large-6 columns">      
        <div class="row">
            <div class="column">
                <label>Línea de investigación
                    <?php
                    echo $this->Form->input('Member.research_line', array(
                        'label' => false,
                        'placeholder' => 'línea de investigación',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Grado académico
                    <?php
                    echo $this->Form->input('Member.research_line', array(
                        'label' => false,
                        'placeholder' => 'grado académico',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Univerdad de egreso
                    <?php
                    echo $this->Form->input('Member.research_line', array(
                        'label' => false,
                        'placeholder' => 'universidad de egreso',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>SNI
                    <?php
                    echo $this->Form->input('Member.SNI', array(
                        'options' => $SNI_options,
                        'empty' => 'Sin definir',
                        'label' => false,
                        'placeholder' => 'SNI',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>        
        <div class="row collapse">                        
            <label>Validez SNI</label>
            <div class="small-3 large-2 columns">
                <span aria-hidden="true" class="radius-left prefix li_calendar"></span> 
            </div>
            <?php
            echo $this->Form->input('Member.SNI_validity_date', array(
                'label' => false,
                'placeholder' => 'validez SNI',
                'class' => 'radius-right',
                'type' => 'text',
                'div' => array(
                    'class' => 'small-9 large-10 columns'
                )
            ));
            ?> 
        </div>
        <div class="row">
            <div class="column">
                <label>PROMEP</label>
                <?php
                echo $this->Form->input('Member.PROMEP', array(
                    'label' => 'Aplica',
                    'placeholder' => 'PROMEP',
                    'class' => 'radius'
                ));
                ?>

            </div>
        </div>
        <div class="row collapse">            
            <label>Validez PROMEP</label>
            <div class="small-3 large-2 columns">
                <span aria-hidden="true" class="radius-left prefix li_calendar"></span> 
            </div>
            <?php
            echo $this->Form->input('Member.PROMEP_validity_date', array(
                'label' => false,
                'placeholder' => 'validez PROMEP',
                'class' => 'radius-right',
                'type' => 'text',
                'div' => array(
                    'class' => 'small-9 large-10 columns'
                )
            ));
            ?>
        </div>                
    </div>
    <div class="small-12 medium-6 large-6 columns"> 
        <h6>Experiencia</h6>
        <?php echo $this->Html->link('Agregar experiencia', array(
            'controller' => 'experience',
            'action' => 'register'), array(
                'class' => 'button secondary tiny radius'
            )
        );?>
        <p></p>                
        <div class="experiences-content">
            <?php foreach ($experiences as $key => $value) { ?>
            <ul class="pricing-table">
                <li class="title"><?php echo 'Actividad ' . ($key + 1); ?>
                <?php echo $this->Html->link($this->Html->tag('span', NULL, array(
                        'class' => 'li_trash',
                        'aria-hidden' => 'true',
                        'style' => 'color: white; float: right;'
                    )), array(
                        'controller' => 'experience',
                        'action' => 'delete',
                        $value['Experience']['id'])
                      ,array('escape' => false)
                      ,'¿Estás seguro de eliminar esta experiencia?'); ?>
                </li>
                <li class="price"><?php echo $value['Institution']['name']; ?></li>
                <li class="description"><?php echo $value['Experience']['activities']; ?></li>
                <li class="bullet-item"><?php echo 'De ' . $value['Experience']['from_date'] . ' a ' . $value['Experience']['to_date']; ?></li>
                <li class="cta-button" style="padding: 0.5em;"><?php echo $this->Html->link('Editar', array(
                    'controller' => 'experience',
                    'action' => 'edit',
                    $value['Experience']['id']
                ), array(
                    'class' => 'button secondary tiny radius'
                )); ?></li>
            </ul>
            <?php } ?>     
        </div>                
    </div>
    <?php
    echo $this->Form->end(array(
        'label' => 'Actualizar',
        'class' => 'button radius small right',
        'div' => array(
            'class' => 'columns'
        )
    ));
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#MemberSNIValidityDate").datepicker({ dateFormat: "yyyy-mm-dd" });
        $("#MemberPROMEPValidityDate").datepicker({ dateFormat: "yyyy-mm-dd" });
        $("#UserImg").change(function() {
            $("#selected_file").html($("#UserImg").val());
        });
    });
</script>