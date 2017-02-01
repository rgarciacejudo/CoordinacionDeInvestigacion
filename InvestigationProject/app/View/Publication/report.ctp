<?php setlocale(LC_ALL, 'es_ES'); ?>
<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<style>
    .ui-datepicker-calendar,.ui-datepicker-month { display: none; }​    
</style>
<h4><?php echo $page_name; ?></h4>
<?php if(!isset($print)) : ?>
<?php echo $this->Form->create('Report', array('type' => 'file')); ?>
<div class="form-content">    
    <div class="panel columns">                                        
        <h5>Criterios de búsqueda</h5>
        <div class="small-12 medium-6 large-4 columns">
            <label><b>Investigadores</b></label>
            <div class="over-member-container">
                <?php foreach ($members as $key => $member) { ?>
                    <div class="member-container">                        
                        <input type="checkbox" id="Member<?php echo $member['Member']['id'];?>"
                            name="data[Members][<?php echo $key;?>][member_id]" value="<?php echo $member['Member']['id'];?>"
                            <?php echo isset($this->request->data['Members']) && in_array(array('member_id' => $member['Member']['id']), $this->request->data['Members']) ? 'checked' : ''; ?> />
                        <p class="member-username" style="margin: 0 0 0.5em 0.5em;">
                            <?php echo $member['User']['username'] . '<br>' . $member['Member']['name'] . ' ' .
                                $member['Member']['last_name'];?>
                        </p>
                    </div>
                <?php } ?>
                <?php if (count($members) === 0) { ?>
                <p>No hay investigadores</p>
                <?php } ?>
            </div>
        </div>
        <div class="small-12 medium-6 large-4 columns">
            <label><b>Secciones</b></label>
            <div class="over-member-container">
                <?php foreach ($sections as $key => $section) { ?>
                    <div class="member-container">                        
                        <input type="checkbox" id="Section<?php echo $section['Section']['id'];?>"
                            name="data[Sections][<?php echo $key;?>][id]" value="<?php echo $section['Section']['id'];?>"
                            <?php echo isset($this->request->data['Sections']) && in_array(array('id' => $section['Section']['id']), $this->request->data['Sections']) ? 'checked' : ''; ?> />                        
                        <p class="member-username" style="margin: 0 0 0.5em 0.5em;">
                            <?php echo $section['Section']['name']; ?>
                        </p>
                    </div>
                <?php } ?>
                <?php if (count($members) === 0) { ?>
                <p>No hay secciones</p>
                <?php } ?>
            </div>            
        </div>
        <div class="small-12 medium-6 large-4 columns">
            <label><b>Año</b></label>
            <?php
                echo $this->Form->input('year', array(
                    'label' => false,
                    'placeholder' => 'año'
                ));
            ?>
            <?php
                echo $this->Form->input('print', array(
                    'label' => 'Exportar a PDF',
                    'type' => 'checkbox',
                    'value' => '1'
                ));
            ?>   
        </div>          
        <?php
            echo $this->Form->end(array(
                'label' => 'Consultar',
                'class' => 'button radius small',
                'style' => 'margin-top: 1em;',
                'div' => array(
                    'class' => 'text-right'
                )
            ));
        ?>
    </div>    
    <div class="row">
        <?php if(isset($publications)) : ?>
        <?php $sectionName = ""; ?>
        <?php foreach ($publications as $key => $value) { ?>
            <?php if ($sectionName !== $value['Section']['name']) :
            $sectionName = $value['Section']['name']; ?>
            <div class="small-12 medium-12 large-12 columns">
                <h5><?php echo $sectionName;?> </h5>
            </div>
            <?php endif ?>
            <?php echo $this->element('publication_view', array('value' => $value, 'mine' => isset($mine) ? $mine : false)); ?>
        <?php } ?>
        <?php endif; ?>
    </div>
    <?php if(isset($publications) && count($publications) > 0) : ?>
    <div class="">
        <div class="large-6 medium-6 columns">
            <ul class="pagination" role="menubar" aria-label="Pagination">
                <?php echo $this->Paginator->prev('« Anterior', array(
                    'tag' => 'li'
                )); ?>
                <?php echo $this->Paginator->numbers(array(
                    'separator' => '',
                    'currentClass' => 'current',
                    'tag' => 'li',
                    'currentTag' => 'a'
                )); ?>
                <?php echo $this->Paginator->next('Siguiente »', array(
                    'tag' => 'li'
                )); ?>
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
    </div>    
    <?php endif; ?>
</div>
<?php else: ?>
    <style type="text/css" media="print">
        @page {size: landscape}
    </style>
    <?php $sectionName = ""; ?>
    <?php foreach ($publications as $key => $value) { ?>
        <?php if ($sectionName !== $value['Section']['name']) :
        if($sectionName !== "") {
            echo "</table>";
        }
        $sectionName = $value['Section']['name']; ?>
        <div class="small-12 medium-12 large-12 columns">
            <h5><?php echo $sectionName;?> </h5>
        </div>
        <table role="grid">
        <tr>
            <th>Publicó</th>
            <th>Fecha de Finalización / Obtención / Publicación</th>
            <?php if($value['Section']['with_authors'] === '1') : ?>
                <th>Autores</th>
            <?php endif; ?>
            <?php if($value['Section']['with_members'] === '1') : ?>
                <th>Integrantes de CA</th>
            <?php endif; ?>
            <?php foreach ($value['Fields'] as $key => $field) { ?>
                <th>                    
                    <?php echo $field['name']; ?>
                </th>
            <?php } ?>
        </tr>
        <?php endif ?>
        <?php echo $this->element('publication_view', array('value' => $value, 'mine' => isset($mine) ? $mine : false, 'print' => true)); ?>
    <?php } ?>    
<?php endif; ?>
<?php if (count($publications) === 0) { ?>
<p>No hay publicaciones para los criterios ingresados.</p>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#ReportReportForm').validate({
            rules: {
                'data[Report][year]': {required: true}
            },
            messages: {
                'data[Report][year]': {
                    required: 'Este campo es requerido.'
                }
            }
        });

        $("#ReportYear").datepicker({
            changeMonth: false,
            changeYear: true,
            showButtonPanel: true,            
            dateFormat: 'yy',
            onClose: function(dateText, inst) { 
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, 0, 1));
            }
        });  
    });
</script>