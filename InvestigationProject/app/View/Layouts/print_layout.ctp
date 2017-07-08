<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_name; ?>  - <?php echo Configure::read('App.name') ?></title>
        <link rel="shortcut icon" href="http://www.uaemex.mx/images/uniaemex.png">
        <meta description="Investigaci&oacute;n">
        <?php echo $this->Html->css(array('foundation', 'normalize', 'style')); ?> 
        <?php echo $this->Html->script(array('vendor/jquery')); ?>       
    </head>
    <body>
        <div class="wrapper">               
            <section class="row container">
                <div class="off-canvas-wrap docs-wrap" data-offcanvas>
                    <div class="inner-wrap">                        
                        <section class="main-section">  
                            <figure>
                                <?php
                                echo $this->Html->image('logo_principal.png', array(
                                        'alt' => Configure::read('App.name'),
                                        'width' => '100%'));
                                ?> 
                            </figure>                                                 
                            <?php echo $this->fetch('content'); ?>                            
                        </section>
                        <a class="exit-off-canvas"></a>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
        function CheckWindowState()    {           
            if(document.readyState=="complete") {
                window.close(); 
            } else {           
                setTimeout(CheckWindowState, 1000)
            }
        }    

        window.print();
        CheckWindowState();            
    });
</script>