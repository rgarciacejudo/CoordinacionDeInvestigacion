<?php echo $this->Html->script('jquery.validate.min'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="row form-content">       
    <div class="small-12 medium-6 large-6 medium-centered large-centered columns">
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
                        echo $this->Html->image($img_profile == NULL ? 'no_img_profile.png' : $img_profile, array(
                            'alt' => 'CakePHP',
                            'class' => 'avatar'));
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
        <div class="row">
            <div class="column">
                <label>Queremos conocerte
                    <?php
                    echo $this->Form->input('Member.addtional_data', array(
                        'label' => false,
                        'placeholder' => 'información que los demás verán',
                        'rows' => '3',
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
        <div class="row">
            <div class="column">
                <label>Validez SNI
                    <?php
                    echo $this->Form->input('Member.SNI_validity_date', array(
                        'label' => false,
                        'placeholder' => 'validez',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>PROMEP
                    <?php
                    echo $this->Form->input('Member.PROMEP', array(
                        'label' => 'Aplica',
                        'placeholder' => 'PROMEP',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Validez PROMEP
                    <?php
                    echo $this->Form->input('Member.PROMEP_validity_date', array(
                        'label' => false,
                        'placeholder' => 'validez',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
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
        $("#UserImg").change(function() {
            $("#selected_file").html($("#UserImg").val());
        });

//        $('#UserManageForm').validate({
//            rules: {
//                'data[User][password]': {required: true},
//                'data[User][newpassword]': {required: true},
//                'data[User][confirm_newpassword]': {required: true, equalTo: '#UserNewpassword'}
//            }
//        });
    });
</script>