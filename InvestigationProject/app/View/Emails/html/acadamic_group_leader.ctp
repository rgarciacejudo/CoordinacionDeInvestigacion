<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="row">
            <p>
                El usuario: <?php echo $from_username; ?> <br>
                Te ha elegido líder del grupo académico: <?php echo $academic_group; ?>
            </p>            
            <p>
                <span style="font-weight: bold;">Accede al grupo académico desde:</span>
                <?php echo $this->Html->link($academic_group, FULL_BASE_URL.$this->webroot.'academic_group/view/'.$view_id); ?>
            </p>
        </div>
    </body>
</html>
