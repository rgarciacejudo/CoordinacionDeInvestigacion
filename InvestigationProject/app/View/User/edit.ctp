<?php echo $this->Html->script('bootstrap-tagsinput.min'); ?>
<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('bootstrap-tagsinput'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<?php echo $this->Html->css('linecons'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="form-content">
    <div class="row">
        <div class="small-12 medium-6 large-6 columns">
            <h6>Cuenta</h6>
            <?php
            echo $this->Form->create('UserImage', array(
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
                    <span id="selected_file">Cambiar imagen</span>
                    <?php
                    echo $this->Form->input('img', array(
                        'label' => false,
                        'type' => 'file',
                        'accept' => 'image/x-png, image/gif, image/jpeg',
                        'hidden' => '1'
                    ));
                    ?>
                </figure>
            </label>
            <?php
            echo $this->Form->end(array(
                'label' => 'Guardar cambio',
                'class' => 'button tiny radius right',
                'div' => array(
                    'class' => 'columns'
                )
            ));
            ?>
        </div>
        <div class="small-12 medium-6 large-6 columns">
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
    <?php echo $this->Form->create(); ?>
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
                <label>Descripción
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
    <?php if ($this->Session->read('Auth.User.role') !== 'super_admin') : ?>
      <div class="small-12 medium-6 large-6 columns">
        <div class="row">
            <div class="column">
                <label>Líneas de investigación
                    <?php
                    echo $this->Form->input('Member.research_line', array(
                        'label' => false,
                        'placeholder' => 'Separe por comas',
                        'class' => 'radius',
                        'data-role' => 'tagsinput'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Grado académico
                    <?php
                        echo $this->Form->input('Member.grade', array(
                            'options' => $grade_options,
                            'label' => false,
                            'placeholder' => 'Grado académico',
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
                    echo $this->Form->input('Member.university', array(
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
        <div class="sni-container hide">
            <div class="row collapse">
                <label>SNI - Fecha de Inicio</label>
                <div class="small-3 large-2 columns">
                    <span aria-hidden="true" class="radius-left prefix li_calendar"></span>
                </div>
                <?php
                echo $this->Form->input('Member.SNI_start_date', array(
                    'label' => false,
                    'placeholder' => 'fecha de inicio',
                    'class' => 'radius-right',
                    'readonly' => 'readonly',
                    'type' => 'text',
                    'div' => array(
                        'class' => 'small-9 large-10 columns'
                    )
                ));
                ?>
            </div>
            <div class="row collapse">
                <label>SNI - Fecha de Fin</label>
                <div class="small-3 large-2 columns">
                    <span aria-hidden="true" class="radius-left prefix li_calendar"></span>
                </div>
                <?php
                echo $this->Form->input('Member.SNI_end_date', array(
                    'label' => false,
                    'placeholder' => 'fecha de fin',
                    'class' => 'radius-right',
                    'readonly' => 'readonly',
                    'type' => 'text',
                    'div' => array(
                        'class' => 'small-9 large-10 columns'
                    )
                ));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>PRODEP</label>
                <?php
                echo $this->Form->input('Member.PROMEP', array(
                    'label' => 'Aplica',
                    'placeholder' => 'PROMEP',
                    'class' => 'radius'
                ));
                ?>

            </div>
        </div>
        <div class="promep-container hide" >
            <div class="row collapse">
                <label>PRODEP - Fecha de Inicio</label>
                <div class="small-3 large-2 columns">
                    <span aria-hidden="true" class="radius-left prefix li_calendar"></span>
                </div>
                <?php
                echo $this->Form->input('Member.PROMEP_start_date', array(
                    'label' => false,
                    'placeholder' => 'fecha de inicio',
                    'class' => 'radius-right',
                    'readonly' => 'readonly',
                    'type' => 'text',
                    'div' => array(
                        'class' => 'small-9 large-10 columns'
                    )
                ));
                ?>
            </div>
            <div class="row collapse">
                <label>PRODEP - Fecha de Fin</label>
                <div class="small-3 large-2 columns">
                    <span aria-hidden="true" class="radius-left prefix li_calendar"></span>
                </div>
                <?php
                echo $this->Form->input('Member.PROMEP_end_date', array(
                    'label' => false,
                    'placeholder' => 'fecha de fin',
                    'class' => 'radius-right',
                    'type' => 'text',
                    'div' => array(
                        'class' => 'small-9 large-10 columns'
                    )
                ));
                ?>
            </div>
        </div>
    </div>
    <?php endif ?>
    <div class="small-12 medium-12 large-12 columns">
        <!--<h6>Experiencia</h6>-->
        <?php if ($this->Session->read('Auth.User.role') !== 'super_admin') : ?>
        <?php
        echo $this->Html->link('Agregar experiencia', array(
            'controller' => 'experience',
            'action' => 'register'), array(
            'class' => 'button secondary tiny radius'
                )
        );
        ?>
      <?php endif ?>
		<div class="right"><input class="button radius small right" type="submit" value="Actualizar"></div>
        <p></p>
        <div class="experiences-content">
            <dl class="accordion" data-accordion>
            <?php foreach ($experiences as $key => $value) { ?>
                <?php $activityId = 'Actividad' . ($key + 1); ?>
                    <dd class="accordion-navigation">
                        <?php
                        echo $this->Form->postLink($this->Html->tag('span', NULL, array(
                                'class' => 'li_trash delete-experience',
                                'aria-hidden' => 'true',
                            )),
                            array(
                                'controller' => 'experience',
                                'action' => 'delete',
                                $value['Experience']['id'])
                                    , array('escape' => false, 'class' => 'del-exp')
                                    , '¿Estás seguro de eliminar esta experiencia?'
                            );
                        ?>
                        <a href="#<?php echo $activityId; ?>"><?php echo $value['Institution']['name']; ?></a>
                        <div id="<?php echo $activityId; ?>" class="content">
                            <p class="no-margin experience-title"><?php echo 'De ' . $value['Experience']['from_date'] . ' a ' . $value['Experience']['to_date']; ?></p>
                            <p class="no-margin"><?php echo $value['Experience']['activities']; ?></p>
                            <div style="text-align:right;"><?php
                                echo $this->Html->link('Editar', array(
                                    'controller' => 'experience',
                                    'action' => 'edit',
                                    $value['Experience']['id']
                                        ), array(
                                    'class' => 'button secondary tiny radius'
                                ));
                                ?></div>
                        </div>
                    </dd>
            <?php } ?>
            </dl>
        </div>
    </div>
	</form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#MemberSNIStartDate").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
        $("#MemberPROMEPStartDate").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
        $("#MemberSNIEndDate").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
        $("#MemberPROMEPEndDate").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});

        $('#UserEditForm').validate();

        $("#UserImg").change(function () {
            $("#selected_file").html($("#UserImg").val());
        });

        //Lógica de SNI y PROMEP
        $('#MemberPROMEP').change(function () {
            if (!$(this).prop('checked')) {
                $('.promep-container').addClass('hide');
                $('#MemberPROMEPStartDate').val('');
                $('#MemberPROMEPEndDate').val('');
                $('#MemberPROMEPStartDate').rules('remove', 'required');
                $('#MemberPROMEPEndDate').rules('remove', 'required');
            } else {
                $('.promep-container').removeClass('hide');
                $('#MemberPROMEPStartDate').rules('add', 'required');
                $('#MemberPROMEPEndDate').rules('add', 'required');
            }
        });

        $('#MemberSNI').change(function () {
            if ($(this).val() === '') {
                $('.sni-container').addClass('hide');
                $("#MemberSNIStartDate").val('');
                $("#MemberSNIEndDate").val('');
                $('#MemberSNIStartDate').rules('remove', 'required');
                $('#MemberSNIEndDate').rules('remove', 'required');
            } else {
                $('.sni-container').removeClass('hide');
                $('#MemberSNIStartDate').rules('add', {required: true});
                $('#MemberSNIEndDate').rules('add', {required: true});
            }
        });

        $('#MemberPROMEP').change();
        $('#MemberSNI').change();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.th.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#UserImageImg").change(function(){
            readURL(this);
        });
    });
</script>
