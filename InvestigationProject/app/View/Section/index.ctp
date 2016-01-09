<?php setlocale(LC_ALL, 'es_ES'); ?>
<h4><?php echo $page_name; ?></h4>
<?php foreach ($sections as $key => $value) {
    echo $this->element('section_view', array('section' => $value));
} ?>      