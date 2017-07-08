<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="row">
            <p>
                El usuario <?php echo $from_username; ?> registró un nuevo producto en el cual también formas parte de él.
            </p>
            <p>
                <span style="font-weight: bold;">Accede a la publicación desde:</span>
                <?php echo $this->Html->link('Ver publicación', FULL_BASE_URL.$this->webroot.'publication/detail/'.$publication_id); ?>
            </p>
        </div>
    </body>
</html>
