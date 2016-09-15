<?php echo $this->Html->script('bootstrap-tagsinput.min'); ?>
<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->css('bootstrap-tagsinput'); ?>
<?php echo $this->Html->css('linecons'); ?>
<h4><?php echo $page_name; ?></h4>
<?php echo $this->Form->create(''); ?>
<div class="small-12 medium-6 large-6 medium-centered large-centered columns form-content">
    <h5>Información de la sección</h5>
    <div class="row">
        <div class="column">
            <label>Nombre
                <?php
                echo $this->Form->input('Section.name', array(
                    'label' => false,
                    'placeholder' => 'nombre',
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
                echo $this->Form->input('Section.description', array(
                    'label' => false,
                    'placeholder' => 'descripción',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <h5>Estructrura de la sección</h5>
    <a id="add_field" class="button tiny success radius local-action">Agregar campo 
        <span style="position: relative; top: 1px;" aria-hidden="true" class="li_tag"></span>
    </a>
    <div class="section_fields">
        <div class="row">
            <div class="small-6 large-6 columns">              
                <label>Nombre de campo
                    <?php
                    echo $this->Form->input('SectionsField.0.name', array(
                        'label' => false,
                        'placeholder' => 'nombre de campo',
                        'class' => 'id_field radius'
                    ));
                    ?>
                </label>
            </div>
            <div class="small-5 large-5 columns">              
                <label>Tipo de campo
                    <?php
                    echo $this->Form->input('SectionsField.0.type', array(
                        'options' => $field_types,
                        'default' => 'Texto',
                        'label' => false,
                        'placeholder' => 'tipo de campo',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
            <div class="small-1 large-1 columns" style="padding: 0;">             
            </div>        
        </div>        
    </div>
    <?php
    echo $this->Form->input('auxFileds', array(
        'type' => 'hidden'
    ));
    echo $this->Form->end(array(
        'label' => 'Crear sección',
        'class' => 'button radius small right',
        'style' => 'margin-top: 1em;',
        'div' => array(
            'class' => 'columns'
        )
    ));
    ?>
</div>
<script>
    var fieldNo = 1;
    $(document).ready(function() {
        jQuery.validator.addMethod("checkForDuplicate", function(value, element) {
            var textValues = [], valid = true;
            $("input.id_field").each(function() {
                if ($(this).val() !== "") {
                    var doesExisit = ($.inArray($(this).val(), textValues) === -1) ? false : true;
                    if (doesExisit === false) {                        
                        textValues.push($(this).val());                        
                    } else {                                                
                        valid = false;
                        return false;
                    }
                }

            });            
            return valid;
        }, "El campo que desea agregar ya está en la lista.");

        $('#SectionRegisterForm').validate({
            rules: {
                'data[Section][name]': {required: true},
                'data[Section][description]': {required: true},
                'input[name^="SectionsField"]': {required: true}
            }
        });
        $("#add_field").click(addField);

<?php
if (isset($this->request->data['SectionsField']) and
        count($this->request->data['SectionsField']) > 1) {
    foreach ($this->request->data['SectionsField'] as $key => $value) {
        if ($key > 0) {
            echo "addField(null,'" . $value["name"] . "');";
        }
    }
}
?>

        function addField(event, value) {
            var row = createDiv('row');
            var columns = createDiv('small-6 large-6 columns');
            var input = createInput(
                    'data[SectionsField][' + fieldNo + '][name]',
                    'nombre de campo',
                    'radius',
                    'SectionField' + fieldNo + 'Name');            
            if (typeof value !== 'undefined')
                input.val(value);
            columns.append(input);
            columns.appendTo(row);
            columns = createDiv('small-5 large-5 columns');
            input = jQuery('<select/>', {
                name: 'data[SectionsField][' + fieldNo + '][type]',
                class: 'radius valid',
                id: 'SectionField' + fieldNo + 'Type',
                required: 'required',
                value: 'Texto',
                'aria-required': 'true',
                'aria-invalid': 'false',
                style: 'font-size: 0.875rem; color: rgba(0, 0, 0, 0.75);'
            });
            input.append('<option value="Texto" selected="selected">Texto</option>' +
                    '<option value="Casilla de verificación">Casilla de verificación</option>' +
                    '<option value="Fecha">Fecha</option>' + 
                    '<option value="Lista desplegable">Lista desplegable</option>' + 
                    '<option value="Selección múltiple">Selección múltiple</option>');        

            columns.append(input);

            var fieldAuxNo = fieldNo;

            input.change(function(){
                $('.field-' + fieldAuxNo + '-values').remove();
                switch($(this).val()){
                    case 'Lista desplegable':
                    case 'Selección múltiple':                        
                        var values = $('<input>', {
                            type: 'text',
                            id: 'SectionsField' + fieldAuxNo + 'Values',
                            name: 'data[SectionsField][' + fieldAuxNo + '][values]',
                            placeholder: 'Ingrese valores separados por comas',
                            style: 'width: 100%;'
                        });                        
                        var columns = createDiv('small-12 large-12 columns field-' + fieldAuxNo + '-values');
                        columns.append(values);                                            
                        columns.appendTo($(input).parent().parent());
                        $(values).tagsinput();
                    break;
                    default:
                        $('.field-' + fieldAuxNo + '-values').remove();
                    break;
                }
            });

            columns.appendTo(row);
            columns = createDiv('small-1 large-1 columns');
            var trashBtn = createTrashButtton();
            trashBtn.click(function() {
                row.remove();
                $('.field-' + fieldNo + '-values').remove();
            });
            trashBtn.appendTo(row);
            row.appendTo('.section_fields');
            $('#SectionField' + fieldNo + 'Name').rules("add", {required: true, checkForDuplicate: true});
            fieldNo++;
        }

        $('#SectionsField0Type').change(function(){
            $('.field-' + 0 + '-values').remove();
            switch($(this).val()){
                case 'Lista desplegable':
                case 'Selección múltiple':
                    var values = $('<input>', {
                        type: 'text',
                        id: 'SectionsField' + 0 + 'Values',
                        name: 'data[SectionsField][' + 0 + '][values]',
                        placeholder: 'Ingrese valores separados por comas',
                        style: 'width: 100%;'
                    });                    
                    var columns = createDiv('small-12 large-12 columns field-' + 0 + '-values');
                    columns.append(values);                    
                    columns.appendTo($(this).parent().parent().parent().parent());
                    $(values).tagsinput();
                break;                    
            }
        });

        function refreshFieldsInformation() {

            $("#SectionAuxFileds").val();
        }

        function createDiv(cssClass) {
            return jQuery('<div/>', {
                class: cssClass
            });
        }

        function createInput(name, placeholder, cssClass, id) {
            return jQuery('<input/>', {
                name: name,
                placeholder: placeholder,
                class: 'id_field ' + cssClass,
                type: 'text',
                id: id
            });
        }

        function createTrashButtton() {
            var btn = jQuery('<a/>', {
                class: 'button tiny success radius remove-field'
            });
            var icon = jQuery('<span/>', {
                'aria-hidden': 'true',
                class: 'li_trash'
            });
            btn.append(icon);
            return btn;
        }
    });
</script>