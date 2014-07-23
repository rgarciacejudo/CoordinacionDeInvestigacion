<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<h4><?php echo $page_name; ?></h4>
<?php echo $this->Form->create(''); ?>
<div class="small-12 medium-6 large-6 medium-centered large-centered columns form-content">
    <div class="row">
        <div class="column">
            <label>Institución
                <?php
                echo $this->Form->input('institution', array(
                    'label' => false,
                    'placeholder' => 'institución',
                    'class' => 'radius'
                ));
                ?>
                <?php
                echo $this->Form->input('institution_id', array(
                    'label' => false,
                    'type' => 'hidden'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <label>Actividades
                <?php
                echo $this->Form->input('activities', array(
                    'label' => false,
                    'placeholder' => 'activiades',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <label class="text-center">Periodo</label>
    <div class="row">
        <div class="column text-center">
            <label class="inline-block">De
                <?php
                echo $this->Form->input('from_date', array(
                    'label' => false,
                    'placeholder' => 'fecha de',
                    'class' => 'radius',
                    'type' => 'text'
                ));
                ?>
            </label>
            <label class="inline-block">A
                <?php
                echo $this->Form->input('to_date', array(
                    'label' => false,
                    'placeholder' => 'fecha a',
                    'class' => 'radius',
                    'type' => 'text'
                ));
                ?>
            </label>
        </div>
    </div>
    <?php
    echo $this->Form->end(array(
        'label' => 'Registrar',
        'class' => 'button radius small right',
        'div' => array(
            'class' => 'columns'
        )
    ));
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#ExperienceFromDate").datepicker();
        $("#ExperienceToDate").datepicker();
        $('#ExperienceRegisterForm').validate({
            rules: {
                'data[Experience][institution]': {required: true},
                'data[Experience][activities]': {required: true}
            }
        });
        $(function(){
            $( "#ExperienceInstitution" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "http://localhost:8080/CoordinacionDeInvestigacion/InvestigationProject/institution/getexperiences",
                        dataType: "json",
                        data: {
                            name: request.term
                        },
                        success: function( data ) {                    
                            response( data );
                        }
                    });
                },
                minLength: 3,
                select: function( event, ui ) {
                    $("#ExperienceInstitutionId").val(ui.item.id);
                },
                search: function(event, ui){
                    $(this).addClass('searching');
                },
                response: function(event, ui){
                    $(this).removeClass('searching');
                }
            });
        });
    });
</script>